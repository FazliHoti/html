const assignGameScore = (value) => {
    const scoreInput = document.querySelector('input[name="score"]');
    if (scoreInput) {
        scoreInput.value = value;
    }
};

const renderPlaceholder = (root) => {
    root.innerHTML = `
        <div class="flex h-64 items-center justify-center p-6">
            <div>
                <p class="text-lg font-semibold text-white">${root.dataset.gameName || 'Game'}</p>
                <p class="mt-2 text-sm text-slate-400">The browser game is ready to play.</p>
            </div>
        </div>
    `;
};

const renderSpaceDodgeGame = (root) => {
    root.innerHTML = `
        <div class="flex h-64 flex-col gap-3 p-4">
            <div class="flex items-center justify-between text-sm text-slate-300">
                <span>Score: <strong id="space-dodge-score">0</strong></span>
                <button id="space-dodge-start" class="rounded-full bg-cyan-500 px-3 py-1 text-xs font-semibold text-slate-950">Start</button>
            </div>
            <canvas id="space-canvas" width="300" height="180" class="w-full rounded-xl border border-slate-700 bg-slate-950"></canvas>
            <div class="flex items-center justify-between gap-3 text-xs text-slate-400">
                <span>Move with arrow keys or tap a direction</span>
                <div class="flex gap-2">
                    <button type="button" data-move="left" aria-label="Move left" class="rounded-lg bg-slate-800 px-3 py-2 text-white">←</button>
                    <button type="button" data-move="up" aria-label="Move up" class="rounded-lg bg-slate-800 px-3 py-2 text-white">↑</button>
                    <button type="button" data-move="down" aria-label="Move down" class="rounded-lg bg-slate-800 px-3 py-2 text-white">↓</button>
                    <button type="button" data-move="right" aria-label="Move right" class="rounded-lg bg-slate-800 px-3 py-2 text-white">→</button>
                </div>
            </div>
        </div>
    `;

    const canvas = document.getElementById('space-canvas');
    const ctx = canvas.getContext('2d');
    const startButton = document.getElementById('space-dodge-start');
    const scoreLabel = document.getElementById('space-dodge-score');
    let gameLoopId = null;
    let score = 0;
    let player = { x: 130, y: 140, width: 24, height: 24, speed: 4 };
    let keys = { ArrowLeft: false, ArrowRight: false, ArrowUp: false, ArrowDown: false };
    let enemies = [];
    let running = false;

    const reset = () => {
        player.x = 130;
        player.y = 140;
        enemies = [];
        score = 0;
        scoreLabel.textContent = '0';
    };

    const handleKey = (event, isPressed) => {
        if (keys[event.key] !== undefined) {
            keys[event.key] = isPressed;
        }
    };

    const spawnEnemy = () => {
        const size = 20 + Math.random() * 12;
        enemies.push({
            x: Math.random() * (canvas.width - size),
            y: -size,
            width: size,
            height: size,
            speed: 2 + Math.random() * 2,
        });
    };

    const update = () => {
        if (!running) return;

        if (keys.ArrowLeft) player.x -= player.speed;
        if (keys.ArrowRight) player.x += player.speed;
        if (keys.ArrowUp) player.y -= player.speed;
        if (keys.ArrowDown) player.y += player.speed;

        player.x = Math.min(Math.max(player.x, 0), canvas.width - player.width);
        player.y = Math.min(Math.max(player.y, 0), canvas.height - player.height);

        if (Math.random() < 0.07) spawnEnemy();
        enemies.forEach((enemy) => {
            enemy.y += enemy.speed;
        });
        enemies = enemies.filter((enemy) => enemy.y < canvas.height + enemy.height);

        if (enemies.some((enemy) => (
            player.x < enemy.x + enemy.width &&
            player.x + player.width > enemy.x &&
            player.y < enemy.y + enemy.height &&
            player.y + player.height > enemy.y
        ))) {
            running = false;
            clearInterval(gameLoopId);
            assignGameScore(score);
            const final = document.createElement('div');
            final.className = 'mt-2 text-xs font-semibold text-rose-300';
            final.textContent = 'Game over! Final score: ' + score;
            root.appendChild(final);
            return;
        }

        score += 1;
        scoreLabel.textContent = String(score);
    };

    const draw = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#020617';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#22d3ee';
        ctx.fillRect(player.x, player.y, player.width, player.height);

        ctx.fillStyle = '#f87171';
        enemies.forEach((enemy) => {
            ctx.fillRect(enemy.x, enemy.y, enemy.width, enemy.height);
        });
    };

    const loop = () => {
        update();
        draw();
    };

    startButton.addEventListener('click', () => {
        reset();
        running = true;
        if (gameLoopId) clearInterval(gameLoopId);
        gameLoopId = setInterval(loop, 30);
    });

    root.querySelectorAll('[data-move]').forEach((button) => {
        button.addEventListener('click', () => {
            const movement = button.dataset.move;
            if (movement === 'left') player.x -= 18;
            if (movement === 'right') player.x += 18;
            if (movement === 'up') player.y -= 18;
            if (movement === 'down') player.y += 18;
            player.x = Math.min(Math.max(player.x, 0), canvas.width - player.width);
            player.y = Math.min(Math.max(player.y, 0), canvas.height - player.height);
            draw();
        });
    });

    document.addEventListener('keydown', (event) => handleKey(event, true));
    document.addEventListener('keyup', (event) => handleKey(event, false));
    draw();
};

const renderMemoryMatchGame = (root) => {
    const symbols = ['★', '☀', '✦', '◆', '☾', '✧'];
    const deck = [...symbols, ...symbols].sort(() => Math.random() - 0.5).map((symbol, index) => ({ id: index, symbol, matched: false, revealed: false }));
    let firstCard = null;
    let secondCard = null;
    let locked = false;
    let score = 0;
    let moves = 0;

    root.innerHTML = `
        <div class="p-4">
            <div class="mb-2 flex items-center justify-between text-sm text-slate-300">
                <span>Moves: <strong id="memory-moves">0</strong></span>
                <span>Score: <strong id="memory-score">0</strong></span>
            </div>
            <div id="memory-grid" class="grid grid-cols-4 gap-2"></div>
        </div>
    `;

    const grid = document.getElementById('memory-grid');
    const scoreLabel = document.getElementById('memory-score');
    const movesLabel = document.getElementById('memory-moves');

    const flipCard = (card) => {
        if (locked || card.matched || card.revealed) return;
        card.revealed = true;
        renderBoard();

        if (!firstCard) {
            firstCard = card;
            return;
        }

        secondCard = card;
        moves += 1;
        movesLabel.textContent = String(moves);

        if (firstCard.symbol === secondCard.symbol) {
            firstCard.matched = true;
            secondCard.matched = true;
            score += 100;
            scoreLabel.textContent = String(score);
            if (deck.every((item) => item.matched)) {
                assignGameScore(score + Math.max(0, 400 - moves * 5));
                const banner = document.createElement('div');
                banner.className = 'mt-3 text-xs font-semibold text-emerald-300';
                banner.textContent = 'Board cleared! Final score: ' + (score + Math.max(0, 400 - moves * 5));
                root.appendChild(banner);
            }
            firstCard = null;
            secondCard = null;
            renderBoard();
            return;
        }

        locked = true;
        setTimeout(() => {
            firstCard.revealed = false;
            secondCard.revealed = false;
            firstCard = null;
            secondCard = null;
            locked = false;
            renderBoard();
        }, 700);
    };

    const renderBoard = () => {
        grid.innerHTML = '';
        deck.forEach((card) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'flex h-16 items-center justify-center rounded-lg border border-slate-700 bg-slate-800 text-xl font-bold text-cyan-300 transition hover:border-cyan-400';
            button.textContent = card.revealed || card.matched ? card.symbol : '?';
            button.style.opacity = card.matched ? '0.8' : '1';
            button.addEventListener('click', () => flipCard(card));
            grid.appendChild(button);
        });
    };

    renderBoard();
};

const renderTurboTrackGame = (root) => {
    root.innerHTML = `
        <div class="flex h-64 flex-col gap-3 p-4">
            <div class="flex items-center justify-between text-sm text-slate-300">
                <span>Score: <strong id="track-score">0</strong></span>
                <button id="track-start" class="rounded-full bg-cyan-500 px-3 py-1 text-xs font-semibold text-slate-950">Start</button>
            </div>
            <canvas id="track-canvas" width="300" height="180" class="w-full rounded-xl border border-slate-700 bg-slate-950"></canvas>
            <div class="flex items-center justify-between gap-3 text-xs text-slate-400">
                <span>Use ← → or tap to change lanes</span>
                <div class="flex gap-2">
                    <button type="button" data-lane="left" aria-label="Move to left lane" class="rounded-lg bg-slate-800 px-4 py-2 text-white">←</button>
                    <button type="button" data-lane="right" aria-label="Move to right lane" class="rounded-lg bg-slate-800 px-4 py-2 text-white">→</button>
                </div>
            </div>
        </div>
    `;

    const canvas = document.getElementById('track-canvas');
    const ctx = canvas.getContext('2d');
    const startButton = document.getElementById('track-start');
    const scoreLabel = document.getElementById('track-score');
    const lanes = [45, 120, 195];
    let score = 0;
    let playerLane = 1;
    let running = false;
    let loopId = null;
    let obstacles = [];

    const reset = () => {
        score = 0;
        obstacles = [];
        playerLane = 1;
        scoreLabel.textContent = '0';
    };

    const update = () => {
        if (!running) return;
        score += 1;
        scoreLabel.textContent = String(score);

        if (Math.random() < 0.08) {
            obstacles.push({ lane: Math.floor(Math.random() * lanes.length), y: -20, size: 24 });
        }

        obstacles.forEach((obstacle) => {
            obstacle.y += 3;
        });

        const hit = obstacles.some((obstacle) => obstacle.lane === playerLane && obstacle.y + obstacle.size > 140 && obstacle.y < 180);
        if (hit) {
            running = false;
            clearInterval(loopId);
            assignGameScore(score);
            const banner = document.createElement('div');
            banner.className = 'mt-2 text-xs font-semibold text-rose-300';
            banner.textContent = 'Crash! Final score: ' + score;
            root.appendChild(banner);
            return;
        }

        obstacles = obstacles.filter((obstacle) => obstacle.y < 200);
    };

    const draw = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = '#020617';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.strokeStyle = '#475569';
        for (let i = 1; i < 3; i++) {
            ctx.beginPath();
            ctx.moveTo((canvas.width / 3) * i, 0);
            ctx.lineTo((canvas.width / 3) * i, canvas.height);
            ctx.stroke();
        }

        ctx.fillStyle = '#22d3ee';
        ctx.fillRect(lanes[playerLane] - 12, 140, 24, 25);

        ctx.fillStyle = '#f97316';
        obstacles.forEach((obstacle) => {
            ctx.fillRect(lanes[obstacle.lane] - 12, obstacle.y, 24, 20);
        });
    };

    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') playerLane = Math.max(0, playerLane - 1);
        if (event.key === 'ArrowRight') playerLane = Math.min(lanes.length - 1, playerLane + 1);
        draw();
    });

    root.querySelectorAll('[data-lane]').forEach((button) => {
        button.addEventListener('click', () => {
            playerLane = button.dataset.lane === 'left'
                ? Math.max(0, playerLane - 1)
                : Math.min(lanes.length - 1, playerLane + 1);
            draw();
        });
    });

    startButton.addEventListener('click', () => {
        reset();
        running = true;
        if (loopId) clearInterval(loopId);
        loopId = setInterval(() => {
            update();
            draw();
        }, 80);
    });

    draw();
};

const renderGoalRushGame = (root) => {
    root.innerHTML = `
        <div class="p-4">
            <div class="mb-2 flex items-center justify-between text-sm text-slate-300">
                <span>Score: <strong id="goal-score">0</strong></span>
                <span>Time: <strong id="goal-time">30</strong>s</span>
                <button id="goal-start" class="rounded-full bg-cyan-500 px-3 py-1 text-xs font-semibold text-slate-950">Start game</button>
            </div>
            <div id="goal-board" class="relative h-52 overflow-hidden rounded-xl border border-slate-700 bg-slate-950" aria-label="Tap the target as many times as possible in 30 seconds">
                <p class="absolute inset-0 flex items-center justify-center text-sm text-slate-400">Tap Start, then hit the target!</p>
            </div>
        </div>
    `;

    const board = document.getElementById('goal-board');
    const scoreLabel = document.getElementById('goal-score');
    const timeLabel = document.getElementById('goal-time');
    const startButton = document.getElementById('goal-start');
    let score = 0;
    let target = null;
    let timer = null;
    let timeLeft = 30;
    let running = false;

    const createTarget = () => {
        const size = 38;
        const x = Math.random() * Math.max(0, board.clientWidth - size);
        const y = Math.random() * Math.max(0, board.clientHeight - size);
        target = { x, y, size };
        board.innerHTML = `
            <button type="button" aria-label="Hit target for 100 points" class="absolute rounded-full bg-emerald-400 text-sm font-black text-slate-950 shadow-lg shadow-emerald-400/30 transition-transform hover:scale-110 active:scale-95" style="left:${x}px; top:${y}px; width:${target.size}px; height:${target.size}px;">+</button>
        `;

        const button = board.querySelector('button');
        button.addEventListener('click', () => {
            if (!running) return;
            score += 100;
            scoreLabel.textContent = String(score);
            assignGameScore(score);
            createTarget();
        });
    };

    const finishGame = () => {
        running = false;
        clearInterval(timer);
        target = null;
        assignGameScore(score);
        board.innerHTML = `<div class="flex h-full flex-col items-center justify-center gap-2 text-white"><p class="text-xl font-black">Time's up!</p><p class="text-sm text-slate-300">Final score: <strong class="text-cyan-300">${score}</strong></p><p class="text-xs text-slate-400">Save your score using the form on this page.</p></div>`;
        startButton.textContent = 'Play again';
    };

    startButton.addEventListener('click', () => {
        clearInterval(timer);
        score = 0;
        timeLeft = 30;
        running = true;
        scoreLabel.textContent = '0';
        timeLabel.textContent = String(timeLeft);
        createTarget();
        timer = setInterval(() => {
            timeLeft -= 1;
            timeLabel.textContent = String(timeLeft);
            if (timeLeft <= 0) finishGame();
        }, 1000);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('game-display');
    if (!root) return;

    const slug = root.dataset.gameSlug;
    const handlers = {
        'space-dodge': renderSpaceDodgeGame,
        'memory-match': renderMemoryMatchGame,
        'turbo-track': renderTurboTrackGame,
        'goal-rush': renderGoalRushGame,
    };

    if (handlers[slug]) {
        handlers[slug](root);
    } else {
        renderPlaceholder(root);
    }
});
