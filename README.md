## How to Play

`php artisan game:start`

Available options:
- `--rounds` (default: 100)
- `--players` (default: 2)

## Contents

- `App\Classes\GameHandler` - class that incapsulates main game logic.
- `App\Classes\GameRound` - class that is responsible for handling round actions.
- `App\Classes\GamePlayer` - class that represents player in the game.
- `App\Classes\Dice` - class that represents a dice object in the game.
- `App\Classes\GameStatistics` - class that stores all the data about the game progress.
- `App\Console\Commands\DoubleDiceGame` - command class that handles input, initializes game parameters and running the game.
