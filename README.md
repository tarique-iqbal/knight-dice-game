# Knight Dice game
A small command-line utility that does the following thing:
* Any number of knights in a circle
* Each knight has the same number of life points (e.g. 100)
* The game runs in turn:
  * Each player rolls a dice (d6); the number rolled is subtracted from the next player's life points
  * Then it is the next player's turn
  * Knight die if their life points <= 0
  * Dead knights are removed from the field
* The game is over when only one knight is left on the field
* Notes: No interaction (input), the game should play itself in a loop.
* Output: The last knight, who won the game!

## Prerequisites
```
composer
php (>=7.4)
```

## Installation and Run the script
- All the `code` required to get started
- Clone this repo to your local machine using
```shell
$ git clone https://github.com/tarique-iqbal/knight-dice-game.git
```

- Need write permission to following `directory`
`./var/logs`

- Install the script
```shell
$ cd /path/to/base/directory
$ composer install --no-dev
```

- Run the script and sample output where number players two
```shell
$ php index.php
Winner: Knight 4 won the game.
```

## Running the tests
- Follow Install instructions.

Adapt `phpunit.xml.dist` PHP Constant according to your setup environment.

```shell
$ cd /path/to/base/directory
$ composer update
$ ./vendor/bin/phpunit tests
```

Test-cases, test unit and integration tests.