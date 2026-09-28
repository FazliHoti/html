<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Notes Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: "Inter", "Segoe UI", sans-serif;
            background: #f5f1ea;
            color: #1f1a17;
        }
        * { box-sizing: border-box; }
        a { text-decoration: none; }
        .admin-shell {
            min-height: 100vh;
            background: radial-gradient(circle at top, #f7efe7 0%, #f2eadf 28%, #efe6dc 100%);
        }
        .admin-topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(30, 23, 20, 0.96);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }
        .admin-topbar-inner {
            max-width: 1280px;
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
            gap: 0.75rem;
            color: #f7efe7;
            font-size: 0.85rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            font-weight: 700;
        }
        .brand-mark {
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #d97706, #fbbf24);
            border-radius: 50%;
            box-shadow: 0 0 18px rgba(251,191,36,0.7);
        }
        .admin-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 0.8rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            transition: 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .btn-primary {
            background: #111827;
            color: white;
        }
        .btn-primary:hover { background: #1f2937; }
        .btn-secondary {
            background: rgba(255,255,255,0.05);
            color: #f9f5f1;
            border-color: rgba(255,255,255,0.12);
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.08); }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover { background: #dc2626; }
        .admin-main {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1.25rem 4rem;
        }
        .panel {
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(69,52,45,0.08);
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(48, 33, 23, 0.08);
        }
        .panel-header {
            padding: 1.5rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(69,52,45,0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .eyebrow {
            margin: 0;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #c16a1d;
            font-weight: 800;
        }
        h1 {
            margin: 0.4rem 0 0;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1.05;
            letter-spacing: -0.05em;
        }
        .status-box {
            margin: 1.25rem 0 0;
            padding: 0.9rem 1rem;
            border-radius: 12px;
            background: rgba(16,185,129,0.08);
            border: 1px solid rgba(16,185,129,0.2);
            color: #065f46;
            font-weight: 600;
        }
        .table-wrap {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }
        th, td {
            padding: 1rem 1.25rem;
            text-align: left;
            border-bottom: 1px solid rgba(69,52,45,0.08);
            vertical-align: top;
        }
        th {
            background: rgba(43, 37, 35, 0.03);
            color: #5b504a;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-weight: 700;
        }
        td {
            color: #2a221f;
            background: rgba(255,255,255,0.25);
        }
        .story-title {
            font-weight: 800;
            font-size: 1rem;
            margin-bottom: 0.35rem;
        }
        .story-meta {
            color: #665d59;
            font-size: 0.8rem;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        .badge-live {
            background: rgba(34,197,94,0.12);
            color: #166534;
        }
        .badge-draft {
            background: rgba(107,114,128,0.1);
            color: #4b5563;
        }
        .dot {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-live { background: #22c55e; }
        .dot-draft { background: #94a3b8; }
        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.8rem;
            flex-wrap: wrap;
        }
        .link-edit {
            color: #9a4d12;
            font-weight: 700;
        }
        .link-delete {
            color: #b91c1c;
            font-weight: 700;
            background: transparent;
            border: 0;
            cursor: pointer;
            padding: 0;
        }
        .empty-state {
            text-align: center;
            color: #645d5a;
            padding: 4rem 1.5rem;
            font-size: 1rem;
        }
        .pagination {
            padding: 1.2rem 1.25rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            flex-wrap: wrap;
            color: #312b28;
        }
        .pagination a, .pagination span {
            padding: 0.55rem 0.8rem;
            border: 1px solid rgba(49,43,40,0.12);
            border-radius: 999px;
            background: rgba(255,255,255,0.4);
            font-size: 0.82rem;
        }
        .pagination .current {
            background: #111827;
            color: white;
            border-color: #111827;
        }
        @media (max-width: 640px) {
            .admin-actions { width: 100%; justify-content: space-between; }
            .panel-header { align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <header class="admin-topbar">
            <div class="admin-topbar-inner">
                <div class="brand"><span class="brand-mark"></span> Field Notes</div>
                <div class="admin-actions">
                    <a href="{{ route('home') }}" class="btn btn-secondary">View site</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Log out</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="admin-main">
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <p class="eyebrow">Content manager</p>
                        <h1>Stories</h1>
                    </div>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">New story</a>
                </div>

                @if (session('status'))
                    <div class="status-box">{{ session('status') }}</div>
                @endif

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Story</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>
                                        <div class="story-title">{{ $post->title }}</div>
                                        <div class="story-meta">{{ $post->author }} · {{ $post->read_time }} min read</div>
                                    </td>
                                    <td>{{ $post->category }}</td>
                                    <td>
                                        <span class="badge {{ $post->is_published ? 'badge-live' : 'badge-draft' }}">
                                            <span class="dot {{ $post->is_published ? 'dot-live' : 'dot-draft' }}"></span>
                                            {{ $post->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a class="link-edit" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this story permanently?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="link-delete">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">No stories yet. Create the first one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($posts->hasPages())
                    <div class="pagination">{{ $posts->links() }}</div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
