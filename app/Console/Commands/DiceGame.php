<?php

namespace App\Console\Commands;

use App\Classes\ClassicRules;
use App\Classes\DiceGameHandler;
use App\Classes\GamePlayer;
use Illuminate\Console\Command;

class DiceGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dice-game:start {--players=2} {--rounds=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dice Game';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DiceGameHandler $handler)
    {
        $rounds = $this->option('rounds');
        $players = $this->option('players');

        $this->line("Start dice game for $players players for $rounds rounds.");

        for ($i = 0; $i < $players; $i++) {
            $handler->addPlayer(new GamePlayer);
        }

        $handler->setRules(new ClassicRules)->setRounds($rounds);
        $handler->play();

        $this->line("Game statistics:");

        foreach ($handler->getStatistics()->byPlayer() as $player => $stats) {
            $this->line($player . " - Wins: {$stats['wins']}, Draws: {$stats['draws']}");
        }

        $this->line("Winner is: " . $handler->getWinner()->getName());
    }
}
