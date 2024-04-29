<?php

namespace App\Console\Commands;

use App\Classes\GameHandler;
use App\Classes\GamePlayer;
use Illuminate\Console\Command;

class DoubleDiceGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:start {--rounds=100} {--players=2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Double Dice Game';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GameHandler $handler)
    {
        $rounds = $this->option('rounds');
        $players = $this->option('players');

        $this->line("Start game for $players players for $rounds rounds");

        for ($i = 0; $i < $players; $i++) {
            $handler->addPlayer(new GamePlayer);
        }

        $handler->setRounds($rounds)->play();
        $handler->getStatistics()->print();
        $this->line("Winner is: " . $handler->getWinner()->getKey());
    }
}
