/*
To use the BGA libs, add `import { BgaAnimations, BgaCards } from "./libs";` in the files using them.

To get the latest typing files (that you would save at the root of your game), read the lib doc and see the demo, go to:
https://en.doc.boardgamearena.com/BgaAnimations
https://en.doc.boardgamearena.com/BgaCards
*/
const BgaAnimations = await globalThis.importEsmLib('bga-animations', '1.x');
const BgaCards = await globalThis.importEsmLib('bga-cards', '1.x');

/**
 * We create one State class per declared state on the PHP side, to handle all state specific code here.
 * onEnteringState, onLeavingState and onPlayerActivationChange are predefined names that will be called by the framework.
 * When executing code in this state, you can access the args using this.args
 */
class PlayerTurn {
    constructor(game, bga) {
        this.game = game;
        this.bga = bga;
    }
    /**
     * This method is called each time we are entering the game state. You can use this method to perform some user interface changes at this moment.
     */
    onEnteringState(args, isCurrentPlayerActive) {
        if (isCurrentPlayerActive) {
            if (args.prevTile) {
                this.game.revealedStocks[args.depth - 1].setSelectionMode("single", [args.prevTile]);
            }
            this.game.depthStocks[args.depth].setSelectionMode("single");
            this.game.revealedStocks[args.depth].setSelectionMode("single");
            this.bga.statusBar.addActionButton(_('Confirm'), () => this.bga.actions.performAction("actDoAction", {
                tileId: this.game.depthStocks[args.depth].getSelection().concat(this.game.revealedStocks[args.depth].getSelection()).concat([args.prevTile])[0].id,
                fromDeck: this.game.depthStocks[args.depth].getSelection().length > 0
            }), {
                disabled: this.game.depthStocks[args.depth].getSelection().length == 0
                    || this.game.revealedStocks[args.depth].getSelection().length == 0
                    || (args.depth > 0 && this.game.revealedStocks[args.depth - 1].getSelection().length == 0),
                id: "confirm"
            });
        }
    }
    /**
     * This method is called each time we are leaving the game state. You can use this method to perform some user interface changes at this moment.
     */
    onLeavingState(args, isCurrentPlayerActive) {
        this.game.depthStocks[args.depth].setSelectionMode("none");
        this.game.revealedStocks[args.depth].setSelectionMode("none");
        if (args.depth > 0)
            this.game.revealedStocks[args.depth - 1].setSelectionMode("none");
        this.bga.statusBar.removeActionButtons();
    }
}

class Game {
    constructor(bga) {
        this.handStocks = {};
        console.log('deepdive constructor');
        this.bga = bga;
        this.playerTurn = new PlayerTurn(this, bga);
        this.bga.states.register('PlayerTurn', this.playerTurn);
        // Uncomment the next line to show debug informations about state changes in the console. Remove before going to production!
        // this.bga.states.logger = console.log;
        // Here, you can init the global variables of your user interface
        // Example:
        // this.myGlobalValue = 0;
    }
    /*
        setup:
        
        This method must set up the game user interface according to current game situation specified
        in parameters.
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
        
        "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
    */
    setup(gamedatas) {
        console.log("Starting game setup");
        this.gamedatas = gamedatas;
        this.animationManager = new BgaAnimations.Manager({
            animationsActive: () => this.bga.gameui.bgaAnimationsActive(),
        });
        this.tileManager = new BgaCards.Manager({
            animationManager: this.animationManager,
            type: "tile",
            cardWidth: 90,
            cardHeight: 87,
            cardBorderRadius: '5px',
            isCardVisible: (card) => true,
            setupFrontDiv(card, element) {
                element.style.backgroundPosition = `-${card.coords.x}00% -${card.coords.y}00%`;
            }
        });
        // Example to add a div on the game area
        this.bga.gameArea.getElement().insertAdjacentHTML('beforeend', `
            <div id="depths"></div>
            <div id="player-tables"></div>
        `);
        let temp = [];
        let tempRevealed = [];
        for (let i = 1; i <= 5; i++) {
            $('depths').insertAdjacentHTML("beforeend", `
                <div id="depth${i}" class="depth whiteblock">
                    <div id="deck${i}"></div>
                    <div id="revealed${i}" class="revealedStock"></div>
                </div>
            `);
            temp.push(new BgaCards.Deck(this.tileManager, $(`deck${i}`), {
                cardNumber: gamedatas.decks[i - 1],
                counter: { position: "center" },
                fakeCardGenerator(deckId) {
                    let coords;
                    switch (i) {
                        case 1:
                            coords = { x: 5, y: 1 };
                            break;
                        case 2:
                            coords = { x: 5, y: 2 };
                            break;
                        case 3:
                            coords = { x: 5, y: 3 };
                            break;
                        case 4:
                            coords = { x: 5, y: 4 };
                            break;
                        case 5:
                            coords = { x: 0, y: 5 };
                            break;
                    }
                    return { depth: 1, type: "green", points: 2, coords: coords, id: 200 + i };
                },
            }));
            temp[i - 1].onSelectionChange = (selection, lastChange) => {
                if (selection.length > 0) {
                    this.depthStocks.forEach(s => {
                        if (this.tileManager.getCardStock(lastChange) != s) {
                            s.unselectAll();
                        }
                    });
                    this.revealedStocks.forEach(s => {
                        s.unselectAll();
                    });
                    if (this.bga.players.isCurrentPlayerActive())
                        $('confirm').disabled = false;
                }
                else {
                    if (this.bga.players.isCurrentPlayerActive())
                        $('confirm').disabled = true;
                }
            };
            tempRevealed.push(new BgaCards.LineStock(this.tileManager, $(`revealed${i}`), {
                center: false
            }));
            tempRevealed[i - 1].onSelectionChange = (selection, lastChange) => {
                if (selection.length > 0) {
                    this.depthStocks.forEach(s => {
                        s.unselectAll();
                    });
                    this.revealedStocks.forEach(s => {
                        if (this.tileManager.getCardStock(lastChange) != s) {
                            s.unselectAll();
                        }
                    });
                    if (this.bga.players.isCurrentPlayerActive())
                        $('confirm').disabled = false;
                }
                else {
                    if (this.bga.players.isCurrentPlayerActive())
                        $('confirm').disabled = true;
                }
            };
        }
        this.depthStocks = temp;
        this.revealedStocks = tempRevealed;
        for (let i = 0; i < 5; i++) {
            this.revealedStocks[i].addCards(gamedatas.revealed[i]);
        }
        // Setting up player boards
        // TODO add name above each & put in right order
        Object.entries(gamedatas.players).forEach(([pId, player]) => {
            const playerId = Number(pId);
            $('player-tables').insertAdjacentHTML("beforeend", `
                <div id="playerTable-${playerId}" class="playerTable whiteblock">
                    <div id="tileGreen-${playerId}" class="handStock"></div>
                    <div id="tileYellow-${playerId}" class="handStock"></div>
                    <div id="tilePink-${playerId}" class="handStock"></div>
                    <div id="tileRock-${playerId}" class="handStock"></div>
                    <div id="meepleHand-${playerId}" class="meepleHand"></div>
                </div>
            `);
            this.handStocks[playerId] = {};
            this.handStocks[playerId]["green"] = new BgaCards.LineStock(this.tileManager, $(`tileGreen-${playerId}`), {
                direction: "column"
            });
            this.handStocks[playerId]["yellow"] = new BgaCards.LineStock(this.tileManager, $(`tileYellow-${playerId}`), {
                direction: "column"
            });
            this.handStocks[playerId]["pink"] = new BgaCards.LineStock(this.tileManager, $(`tilePink-${playerId}`), {
                direction: "column"
            });
            this.handStocks[playerId]["rock"] = new BgaCards.LineStock(this.tileManager, $(`tileRock-${playerId}`), {
                direction: "column"
            });
            gamedatas.players[playerId].hand.forEach(tile => {
                this.handStocks[playerId][tile.type].addCard(tile);
            });
            let meeples = gamedatas.players[playerId].meeples;
            let colour = gamedatas.players[playerId].color;
            let colourIndex = ["492b61", "c1ba31", "94341e", "3283ae", "5d913f", "8d1c59"].indexOf(colour);
            for (let i = 0; i < 3; i++) {
                if (meeples[i] == null) {
                    $(`meepleHand-${playerId}`).insertAdjacentHTML(`beforeend`, `
                        <div id="meeple-${playerId}-${i}" class="meeple playerColour-${colourIndex} meeple-${i}"></div>
                    `);
                }
                else {
                    let tile = $(this.getTileName(meeples[i].id));
                    tile.insertAdjacentHTML(`beforeend`, `
                        <div id="meeple-${playerId}-${i}" class="meeple playerColour-${colourIndex} meeple-${i}"></div>
                    `);
                }
            }
        });
        // TODO: Set up your game interface here, according to "gamedatas"
        // Setup game notifications to handle (see "setupNotifications" method below)
        this.setupNotifications();
        console.log("Ending game setup");
    }
    ///////////////////////////////////////////////////
    //// Utility methods
    /*
    
        Here, you can defines some utility methods that you can use everywhere in your javascript
        script. Typically, functions that are used in multiple state classes or outside a state class.
    
    */
    getTileName(tileId) {
        return `tile-${tileId}`;
    }
    ///////////////////////////////////////////////////
    //// Reaction to cometD notifications
    /*
        setupNotifications:
        
        In this method, you associate each of your game notifications with your local method to handle it.
        
        Note: game notification names correspond to "bga->notify->all" calls in your Game.php file.
    
    */
    setupNotifications() {
        console.log('notifications subscriptions setup');
        // automatically listen to the notifications, based on the `notif_xxx` function on this class. 
        // Uncomment the logger param to see debug information in the console about notifications.
        this.bga.notifications.setupPromiseNotifications({
        // logger: console.log
        });
    }
    async notif_test(args) {
        console.log(args);
    }
    async notif_tileFlipped(args) {
        await this.revealedStocks[args.realDepth - 1].addCard(args.tile, {
            fromStock: this.depthStocks[args.realDepth - 1],
            initialSide: "front",
            fadeIn: true
        });
        let meepleToMove;
        if (args.prevTile != null) {
            let prevEl = $(this.getTileName(args.prevTile.id));
            meepleToMove = prevEl.querySelector('[id*="meeple"]');
        }
        else {
            meepleToMove = $(`meepleHand-${args.player_id}`).children[0];
        }
        let tile = $(this.getTileName(args.tile.id));
        await this.animationManager.slideAndAttach(meepleToMove, tile);
    }
    async notif_tileAdded(args) {
        let meepleToMove = $(this.getTileName(args.tile.id)).querySelector('[id*="meeple"]');
        await this.animationManager.slideAndAttach(meepleToMove, $(`meepleHand-${args.player_id}`));
        await this.handStocks[args.player_id][args.tile.type].addCard(args.tile);
    }
}

export { Game };
