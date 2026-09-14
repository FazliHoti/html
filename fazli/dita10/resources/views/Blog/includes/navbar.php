<header class="site-header">
	<a class="brand" href="<?= route('home') ?>" aria-label="Field Notes home"><span class="brand-mark"></span><span>field notes</span></a>
	<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">Menu</button>
	<nav id="site-nav" class="site-nav" aria-label="Main navigation">
		<a class="<?= request()->routeIs('home') ? 'active' : '' ?>" href="<?= route('home') ?>#journal">Journal</a>
		<a href="<?= route('home') ?>#stories">Stories</a>
		<a class="<?= request()->routeIs('about') ? 'active' : '' ?>" href="<?= route('about') ?>">About</a>
		<button class="search-button" type="button" aria-expanded="false" aria-controls="search-panel" aria-label="Open search">Search <span>⌕</span></button>
		<a class="subscribe-link" href="<?= route('home') ?>#newsletter">Subscribe</a>
	</nav>
</header>
