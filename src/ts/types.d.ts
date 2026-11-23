interface DeepDivePlayer extends Player {
    meeples: [Tile|null, Tile|null, Tile|null]
}

interface DeepDiveGamedatas extends Gamedatas<DeepDivePlayer> {
    // Add here variables you set up in getAllDatas
    decks: [number, number, number, number, number]
    revealed: [Tile[], Tile[], Tile[], Tile[], Tile[]]
}

/*
 * Describe here the types for your state args
 */
interface PlayerTurnArgs {
    depth: number;
    prevTile: Tile|null;
}

interface Tile {
    depth: number;
    type: "green" | "yellow" | "pink" | "rock" | "bubbles" | "predator"
    points: number;
    coords: {x: number, y: number}
    id: number
}