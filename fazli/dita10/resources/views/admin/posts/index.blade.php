<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-orange-600">Field Notes / Admin</p>
                <h2 class="mt-1 text-2xl font-semibold text-gray-900">Stories</h2>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">New story</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
        @endif

        <div class="overflow-hidden border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                        <tr><th class="px-6 py-4">Story</th><th class="px-6 py-4">Category</th><th class="px-6 py-4">Status</th><th class="px-6 py-4 text-right">Actions</th></tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($posts as $post)
                            <tr class="align-top">
                                <td class="px-6 py-5"><div class="font-semibold text-gray-900">{{ $post->title }}</div><div class="mt-1 text-xs text-gray-500">{{ $post->author }} · {{ $post->read_time }} min read</div></td>
                                <td class="px-6 py-5 text-gray-600">{{ $post->category }}</td>
                                <td class="px-6 py-5"><span class="inline-flex items-center gap-2 text-xs font-semibold {{ $post->is_published ? 'text-green-700' : 'text-gray-500' }}"><span class="h-2 w-2 rounded-full {{ $post->is_published ? 'bg-green-500' : 'bg-gray-300' }}"></span>{{ $post->is_published ? 'Published' : 'Draft' }}{{ $post->is_featured ? ' · Featured' : '' }}</span></td>
                                <td class="px-6 py-5"><div class="flex justify-end gap-3"><a class="font-semibold text-orange-700 hover:text-orange-900" href="{{ route('admin.posts.edit', $post) }}">Edit</a><form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this story permanently?')">@csrf @method('DELETE')<button class="font-semibold text-red-600 hover:text-red-800" type="submit">Delete</button></form></div></td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-12 text-center text-gray-500">No stories yet. Create the first one.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($posts->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">{{ $posts->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>