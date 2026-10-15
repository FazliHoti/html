<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('games', 'embed_url')) {
            Schema::table('games', function (Blueprint $table) {
                $table->string('embed_url', 2048)->nullable();
            });
        }

        $embedUrls = [
            '2048' => '/games/2048.html',
            'snake' => '/games/snake.html',
            'tetris' => '/games/tetris.html',
            'breakout' => '/games/breakout.html',
            'pong' => '/games/pong.html',
            'neon-drift' => '/games/neon-drift.html',
            'memory-match' => '/games/memory-match.html',
            'flappy-finch' => '/games/flappy-finch.html',
            'whack-a-mole' => '/games/whack-a-mole.html',
            'simon-says' => '/games/simon-says.html',
            'space-blaster' => '/games/arcade.html?title=Space%20Blaster&mode=shooter',
            'turbo-hoops' => '/games/arcade.html?title=Turbo%20Hoops&mode=shooter',
            'word-sprint' => '/games/arcade.html?title=Word%20Sprint&mode=runner',
            'pixel-runner' => '/games/arcade.html?title=Pixel%20Runner&mode=runner',
            'tower-tactics' => '/games/arcade.html?title=Tower%20Tactics&mode=shooter',
            'asteroid-dash' => '/games/arcade.html?title=Asteroid%20Dash&mode=shooter',
            'minesweeper' => '/games/arcade.html?title=Minesweeper&mode=runner',
            'penalty-rush' => '/games/arcade.html?title=Penalty%20Rush&mode=shooter',
            'traffic-surge' => '/games/arcade.html?title=Traffic%20Surge&mode=runner',
        ];

        foreach ($embedUrls as $slug => $embedUrl) {
            DB::table('games')->where('slug', (string) $slug)->update(['embed_url' => $embedUrl]);
        }
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('embed_url');
        });
    }
};
