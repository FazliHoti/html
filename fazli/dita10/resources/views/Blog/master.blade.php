<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ $description ?? 'Field Notes is an independent journal for curious people.' }}">
	<title>{{ $title ?? 'Field Notes' }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
	@include('Blog.includes.style')
</head>
<body>
	<div class="top-strip"></div>
	@include('Blog.includes.navbar')
	@yield('content')
	@include('Blog.includes.footer')
	@include('Blog.includes.script')
</body>
</html>
