import { Game } from "../Game";

/**
 * We create one State class per declared state on the PHP side, to handle all state specific code here.
 * onEnteringState, onLeavingState and onPlayerActivationChange are predefined names that will be called by the framework.
 * When executing code in this state, you can access the args using this.args
 */
export class PredatorTurn {
    constructor(private game: Game, private bga: Bga<DeepDivePlayer, DeepDiveGamedatas>) {
    }

    /**
     * This method is called each time we are entering the game state. You can use this method to perform some user interface changes at this moment.
     */
    onEnteringState(args: PredatorTurnArgs, isCurrentPlayerActive: boolean) {
        if (isCurrentPlayerActive) {
            args.depths.forEach(depth => {
                let selectable: Tile[] = this.game.revealedStocks[depth - 1].getCards().filter(tile => tile.type != "bubbles" && tile.type != "predator");
                this.game.revealedStocks[depth - 1].setSelectionMode("single", selectable);
            })

            this.bga.statusBar.addActionButton(_('Confirm'), () => this.bga.actions.performAction("actPickTile", {
                tileId: this.game.depthStocks[args.depths[0] - 1].getSelection().concat(
                    this.game.revealedStocks[args.depths[1] - 1].getSelection()
                ).concat(
                    this.game.revealedStocks[args.depths[2] - 1].getSelection()
                )[0].id
            }), {
                disabled: this.game.depthStocks[args.depths[0] - 1].getSelection().length == 0
                            || this.game.revealedStocks[args.depths[1] - 1].getSelection().length == 0
                            || this.game.revealedStocks[args.depths[2] - 1].getSelection().length == 0,
                id: "confirm"
            })
        }
    }

    /**
     * This method is called each time we are leaving the game state. You can use this method to perform some user interface changes at this moment.
     */
    onLeavingState(args: PredatorTurnArgs, isCurrentPlayerActive: boolean) {
        args.depths.forEach(depth => {
            this.game.revealedStocks[depth - 1].setSelectionMode("none");
        })
    }
}
