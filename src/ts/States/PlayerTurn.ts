import { Game } from "../Game";

/**
 * We create one State class per declared state on the PHP side, to handle all state specific code here.
 * onEnteringState, onLeavingState and onPlayerActivationChange are predefined names that will be called by the framework.
 * When executing code in this state, you can access the args using this.args
 */
export class PlayerTurn {
    constructor(private game: Game, private bga: Bga<DeepDivePlayer, DeepDiveGamedatas>) {
    }

    /**
     * This method is called each time we are entering the game state. You can use this method to perform some user interface changes at this moment.
     */
    onEnteringState(args: PlayerTurnArgs, isCurrentPlayerActive: boolean) {
        if (isCurrentPlayerActive) {
            if (args.prevTile) {
                this.game.revealedStocks[args.depth - 1].setSelectionMode("single", [args.prevTile]);
            }
            this.game.depthStocks[args.depth].setSelectionMode("single");
            this.game.revealedStocks[args.depth].setSelectionMode("single");

            this.bga.statusBar.addActionButton(_('Confirm'), () => this.bga.actions.performAction("actDoAction", {
                tileId: this.game.depthStocks[args.depth].getSelection().concat(
                    this.game.revealedStocks[args.depth].getSelection()
                ).concat(
                    [args.prevTile]
                )[0].id,
                fromDeck: this.game.depthStocks[args.depth].getSelection().length > 0
            }), {
                disabled: this.game.depthStocks[args.depth].getSelection().length == 0
                            || this.game.revealedStocks[args.depth].getSelection().length == 0
                            || (args.depth > 0 && this.game.revealedStocks[args.depth - 1].getSelection().length == 0),
                id: "confirm"
            })
        }
    }

    /**
     * This method is called each time we are leaving the game state. You can use this method to perform some user interface changes at this moment.
     */
    onLeavingState(args: PlayerTurnArgs, isCurrentPlayerActive: boolean) {
        this.game.depthStocks[args.depth].setSelectionMode("none");
        this.game.revealedStocks[args.depth].setSelectionMode("none");
        if (args.depth > 0) this.game.revealedStocks[args.depth - 1].setSelectionMode("none");
        this.bga.statusBar.removeActionButtons();
    }
}
