interface DeepDivePlayer extends Player {
    meeples: [string, string, string]
}

interface DeepDiveGamedatas extends Gamedatas<DeepDivePlayer> {
    // Add here variables you set up in getAllDatas
    decks: [number, number, number, number, number]
}

/*
 * Describe here the types for your state args
 */
interface PlayerTurnArgs {

}

interface Tile {
    depth: number;
    type: "green" | "yellow" | "pink" | "rock" | "bubbles" | "predator"
    points: number;
    coords: {x: number, y: number}
    id: number
}