## How to Play

`php artisan dice-game:start`

Available options:
- `--rounds` (default: 100)
- `--players` (default: 2)

## Contents

- `App\Classes\DiceGameHandler` - class that incapsulates overall game logic.
- `App\Classes\ClassicRules` - class that defines game mechanics and winner determination logic.
- `App\Classes\BasicMechanics` - abstract class of game actions.
- `App\Classes\SpecificMechanics` - class that is responsible for game actions on each round.
- `App\Classes\GameRound` - class that is responsible for handling round actions.
- `App\Classes\GamePlayer` - class that represents player in the game.
- `App\Classes\Dice` - class that represents a dice object in the game.
- `App\Classes\GameStatistics` - class that stores all the data about the game progress.
- `App\Console\Commands\DiceGame` - command class that handles input, initializes game parameters and running the game.
