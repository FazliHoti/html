const renderPlaceholder = (root) => {
    root.innerHTML = `
        <div class="flex h-64 items-center justify-center p-6">
            <div>
                <p class="text-lg font-semibold text-white">${root.dataset.gameName || 'Game'}</p>
                <p class="mt-2 text-sm text-slate-400">This browser game is loading.</p>
            </div>
        </div>
    `;
};

const renderExternalGame = (root) => {
    const gameUrl = root.dataset.gameUrl;
    const gameName = root.dataset.gameName || 'Open source game';

    if (!gameUrl) {
        renderPlaceholder(root);
        return;
    }

    root.innerHTML = `
        <style>
            .game-shell:fullscreen { display: flex; flex-direction: column; width: 100vw; height: 100vh; border: 0; border-radius: 0; }
            .game-shell:fullscreen iframe { flex: 1; width: 100%; height: auto; min-height: 0; }
        </style>
        <div class="game-shell overflow-hidden rounded-2xl border border-slate-700 bg-slate-950">
            <div class="flex items-center justify-between gap-3 border-b border-slate-700 bg-slate-900 px-4 py-3">
                <span class="text-xs font-medium uppercase tracking-[0.2em] text-slate-300">Self-hosted game</span>
                <button type="button" class="fullscreen-game-btn rounded-full border border-cyan-500/60 bg-cyan-500/10 px-3 py-1.5 text-xs font-semibold text-cyan-200 transition hover:border-cyan-400 hover:bg-cyan-500/20">
                    Fullscreen
                </button>
            </div>
            <iframe
                src="${gameUrl}"
                title="${gameName}"
                class="h-[30rem] w-full border-0 bg-slate-950"
                loading="lazy"
                allow="fullscreen"
                allowfullscreen
                scrolling="no"
                tabindex="0"
            ></iframe>
        </div>
    `;

    const gameShell = root.querySelector('.game-shell');
    const fullscreenButton = root.querySelector('.fullscreen-game-btn');
    const iframe = root.querySelector('iframe');

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
            } catch (error) {
                console.warn('Fullscreen request was blocked:', error);
            }
        });

        document.addEventListener('fullscreenchange', () => {
            fullscreenButton.textContent = document.fullscreenElement === gameShell ? 'Exit Fullscreen' : 'Fullscreen';
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('game-display');
    if (!root) return;

    renderExternalGame(root);
});
