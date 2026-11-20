<?php
declare(strict_types=1);

namespace Bga\Games\DeepDive\States;

use Bga\GameFramework\StateType;
use Bga\GameFramework\States\GameState;
use Bga\GameFramework\States\PossibleAction;
use Bga\Games\DeepDive\Game;

class PlayerTurn extends GameState
{
    function __construct(
        protected Game $game,
    ) {
        parent::__construct($game,
            id: 10,
            type: StateType::ACTIVE_PLAYER,

            // optional
            description: clienttranslate('${actplayer} must pick a tile'),
            descriptionMyTurn: clienttranslate('${you} must pick a tile'),
            transitions: [],
        );
    }

    public function getArgs(int $activePlayerId): array
    {
        // the data sent to the front when entering the state
        return [
            "depth" => $this->game->getUniqueValueFromDB("SELECT `depth` FROM `player` WHERE `player_id` = $activePlayerId")
        ];
    } 

    function onEnteringState(int $activePlayerId) {
        // the code to run when entering the state
    }   

    #[PossibleAction]
    public function actDoAction(int $activePlayerId, int $tileId) {


        $this->notify->all("test", '', [
            "test" => $tileId
        ]);
    }

    function zombie(int $playerId): string {
        // the code to run when the player is a Zombie
        return "";
    }
}