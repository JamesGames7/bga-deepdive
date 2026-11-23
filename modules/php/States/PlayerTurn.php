<?php
declare(strict_types=1);

namespace Bga\Games\DeepDive\States;

use Bga\GameFramework\GameResult\Player;
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
            descriptionMyTurn: clienttranslate('${you} must pick a tile')
        );
    }

    public function getArgs(int $activePlayerId): array
    {
        // the data sent to the front when entering the state
        $depth = $this->game->getDepthBackend($activePlayerId);
        $prevTile = null;
        if ($depth > 0) {
            $prevTile = $this->game->tileManager->getTemporaryTileOfPlayer($activePlayerId);
        }

        return [
            "depth" => $depth,
            "prevTile" => $prevTile
        ];
    } 

    function onEnteringState(int $activePlayerId) {
        // the code to run when entering the state
    }   

    #[PossibleAction]
    public function actDoAction(int $activePlayerId, int $tileId, bool $fromDeck) {
        $depth = $this->game->getDepthReal($activePlayerId);

        if ($fromDeck) {
            $newTile = $this->game->tileManager->pickItemFromDeck($depth);
            $prevTile = null;
            if ($depth > 1) {
                $prevTile = $this->game->tileManager->getTemporaryTileOfPlayer($activePlayerId);
            }
            
            $this->notify->all("tileFlipped", '${player_name} reveals a tile from the deck', [
                "player_name" => $this->game->getPlayerNameById($activePlayerId),
                "player_id" => $activePlayerId,
                "realDepth" => $depth,
                "tile" => $newTile,
                "prevTile" => $prevTile
            ]);

            $this->game->DbQuery("UPDATE `player` SET `depth` = $depth WHERE `player_id` = $activePlayerId");

            $this->game->tileManager->setPlayerOn($activePlayerId, $newTile);
            if ($prevTile != null) {
                $this->game->tileManager->setPlayerOn(-1, $prevTile);
            }

            return PlayerTurn::class;
        }
    }

    function zombie(int $playerId): string {
        // the code to run when the player is a Zombie
        return "";
    }
}