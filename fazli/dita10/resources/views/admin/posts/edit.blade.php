<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Story | Field Notes Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: "Inter", "Segoe UI", sans-serif;
            background: #f4efe8;
            color: #1f1a17;
        }
        * { box-sizing: border-box; }
        a { text-decoration: none; }
        .cms-shell {
            min-height: 100vh;
            background: linear-gradient(180deg, #f7efe7 0%, #f4efe8 100%);
        }
        .cms-topbar {
            background: rgba(17, 24, 39, 0.98);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .cms-topbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.7rem;
            color: #f8f3ee;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .brand-mark {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b, #fcd34d);
            box-shadow: 0 0 16px rgba(250,204,21,0.7);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 0.8rem 1.2rem;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
        }
        .btn-dark { background: #111827; color: white; }
        .btn-light { background: rgba(255,255,255,0.06); color: #f8f3ee; border-color: rgba(255,255,255,0.12); }
        .cms-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1.25rem 4rem;
        }
        .editor-panel {
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(69,52,45,0.08);
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(37, 26, 18, 0.08);
            overflow: hidden;
        }
        .editor-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(69,52,45,0.08);
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .eyebrow {
            margin: 0;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #c16a1d;
            font-size: 0.72rem;
            font-weight: 800;
        }
        h1 {
            margin: 0.5rem 0 0;
            font-size: clamp(2.2rem, 4vw, 3rem);
            letter-spacing: -0.06em;
        }
        .form-wrap {
            padding: 1.6rem 1.5rem 2rem;
        }
        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.2rem;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .field.full {
            grid-column: 1 / -1;
        }
        label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #584d49;
            font-weight: 800;
        }
        input, textarea {
            width: 100%;
            border: 1px solid rgba(80, 66, 59, 0.2);
            border-radius: 14px;
            background: rgba(255,255,255,0.7);
            padding: 0.9rem 1rem;
            font: inherit;
            color: #1f1a17;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #d97706;
            box-shadow: 0 0 0 4px rgba(217,119,6,0.12);
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        .checkbox-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 0.5rem;
        }
        .check {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
            color: #2f2a27;
        }
        .check input {
            width: auto;
            accent-color: #d97706;
        }
        .form-actions {
            border-top: 1px solid rgba(69,52,45,0.08);
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .cancel-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #3a302d;
            font-weight: 700;
            border: 1px solid rgba(58,48,45,0.14);
            border-radius: 999px;
            padding: 0.8rem 1.2rem;
            background: transparent;
        }
        @media (max-width: 700px) {
            .field-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="cms-shell">
        <header class="cms-topbar">
            <div class="cms-topbar-inner">
                <div class="brand"><span class="brand-mark"></span> Field Notes</div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-light">Back to stories</a>
            </div>
        </header>

        <main class="cms-main">
            <div class="editor-panel">
                <div class="editor-header">
                    <div>
                        <p class="eyebrow">Story editor</p>
                        <h1>Edit story</h1>
                    </div>
                </div>

                <div class="form-wrap">
                    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
                        @csrf
                        @method('PUT')

                        <div class="field-grid">
                            <div class="field full">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" value="{{ old('title', $post->title ?? '') }}" required>
                                @error('title')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label for="category">Category</label>
                                <input id="category" name="category" type="text" value="{{ old('category', $post->category ?? '') }}" required>
                                @error('category')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label for="author">Author</label>
                                <input id="author" name="author" type="text" value="{{ old('author', $post->author ?? '') }}" required>
                                @error('author')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label for="image_url">Image URL</label>
                                <input id="image_url" name="image_url" type="url" value="{{ old('image_url', $post->image_url ?? '') }}" placeholder="https://..." required>
                                @error('image_url')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label for="excerpt">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" required>{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                @error('excerpt')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label for="body">Story body</label>
                                <textarea id="body" name="body">{{ old('body', $post->body ?? '') }}</textarea>
                                @error('body')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label for="read_time">Read time</label>
                                <input id="read_time" name="read_time" type="number" min="1" value="{{ old('read_time', $post->read_time ?? 5) }}" required>
                                @error('read_time')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label for="sort_order">Display order</label>
                                <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $post->sort_order ?? 0) }}" required>
                                @error('sort_order')<div style="color:#b91c1c;font-size:0.8rem;margin-top:0.2rem;">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="checkbox-row">
                            <label class="check">
                                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? true))>
                                Published
                            </label>
                            <label class="check">
                                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured ?? false))>
                                Feature this story
                            </label>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.posts.index') }}" class="cancel-link">Cancel</a>
                            <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
