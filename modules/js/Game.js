/*
To use the BGA libs, add `import { BgaAnimations, BgaCards } from "./libs";` in the files using them.

To get the latest typing files (that you would save at the root of your game), read the lib doc and see the demo, go to:
https://en.doc.boardgamearena.com/BgaAnimations
https://en.doc.boardgamearena.com/BgaCards
*/
const BgaAnimations = await globalThis.importEsmLib('bga-animations', '1.x');
const BgaCards = await globalThis.importEsmLib('bga-cards', '1.x');

class Game {
    constructor(bga) {
        this.gridStocks = [];
        console.log('deepdive constructor');
        this.bga = bga;
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
            },
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
                    <div id="revealed${i}"></div>
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
            tempRevealed.push(new BgaCards.LineStock(this.tileManager, $(`revealed${i}`), {}));
        }
        this.depthStocks = temp;
        this.revealedStocks = tempRevealed;
        // Setting up player boards
        // TODO add name above each & put in right order
        Object.entries(gamedatas.players).forEach(([pId, player]) => {
            const playerId = Number(pId);
            $('player-tables').insertAdjacentHTML("beforeend", `
                <div id="playerTable-${playerId}" class="playerTable whiteblock">
                    <div id="tileGrid-${playerId}"></div>
                    <div id="meepleHand-${playerId}" class="meepleHand"></div>
                </div>
            `);
            this.gridStocks.push(new BgaCards.GridStock(this.tileManager, $(`tileGrid-${playerId}`), {
                maxX: 3,
                minX: 1,
                minY: 1,
                maxY: 1,
                mapCardToCoordinates(tile) {
                    let row = ["green", "yellow", "pink"].indexOf(tile.type);
                    return { x: row, y: 0 };
                },
            }));
            let meeples = gamedatas.players[playerId].meeples;
            let colour = gamedatas.players[playerId].color;
            let colourIndex = ["492b61", "c1ba31", "94341e", "3283ae", "5d913f", "8d1c59"].indexOf(colour);
            for (let i = 0; i < 3; i++) {
                switch (meeples[i]) {
                    case "hand":
                        console.log($(`meepleHand-${playerId}`));
                        $(`meepleHand-${playerId}`).insertAdjacentHTML(`beforeend`, `
                            <div id="meeple-${playerId}-${i}" class="meeple playerColour-${colourIndex} meeple-${i}"></div>
                        `);
                        break;
                    // TODO add more
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
}

export { Game };
