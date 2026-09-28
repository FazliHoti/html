@extends('Blog.master')

@section('content')
@php
    $featured = $posts->firstWhere('is_featured', true) ?? $posts->first();
    $latest = $posts->reject(fn ($post) => $featured && $post->is($featured));
@endphp
<main id="top">
    <section class="hero" id="journal">
        <div class="hero-heading"><span class="eyebrow">Independent journal <i></i> Est. 2024</span><h1>Stories for<br><em>the curious.</em></h1></div>
        <div class="hero-intro"><p>A quiet corner of the internet for ideas, places, and people worth paying attention to.</p><a class="text-link" href="#stories">Explore the journal <span>↘</span></a></div>
    </section>
    <div class="search-panel" id="search-panel" hidden><label for="story-search">Search the journal</label><div class="search-input-wrap"><input id="story-search" type="search" placeholder="Try “rituals” or “places”"><span>⌕</span></div><p class="search-result" aria-live="polite"></p></div>
    @if ($featured)
        <article class="feature-story" id="stories"><a class="feature-image" href="#newsletter"><img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="eager"></a><div class="feature-copy"><span class="category">{{ $featured->category }}</span><h2>{{ $featured->title }}</h2><p>{{ $featured->excerpt }}</p><div class="story-footer"><span>{{ strtoupper($featured->author) }} <i></i> {{ $featured->read_time }} MIN READ</span><a class="text-link" href="#newsletter">Read story <span>→</span></a></div></div></article>
    @endif
    <section class="latest" aria-labelledby="latest-title"><div class="section-heading"><div><span class="eyebrow">The archive</span><h2 id="latest-title">Latest from the journal</h2></div><a class="text-link" href="#latest-title">View all stories <span>→</span></a></div><div class="filter-row" aria-label="Filter stories"><button class="filter active" type="button" data-filter="all">All stories</button><button class="filter" type="button" data-filter="places">Places</button><button class="filter" type="button" data-filter="ideas">Ideas</button><button class="filter" type="button" data-filter="people">People</button></div><div class="story-grid">
        @foreach ($latest as $post)
            <article class="story-card" data-category="{{ strtolower($post->category) }}" data-title="{{ $post->title }}">
                <a class="card-image" href="#newsletter"><img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy"></a>
                <span class="category">{{ $post->category }}</span>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->excerpt }}</p>
                <span class="byline">{{ strtoupper($post->author) }} <i></i> {{ $post->read_time }} MIN READ</span>

                @auth
                    @if (Auth::user()->isAdmin())
                        <div class="mt-4 flex items-center gap-3 text-sm">
                            <a class="font-semibold text-orange-700 hover:text-orange-900" href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this story permanently?')">
                                @csrf
                                @method('DELETE')
                                <button class="font-semibold text-red-600 hover:text-red-800" type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </article>
        @endforeach
    </div></section>
</main>
@endsection