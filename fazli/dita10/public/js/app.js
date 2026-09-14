const menuToggle = document.querySelector('.menu-toggle');
const siteNav = document.querySelector('.site-nav');
const searchButton = document.querySelector('.search-button');
const searchPanel = document.querySelector('#search-panel');
const searchInput = document.querySelector('#story-search');
const searchResult = document.querySelector('.search-result');
const cards = [...document.querySelectorAll('.story-card')];

menuToggle?.addEventListener('click', () => {
    const isOpen = siteNav.classList.toggle('open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
});

searchButton?.addEventListener('click', () => {
    if (!searchPanel) return;
    const isOpen = searchPanel.hasAttribute('hidden');
    searchPanel.toggleAttribute('hidden');
    searchButton.setAttribute('aria-expanded', String(isOpen));
    if (isOpen) searchInput.focus();
});

document.querySelectorAll('.filter').forEach((button) => {
    button.addEventListener('click', () => {
        document.querySelector('.filter.active')?.classList.remove('active');
        button.classList.add('active');
        const filter = button.dataset.filter;
        cards.forEach((card) => card.classList.toggle('is-hidden', filter !== 'all' && card.dataset.category !== filter));
    });
});

searchInput?.addEventListener('input', () => {
    const query = searchInput.value.trim().toLowerCase();
    let matches = 0;
    cards.forEach((card) => {
        const matchesQuery = !query || card.dataset.title.toLowerCase().includes(query) || card.dataset.category.includes(query);
        card.classList.toggle('is-hidden', !matchesQuery);
        if (matchesQuery) matches += 1;
    });
    searchResult.textContent = query ? `${matches} ${matches === 1 ? 'story' : 'stories'} found` : '';
});

document.querySelector('#subscribe-form')?.addEventListener('submit', (event) => {
    event.preventDefault();
    const form = event.currentTarget;
    const message = form.nextElementSibling;
    message.textContent = 'You’re on the list. Welcome.';
    form.reset();
});