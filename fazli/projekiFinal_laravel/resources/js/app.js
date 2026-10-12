const renderPlaceholder = (root) => {
    const message = document.createElement('div');
    message.className = 'game-empty';

    const content = document.createElement('div');
    const title = document.createElement('p');
    title.className = 'font-serif text-3xl text-white';
    title.textContent = root.dataset.gameName || 'Game';

    const description = document.createElement('p');
    description.className = 'mx-auto mt-3 max-w-md text-sm leading-6 text-zinc-300';
    description.textContent = 'This game is on the shelf, but it does not have a playable version attached yet.';

    content.append(title, description);
    message.append(content);
    root.replaceChildren(message);
};

const renderExternalGame = (root) => {
    const gameUrl = root.dataset.gameUrl;
    const gameName = root.dataset.gameName || 'Open source game';

    if (!gameUrl) {
        renderPlaceholder(root);
        return;
    }

    const gameShell = document.createElement('div');
    gameShell.className = 'game-shell';

    const toolbar = document.createElement('div');
    toolbar.className = 'flex items-center justify-between gap-3 border-b border-white/10 px-4 py-3';

    const gameLabel = document.createElement('span');
    gameLabel.className = 'text-xs font-semibold uppercase tracking-[0.14em] text-[#cbd4cd]';
    gameLabel.textContent = gameName;

    const fullscreenButton = document.createElement('button');
    fullscreenButton.type = 'button';
    fullscreenButton.className = 'rounded-sm border border-white/25 px-3 py-2 text-xs font-medium text-white transition-colors hover:border-white/60 hover:bg-white/5';
    fullscreenButton.textContent = 'Fullscreen';
    fullscreenButton.setAttribute('aria-label', `Play ${gameName} in fullscreen`);

    const iframe = document.createElement('iframe');
    iframe.src = gameUrl;
    iframe.title = gameName;
    iframe.loading = 'lazy';
    iframe.allow = 'fullscreen';
    iframe.scrolling = 'no';
    iframe.tabIndex = 0;

    toolbar.append(gameLabel, fullscreenButton);
    gameShell.append(toolbar, iframe);
    root.replaceChildren(gameShell);

    if (fullscreenButton && gameShell) {
        fullscreenButton.addEventListener('click', async () => {
            try {
                if (document.fullscreenElement) {
                    await document.exitFullscreen();
                    return;
                }

                if (gameShell.requestFullscreen) {
                    await gameShell.requestFullscreen();
                    return;
                }

                if (iframe && iframe.requestFullscreen) {
                    await iframe.requestFullscreen();
                }
            } catch {
                fullscreenButton.textContent = 'Fullscreen unavailable';
            }
        });

        document.addEventListener('fullscreenchange', () => {
            const isFullscreen = document.fullscreenElement === gameShell;
            fullscreenButton.textContent = isFullscreen ? 'Exit fullscreen' : 'Fullscreen';
            fullscreenButton.setAttribute('aria-label', isFullscreen ? `Exit fullscreen for ${gameName}` : `Play ${gameName} in fullscreen`);
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('game-display');
    if (!root) return;

    renderExternalGame(root);

    const iframe = root.querySelector('iframe');
    const scoreField = document.getElementById('player-score');
    const scoreFeedback = document.getElementById('score-feedback');

    window.addEventListener('message', (event) => {
        const message = event.data;

        if (
            event.origin !== window.location.origin
            || event.source !== iframe?.contentWindow
            || message?.type !== 'playforge:score'
            || message.gameSlug !== root.dataset.gameSlug
            || !Number.isSafeInteger(message.score)
            || message.score < 0
            || !scoreField
        ) {
            return;
        }

        scoreField.value = String(message.score);
        scoreField.dispatchEvent(new Event('input', { bubbles: true }));

        if (scoreFeedback) {
            scoreFeedback.textContent = `Your ${message.score}-point run is ready to save below.`;
            scoreFeedback.hidden = false;
        }
    });
});

document.addEventListener('error', (event) => {
    const image = event.target;

    if (!(image instanceof HTMLImageElement) || !image.classList.contains('game-art-image')) return;

    const fallback = document.createElement('div');
    fallback.className = `${image.className.replace('game-art-image', '').replace('object-cover', '')} game-art-fallback`;
    fallback.dataset.gameArt = image.dataset.gameArt || '';
    fallback.setAttribute('role', 'img');
    fallback.setAttribute('aria-label', image.dataset.artLabel || image.alt || 'Game artwork unavailable');
    fallback.textContent = image.dataset.fallbackMark || image.alt.trim().charAt(0) || '✦';
    image.replaceWith(fallback);
}, true);
