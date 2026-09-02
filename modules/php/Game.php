<?php
/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * DeepDive implementation : © Connor Rask connor@srask.ca
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * Game.php
 *
 * This is the main file for your game logic.
 *
 * In this PHP file, you are going to defines the rules of the game.
 */
declare(strict_types=1);

namespace Bga\Games\DeepDive;

use Bga\GameFramework\Components\Deck;
use Bga\Games\DeepDive\States\Temp;
use Bga\GameFramework\Helpers\Collection;

class Game extends \Bga\GameFramework\Table
{
    public Collection $tilesInfo;

    public Deck $tilesDeck;

    /**
     * Your global variables labels:
     *
     * Here, you can assign labels to global variables you are using for this game. You can use any number of global
     * variables with IDs between 10 and 99. If you want to store any type instead of int, use $this->globals instead.
     *
     * NOTE: afterward, you can get/set the global variables with `getGameStateValue`, `setGameStateInitialValue` or
     * `setGameStateValue` functions.
     */
    public function __construct()
    {
        parent::__construct();

        $this->tilesDeck = $this->deckFactory->createDeck('tiles');

        $this->tilesInfo = new Collection([
            new Tile(1, "green", 2, ["x" => 0, "y" => 0], false, 0),
            new Tile(1, "green", 2, ["x" => 0, "y" => 0], false, 1),
            new Tile(1, "green", 2, ["x" => 0, "y" => 0], false, 2),
            new Tile(1, "yellow", 2, ["x" => 1, "y" => 0], false, 3),
            new Tile(1, "yellow", 2, ["x" => 1, "y" => 0], false, 4),
            new Tile(1, "yellow", 2, ["x" => 1, "y" => 0], false, 5),
            new Tile(2, "yellow", 3, ["x" => 2, "y" => 0], false, 6),
            new Tile(2, "yellow", 3, ["x" => 2, "y" => 0], false, 7),
            new Tile(4, "green", 6, ["x" => 3, "y" => 0], false, 8),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 9),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 10),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 11),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 12),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 13),
            new Tile(2, "predator", 0, ["x" => 4, "y" => 0], false, 14),
            new Tile(2, "rock", 0, ["x" => 5, "y" => 0], false, 15),
            new Tile(2, "rock", 0, ["x" => 5, "y" => 0], false, 16),
            new Tile(2, "rock", 0, ["x" => 5, "y" => 0], false, 17),
            new Tile(2, "rock", 0, ["x" => 5, "y" => 0], false, 18),
            new Tile(2, "rock", 0, ["x" => 5, "y" => 0], false, 19),
            new Tile(2, "pink", 3, ["x" => 6, "y" => 0], true, 20),
            new Tile(3, "predator", 0, ["x" => 7, "y" => 0], true, 21),
            new Tile(3, "predator", 0, ["x" => 7, "y" => 0], true, 22),
            new Tile(2, "green", 2, ["x" => 8, "y" => 0], false, 23),
            new Tile(2, "green", 2, ["x" => 8, "y" => 0], false, 24),
            new Tile(4, "green", 5, ["x" => 9, "y" => 0], false, 25),
            new Tile(1, "pink", 2, ["x" => 0, "y" => 1], false, 26),
            new Tile(1, "pink", 2, ["x" => 0, "y" => 1], false, 27),
            new Tile(1, "pink", 2, ["x" => 0, "y" => 1], false, 28),
            new Tile(2, "green", 3, ["x" => 1, "y" => 1], false, 29),
            new Tile(2, "green", 3, ["x" => 1, "y" => 1], false, 30),
            new Tile(2, "pink", 3, ["x" => 2, "y" => 1], false, 31),
            new Tile(2, "pink", 3, ["x" => 2, "y" => 1], false, 32),
            new Tile(4, "yellow", 6, ["x" => 3, "y" => 1], false, 33),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 34),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 35),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 36),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 37),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 38),
            new Tile(3, "predator", 0, ["x" => 4, "y" => 1], false, 39),
            new Tile(3, "green", 3, ["x" => 6, "y" => 1], true, 40),
            new Tile(4, "predator", 0, ["x" => 7, "y" => 1], true, 41),
            new Tile(4, "predator", 0, ["x" => 7, "y" => 1], true, 42),
            new Tile(2, "yellow", 2, ["x" => 8, "y" => 1], false, 43),
            new Tile(2, "yellow", 2, ["x" => 8, "y" => 1], false, 44),
            new Tile(4, "yellow", 5, ["x" => 9, "y" => 1], false, 45),
            new Tile(3, "green", 4, ["x" => 0, "y" => 2], false, 46),
            new Tile(3, "green", 4, ["x" => 0, "y" => 2], false, 47),
            new Tile(3, "yellow", 4, ["x" => 1, "y" => 2], false, 48),
            new Tile(3, "yellow", 4, ["x" => 1, "y" => 2], false, 49),
            new Tile(3, "pink", 4, ["x" => 2, "y" => 2], false, 50),
            new Tile(3, "pink", 4, ["x" => 2, "y" => 2], false, 51),
            new Tile(4, "pink", 6, ["x" => 3, "y" => 2], false, 52),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 53),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 54),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 55),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 56),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 57),
            new Tile(4, "predator", 0, ["x" => 4, "y" => 2], false, 58),
            new Tile(3, "yellow", 3, ["x" => 6, "y" => 2], true, 59),
            new Tile(5, "predator", 0, ["x" => 7, "y" => 2], true, 60),
            new Tile(5, "predator", 0, ["x" => 7, "y" => 2], true, 61),
            new Tile(5, "predator", 0, ["x" => 7, "y" => 2], true, 62),
            new Tile(2, "pink", 2, ["x" => 8, "y" => 2], false, 63),
            new Tile(2, "pink", 2, ["x" => 8, "y" => 2], false, 64),
            new Tile(4, "pink", 5, ["x" => 9, "y" => 2], false, 65),
            new Tile(5, "green", 9, ["x" => 0, "y" => 3], false, 66),
            new Tile(5, "yellow", 9, ["x" => 1, "y" => 3], false, 67),
            new Tile(5, "pink", 9, ["x" => 2, "y" => 3], false, 68),
            new Tile(1, "predator", 0, ["x" => 3, "y" => 3], false, 69),
            new Tile(1, "predator", 0, ["x" => 3, "y" => 3], false, 70),
            new Tile(1, "predator", 0, ["x" => 3, "y" => 3], false, 71),
            new Tile(1, "predator", 0, ["x" => 3, "y" => 3], false, 72),
            new Tile(1, "predator", 0, ["x" => 3, "y" => 3], false, 73),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 74),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 75),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 76),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 77),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 78),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 79),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 80),
            new Tile(5, "predator", 0, ["x" => 4, "y" => 3], false, 81),
            new Tile(3, "pink", 3, ["x" => 6, "y" => 3], true, 82),
            new Tile(1, "bubbles", 0, ["x" => 7, "y" => 3], true, 83),
            new Tile(1, "bubbles", 0, ["x" => 7, "y" => 3], true, 84),
            new Tile(2, "green", 4, ["x" => 8, "y" => 3], false, 85),
            new Tile(4, "green", 7, ["x" => 9, "y" => 3], false, 86),
            new Tile(1, "bubbles", 0, ["x" => 0, "y" => 4], false, 87),
            new Tile(1, "bubbles", 0, ["x" => 0, "y" => 4], false, 88),
            new Tile(1, "bubbles", 0, ["x" => 0, "y" => 4], false, 89),
            new Tile(1, "bubbles", 0, ["x" => 0, "y" => 4], false, 90),
            new Tile(2, "bubbles", 0, ["x" => 1, "y" => 4], false, 91),
            new Tile(2, "bubbles", 0, ["x" => 1, "y" => 4], false, 92),
            new Tile(2, "bubbles", 0, ["x" => 1, "y" => 4], false, 93),
            new Tile(3, "bubbles", 0, ["x" => 2, "y" => 4], false, 94),
            new Tile(3, "bubbles", 0, ["x" => 2, "y" => 4], false, 95),
            new Tile(3, "bubbles", 0, ["x" => 2, "y" => 4], false, 96),
            new Tile(3, "bubbles", 0, ["x" => 2, "y" => 4], false, 97),
            new Tile(4, "bubbles", 0, ["x" => 3, "y" => 4], false, 98),
            new Tile(4, "bubbles", 0, ["x" => 3, "y" => 4], false, 99),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 100),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 101),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 102),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 103),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 104),
            new Tile(1, "rock", 0, ["x" => 4, "y" => 4], false, 105),
            new Tile(4, "green", 6, ["x" => 6, "y" => 4], true, 106),
            new Tile(2, "bubbles", 0, ["x" => 7, "y" => 4], true, 107),
            new Tile(2, "yellow", 4, ["x" => 8, "y" => 4], false, 108),
            new Tile(4, "yellow", 7, ["x" => 9, "y" => 4], false, 109),
            new Tile(1, "pink", 2, ["x" => 1, "y" => 5], true, 110),
            new Tile(1, "green", 2, ["x" => 2, "y" => 5], true, 111),
            new Tile(1, "yellow", 2, ["x" => 3, "y" => 5], true, 112),
            new Tile(2, "green", 3, ["x" => 4, "y" => 5], true, 113),
            new Tile(2, "yellow", 3, ["x" => 5, "y" => 5], true, 114),
            new Tile(4, "yellow", 6, ["x" => 6, "y" => 5], true, 115),
            new Tile(3, "bubbles", 0, ["x" => 7, "y" => 5], true, 116),
            new Tile(3, "bubbles", 0, ["x" => 7, "y" => 5], true, 117),
            new Tile(3, "bubbles", 0, ["x" => 7, "y" => 5], true, 118),
            new Tile(2, "pink", 4, ["x" => 8, "y" => 5], false, 119),
            new Tile(4, "pink", 7, ["x" => 9, "y" => 5], false, 120),
            new Tile(4, "pink", 6, ["x" => 0, "y" => 6], true, 121),
            new Tile(5, "green", 9, ["x" => 1, "y" => 6], true, 122),
            new Tile(5, "yellow", 9, ["x" => 2, "y" => 6], true, 123),
            new Tile(5, "pink", 9, ["x" => 3, "y" => 6], true, 124),
            new Tile(1, "predator", 0, ["x" => 5, "y" => 6], true, 125),
            new Tile(2, "predator", 0, ["x" => 6, "y" => 6], true, 126),
            new Tile(2, "predator", 0, ["x" => 6, "y" => 6], true, 127),
            new Tile(4, "bubbles", 0, ["x" => 7, "y" => 6], true, 128),
            new Tile(2, "green", 4, ["x" => 8, "y" => 6], true, 129),
            new Tile(5, "green", 8, ["x" => 9, "y" => 6], false, 130),
            new Tile(1, "rock", 0, ["x" => 0, "y" => 7], true, 131),
            new Tile(1, "rock", 0, ["x" => 0, "y" => 7], true, 132),
            new Tile(2, "rock", 0, ["x" => 1, "y" => 7], true, 133),
            new Tile(2, "rock", 0, ["x" => 1, "y" => 7], true, 134),
            new Tile(1, "green", 1, ["x" => 2, "y" => 7], false, 135),
            new Tile(1, "green", 1, ["x" => 2, "y" => 7], false, 136),
            new Tile(1, "green", 1, ["x" => 2, "y" => 7], false, 137),
            new Tile(1, "yellow", 1, ["x" => 3, "y" => 7], false, 138),
            new Tile(1, "yellow", 1, ["x" => 3, "y" => 7], false, 139),
            new Tile(1, "yellow", 1, ["x" => 3, "y" => 7], false, 140),
            new Tile(1, "pink", 1, ["x" => 4, "y" => 7], false, 141),
            new Tile(1, "pink", 1, ["x" => 4, "y" => 7], false, 142),
            new Tile(1, "pink", 1, ["x" => 4, "y" => 7], false, 143),
            new Tile(1, "green", 1, ["x" => 5, "y" => 7], true, 144),
            new Tile(1, "yellow", 1, ["x" => 6, "y" => 7], true, 145),
            new Tile(1, "pink", 1, ["x" => 7, "y" => 7], true, 146),
            new Tile(2, "yellow", 4, ["x" => 8, "y" => 7], true, 147),
            new Tile(5, "yellow", 8, ["x" => 9, "y" => 7], false, 148),
            new Tile(2, "pink", 4, ["x" => 0, "y" => 8], true, 149),
            new Tile(3, "green", 3, ["x" => 1, "y" => 8], false, 150),
            new Tile(3, "yellow", 3, ["x" => 2, "y" => 8], false, 151),
            new Tile(3, "pink", 3, ["x" => 3, "y" => 8], false, 152),
            new Tile(3, "green", 5, ["x" => 4, "y" => 8], false, 153),
            new Tile(3, "yellow", 5, ["x" => 5, "y" => 8], false, 154),
            new Tile(3, "pink", 5, ["x" => 6, "y" => 8], false, 155),
            new Tile(5, "pink", 8, ["x" => 9, "y" => 8], false, 156),
            new Tile(5, "green", 10, ["x" => 0, "y" => 9], false, 157),
            new Tile(5, "yellow", 10, ["x" => 1, "y" => 9], false, 158),
            new Tile(5, "pink", 10, ["x" => 2, "y" => 9], false, 159),
        ]);
    }

    /**
     * Compute and return the current game progression.
     *
     * The number returned must be an integer between 0 and 100.
     *
     * This method is called each time we are in a game state with the "updateGameProgression" property set to true.
     *
     * @return int
     */
    public function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }

    /**
     * Migrate database.
     *
     * You don't have to care about this until your game has been published on BGA. Once your game is on BGA, this
     * method is called everytime the system detects a game running with your old database scheme. In this case, if you
     * change your database scheme, you just have to apply the needed changes in order to update the game database and
     * allow the game to continue to run with your new version.
     *
     * @param int $from_version
     * @return void
     */
    public function upgradeTableDb($from_version)
    {
//       if ($from_version <= 1404301345)
//       {
//            // ! important ! Use `DBPREFIX_<table_name>` for all tables
//
//            $sql = "ALTER TABLE `DBPREFIX_xxxxxxx` ....";
//            $this->applyDbUpgradeToAllDB( $sql );
//       }
//
//       if ($from_version <= 1405061421)
//       {
//            // ! important ! Use `DBPREFIX_<table_name>` for all tables
//
//            $sql = "CREATE TABLE `DBPREFIX_xxxxxxx` ....";
//            $this->applyDbUpgradeToAllDB( $sql );
//       }
    }

    /*
     * Gather all information about current game situation (visible by the current player).
     *
     * The method is called each time the game interface is displayed to a player, i.e.:
     *
     * - when the game starts
     * - when a player refreshes the game page (F5)
     */
    protected function getAllDatas(int $currentPlayerId): array
    {
        $result = [];
        // WARNING: We must only return information visible by the current player (using $currentPlayerId).

        // Get information about players.
        // NOTE: you can retrieve some extra field you added for "player" table in `dbmodel.sql` if you need it.
        $result["players"] = $this->getCollectionFromDb(
            "SELECT `player_id` AS `id`, `player_score` AS `score` FROM `player`"
        );

        // TODO: Gather all information about current game situation (visible by player $currentPlayerId).

        $result["decks"] = [intval($this->tilesDeck->countCardsInLocation('depth1Deck')), 
                            intval($this->tilesDeck->countCardsInLocation('depth2Deck')), 
                            intval($this->tilesDeck->countCardsInLocation('depth3Deck')), 
                            intval($this->tilesDeck->countCardsInLocation('depth4Deck')),
                            intval($this->tilesDeck->countCardsInLocation('depth5Deck'))];

        foreach ($this->loadPlayersBasicInfos() as $id => $info) {
            $result["players"][$id]["meeples"] = [$this->getUniqueValueFromDB("SELECT `meeple1` FROM `player` WHERE `player_id` = $id"),
                                                $this->getUniqueValueFromDB("SELECT `meeple2` FROM `player` WHERE `player_id` = $id"),
                                                $this->getUniqueValueFromDB("SELECT `meeple3` FROM `player` WHERE `player_id` = $id")];

        }

        return $result;
    }

    /**
     * This method is called only once, when a new game is launched. In this method, you must setup the game
     *  according to the game rules, so that the game is ready to be played.
     */
    protected function setupNewGame($players, $options = [])
    {
        // Set the colors of the players with HTML color code. The default below is red/green/blue/orange/brown. The
        // number of colors defined here must correspond to the maximum number of players allowed for the gams.
        $gameinfos = $this->getGameinfos();
        $default_colors = $gameinfos['player_colors'];
        $query_values = [];

        foreach ($players as $player_id => $player) {
            // Now you can access both $player_id and $player array
            $query_values[] = vsprintf("(%s, '%s', '%s')", [
                $player_id,
                array_shift($default_colors),
                addslashes($player["player_name"]),
            ]);
        }

        // Create players based on generic information.
        //
        // NOTE: You can add extra field on player table in the database (see dbmodel.sql) and initialize
        // additional fields directly here.
        static::DbQuery(
            sprintf(
                "INSERT INTO `player` (`player_id`, `player_color`, `player_name`) VALUES %s",
                implode(",", $query_values)
            )
        );

        $this->reattributeColorsBasedOnPreferences($players, $gameinfos["player_colors"]);
        $this->reloadPlayersBasicInfos();

        // Init global values with their initial values.

        // Init game statistics.
        //
        // NOTE: statistics used in this file must be defined in your `stats.inc.php` file.

        // Dummy content.
        // $this->tableStats->init('table_teststat1', 0);
        // $this->playerStats->init('player_teststat1', 0);

        // TODO: Setup the initial game situation here.

        $tempInfo = $this->tilesInfo;
        
        if ($this->getPlayerCount() < 4) {
            $tempInfo = $tempInfo->filter(fn($tile) => !$tile->highPlayerCount);
        }

        $tempInfo = $tempInfo->map(fn($tile) => ["type" => $tile->type, "type_arg" => $tile->id, "nbr" => 1, "location" => $tile->depth]);

        for ($i = 1; $i <= 5; $i++) {
            $this->tilesDeck->createCards($tempInfo->filter(fn($tile) => $tile["location"] == $i)->values(), 'depth' . $i . 'Deck');
            $this->tilesDeck->shuffle('depth' . $i . 'Deck');
        }

        // Activate first player once everything has been initialized and ready.
        $this->activeNextPlayer();

        return Temp::class;
    }

    /**
     * Example of debug function.
     * Here, jump to a state you want to test (by default, jump to next player state)
     * You can trigger it on Studio using the Debug button on the right of the top bar.
     */
    public function debug_goToState(int $state = 3) {
        $this->gamestate->jumpToState($state);
    }

    /**
     * Another example of debug function, to easily test the zombie code.
     */
    public function debug_playOneMove() {
        $this->bga->debug->playUntil(fn(int $count) => $count == 1);
    }

    /*
    Another example of debug function, to easily create situations you want to test.
    Here, put a card you want to test in your hand (assuming you use the Deck component).

    public function debug_setCardInHand(int $cardType, int $playerId) {
        $card = array_values($this->cards->getCardsOfType($cardType))[0];
        $this->cards->moveCard($card['id'], 'hand', $playerId);
    }
    */
}

class Tile {
    public int $depth;
    public string $type;
    public int $points;
    public array $coords;
    public bool $highPlayerCount;
    public int $id;

    public function __construct(int $depth, string $type, int $points, array $coords, bool $playerCount, int $id)
    {
        $this->depth = $depth;
        $this->points = $points;
        $this->type = $type;
        $this->coords = $coords;
        $this->highPlayerCount = $playerCount;
        $this->id = $id;
    }

    public function getInfo() {
        return ["depth" => $this->depth, "type" => $this->type, "points" => $this->points, "coords" => $this->coords, "id" => $this->id];
    }
}