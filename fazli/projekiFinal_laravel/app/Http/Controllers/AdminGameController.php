<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminGameController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $games = Game::with('category')->orderBy('name')->get();
        $categories = Category::all();

        return view('admin.games', compact('games', 'categories'));
    }

    public function dashboard(): View
    {
        $this->authorizeAdmin();

        $content = collect(config('site-content'))->map(function (array $item, string $key): array {
            $item['value'] = SiteSetting::text($key, $item['default']);

            return $item;
        });

        return view('admin.dashboard', [
            'gameCount' => Game::count(),
            'activeGameCount' => Game::where('is_active', true)->count(),
            'categoryCount' => Category::count(),
            'content' => $content,
        ]);
    }

    public function gameFiles(Request $request): View
    {
        $this->authorizeAdmin();

        $gameFiles = File::files(public_path('games'));
        $gameFiles = collect($gameFiles)
            ->filter(fn ($file): bool => $file->getExtension() === 'html')
            ->map(fn ($file): string => $file->getFilename())
            ->sort()
            ->values();
        $selectedFile = $gameFiles->contains($request->query('file'))
            ? $request->query('file')
            : $gameFiles->first();

        return view('admin.game-files', [
            'gameFiles' => $gameFiles,
            'selectedFile' => $selectedFile,
            'source' => $selectedFile ? File::get(public_path('games/'.$selectedFile)) : '',
        ]);
    }

    public function updateGameFile(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $gameFiles = collect(File::files(public_path('games')))
            ->filter(fn ($file): bool => $file->getExtension() === 'html')
            ->map(fn ($file): string => $file->getFilename())
            ->all();
        $validated = $request->validate([
            'file_name' => ['required', 'string', Rule::in($gameFiles)],
            'source' => ['required', 'string', 'max:1000000'],
        ]);

        File::put(public_path('games/'.$validated['file_name']), $validated['source']);

        return redirect()->route('admin.game-files', ['file' => $validated['file_name']])
            ->with('success', 'Game source updated successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:games,slug'],
            'description' => ['required', 'string'],
            'instructions' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'embed_url' => ['nullable', 'string', 'max:2048', 'regex:~^(https?://|/)~i'],
            'featured' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        Game::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
            'description' => $validated['description'],
            'instructions' => $validated['instructions'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'embed_url' => $validated['embed_url'] ?? null,
            'featured' => $validated['featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return back()->with('success', 'Game added successfully.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        $this->authorizeAdmin();

        $game->delete();

        return back()->with('success', 'Game removed successfully.');
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('games', 'slug')->ignore($game->id)],
            'description' => ['required', 'string'],
            'instructions' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'max:2048'],
            'embed_url' => ['nullable', 'string', 'max:2048', 'regex:~^(https?://|/)~i'],
            'featured' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $game->update([
            ...$validated,
            'featured' => $request->boolean('featured'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Game updated successfully.');
    }

    public function updateContent(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'content' => ['required', 'array'],
            'content.*' => ['nullable', 'string', 'max:2000'],
        ]);

        foreach (config('site-content') as $key => $item) {
            SiteSetting::saveText($key, $validated['content'][$key] ?? $item['default']);
        }

        return back()->with('success', 'Website text and buttons updated.');
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:categories,slug'],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        Category::create([
            ...$validated,
            'slug' => $validated['slug'] ?: Str::slug($validated['name']),
        ]);

        return back()->with('success', 'Category added successfully.');
    }

    public function updateCategory(Request $request, Category $category): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('categories', 'slug')->ignore($category->id)],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Category $category): RedirectResponse
    {
        $this->authorizeAdmin();

        if ($category->games()->exists()) {
            return back()->with('error', 'Move or remove this category’s games before deleting it.');
        }

        $category->delete();

        return back()->with('success', 'Category removed successfully.');
    }

    private function authorizeAdmin(): void
    {
        abort_unless(Auth::check() && Auth::user()->email === 'admin@example.com', 403);
    }
}
