<?php
declare(strict_types=1);

namespace Bga\Games\DeepDive\States;

use Bga\GameFramework\StateType;
use Bga\GameFramework\States\GameState;
use Bga\GameFramework\States\PossibleAction;
use Bga\Games\DeepDive\Game;

class PredatorTurn extends GameState
{
    function __construct(
        protected Game $game,
    ) {
        parent::__construct($game,
            id: 20,
            type: StateType::ACTIVE_PLAYER,

            // optional
            description: clienttranslate('${actplayer} must select a tile then collect their meeples'),
            descriptionMyTurn: clienttranslate('${you} must select a tile then collect your meeples'),
            transitions: [],
        );
    }

    public function getArgs(int $activePlayerId): array
    {
        // the data sent to the front when entering the state
        $depths = [];

        foreach($this->game->tileManager->getTilesWithPlayer($activePlayerId) as $tile) {
            $depths[] = $tile->depth;
        }

        return ["depths" => $depths];
    } 

    function onEnteringState(int $activePlayerId) {
        // the code to run when entering the state
    }   

    #[PossibleAction]
    public function actPickTile(int $activePlayerId, int $tileId) {
        $depths = [];

        foreach($this->game->tileManager->getTilesWithPlayer($activePlayerId) as $tile) {
            $depths[] = $tile->depth;
        }
        $tile = $this->game->tileManager->getTileWithId($tileId);

        if ($tile->location != "revealed") {
            throw new \Bga\GameFramework\UserException(_("Not a valid selection"));
        } else {
            $this->game->tileManager->addTileToGrid($tile, $activePlayerId, $tile->depth);

            $this->notify->all("tileAdded", _('${player_name} adds a tile to their grid'), [
                "player_name" => $this->game->getPlayerNameById($activePlayerId),
                "player_id" => $activePlayerId,
                "tile" => $tile
            ]);

            $meepletiles = [];
            foreach($this->game->tileManager->getTilesWithPlayer($activePlayerId) as $tile) {
                $this->game->tileManager->setPlayerOn(-1, $tile);
                $meepletiles[] = $tile;
            }

            $this->notify->all("clearMeeples", _('${player_name} returns their meeples to the supply'), [
                "player_name" => $this->game->getPlayerNameById($activePlayerId),
                "player_id" => $activePlayerId,
                "tiles" => $meepletiles
            ]);
        }

        $this->game->activeNextPlayer();
        return PlayerTurn::class;
    }

    function zombie(int $playerId): string {
        // the code to run when the player is a Zombie
        return "";
    }
}