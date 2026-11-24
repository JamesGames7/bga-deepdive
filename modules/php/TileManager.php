<?php

declare(strict_types=1);

namespace Bga\Games\DeepDive;

use Bga\GameFramework\Components\ItemManager\ItemLocation;
use Bga\GameFramework\Components\ItemManager\ItemManager;
use Bga\GameFramework\Helpers\Collection;
use Bga\Games\DeepDive\Game;
use Bga\Games\DeepDive\Tile;

class TileManager {
    private ItemManager $tiles;

    public function __construct(private Game $game) {
        $this->tiles = $game->bga->itemManagerFactory->createItemManager(
            Tile::class,
            locations: [
                new ItemLocation('deck', true),
                new ItemLocation('revealed'),
                new ItemLocation('hand')
            ]
        );

        $this->game = $game;
    }

    public function initDb() {
        $this->tiles->initDb();
    }

    public function setup() {
        $tiles = new Collection([
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 2, "coords" => ["x" => 0, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 2, "coords" => ["x" => 0, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 2, "coords" => ["x" => 0, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 2, "coords" => ["x" => 1, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 2, "coords" => ["x" => 1, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 2, "coords" => ["x" => 1, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 3, "coords" => ["x" => 2, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 3, "coords" => ["x" => 2, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "green", "points" => 6, "coords" => ["x" => 3, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 5, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 5, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 5, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 5, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 5, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 3, "coords" => ["x" => 6, "y" => 0], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 0], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 0], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 2, "coords" => ["x" => 8, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 2, "coords" => ["x" => 8, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "green", "points" => 5, "coords" => ["x" => 9, "y" => 0], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 2, "coords" => ["x" => 0, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 2, "coords" => ["x" => 0, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 2, "coords" => ["x" => 0, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 3, "coords" => ["x" => 1, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 3, "coords" => ["x" => 1, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 3, "coords" => ["x" => 2, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 3, "coords" => ["x" => 2, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "yellow", "points" => 6, "coords" => ["x" => 3, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "green", "points" => 3, "coords" => ["x" => 6, "y" => 1], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 1], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 1], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 2, "coords" => ["x" => 8, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 2, "coords" => ["x" => 8, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "yellow", "points" => 5, "coords" => ["x" => 9, "y" => 1], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "green", "points" => 4, "coords" => ["x" => 0, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "green", "points" => 4, "coords" => ["x" => 0, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "yellow", "points" => 4, "coords" => ["x" => 1, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "yellow", "points" => 4, "coords" => ["x" => 1, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "pink", "points" => 4, "coords" => ["x" => 2, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "pink", "points" => 4, "coords" => ["x" => 2, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "pink", "points" => 6, "coords" => ["x" => 3, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "yellow", "points" => 3, "coords" => ["x" => 6, "y" => 2], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 2], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 2], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 7, "y" => 2], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 2, "coords" => ["x" => 8, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 2, "coords" => ["x" => 8, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "pink", "points" => 5, "coords" => ["x" => 9, "y" => 2], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "green", "points" => 9, "coords" => ["x" => 0, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "yellow", "points" => 9, "coords" => ["x" => 1, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "pink", "points" => 9, "coords" => ["x" => 2, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 3, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 3, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 3, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 3, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 3, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "predator", "points" => 0, "coords" => ["x" => 4, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "pink", "points" => 3, "coords" => ["x" => 6, "y" => 3], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 3], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 3], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 4, "coords" => ["x" => 8, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "green", "points" => 7, "coords" => ["x" => 9, "y" => 3], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 0, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 0, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 0, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "bubbles", "points" => 0, "coords" => ["x" => 0, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "bubbles", "points" => 0, "coords" => ["x" => 1, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "bubbles", "points" => 0, "coords" => ["x" => 1, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "bubbles", "points" => 0, "coords" => ["x" => 1, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 2, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 2, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 2, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 2, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "bubbles", "points" => 0, "coords" => ["x" => 3, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "bubbles", "points" => 0, "coords" => ["x" => 3, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 4, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "green", "points" => 6, "coords" => ["x" => 6, "y" => 4], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 4], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 4, "coords" => ["x" => 8, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "yellow", "points" => 7, "coords" => ["x" => 9, "y" => 4], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 2, "coords" => ["x" => 1, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 2, "coords" => ["x" => 2, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 2, "coords" => ["x" => 3, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 3, "coords" => ["x" => 4, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 3, "coords" => ["x" => 5, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 4, "type" => "yellow", "points" => 6, "coords" => ["x" => 6, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 5], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 4, "coords" => ["x" => 8, "y" => 5], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "pink", "points" => 7, "coords" => ["x" => 9, "y" => 5], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 4, "type" => "pink", "points" => 6, "coords" => ["x" => 0, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "green", "points" => 9, "coords" => ["x" => 1, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "yellow", "points" => 9, "coords" => ["x" => 2, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "pink", "points" => 9, "coords" => ["x" => 3, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "predator", "points" => 0, "coords" => ["x" => 5, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 6, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "predator", "points" => 0, "coords" => ["x" => 6, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 4, "type" => "bubbles", "points" => 0, "coords" => ["x" => 7, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "green", "points" => 4, "coords" => ["x" => 8, "y" => 6], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "green", "points" => 8, "coords" => ["x" => 9, "y" => 6], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 0, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "rock", "points" => 0, "coords" => ["x" => 0, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 1, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "rock", "points" => 0, "coords" => ["x" => 1, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 1, "coords" => ["x" => 2, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 1, "coords" => ["x" => 2, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 1, "coords" => ["x" => 2, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 1, "coords" => ["x" => 3, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 1, "coords" => ["x" => 3, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 1, "coords" => ["x" => 3, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 1, "coords" => ["x" => 4, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 1, "coords" => ["x" => 4, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 1, "coords" => ["x" => 4, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 1, "type" => "green", "points" => 1, "coords" => ["x" => 5, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "yellow", "points" => 1, "coords" => ["x" => 6, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 1, "type" => "pink", "points" => 1, "coords" => ["x" => 7, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 2, "type" => "yellow", "points" => 4, "coords" => ["x" => 8, "y" => 7], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 5, "type" => "yellow", "points" => 8, "coords" => ["x" => 9, "y" => 7], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 2, "type" => "pink", "points" => 4, "coords" => ["x" => 0, "y" => 8], "highPlayerCount" => true],
            ["location" => "deck", "depth" => 3, "type" => "green", "points" => 3, "coords" => ["x" => 1, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "yellow", "points" => 3, "coords" => ["x" => 2, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "pink", "points" => 3, "coords" => ["x" => 3, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "green", "points" => 5, "coords" => ["x" => 4, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "yellow", "points" => 5, "coords" => ["x" => 5, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 3, "type" => "pink", "points" => 5, "coords" => ["x" => 6, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "pink", "points" => 8, "coords" => ["x" => 9, "y" => 8], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "green", "points" => 10, "coords" => ["x" => 0, "y" => 9], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "yellow", "points" => 10, "coords" => ["x" => 1, "y" => 9], "highPlayerCount" => false],
            ["location" => "deck", "depth" => 5, "type" => "pink", "points" => 10, "coords" => ["x" => 2, "y" => 9], "highPlayerCount" => false],
        ]);
    
        if ($this->game->getPlayersNumber() <= 3) {
            $tiles = $tiles->filter(fn($tile) => !$tile["highPlayerCount"]);
        } 

        $this->tiles->createItems($tiles->values());
    }

    public function getDepthSize(int $depth): int {
        return $this->tiles->countItemsInLocation(["deck", $depth]);
    }

    public function pickItemFromDeck(int $depth): Tile {
        return $this->tiles->pickItem(["deck", $depth], ["revealed", $depth]);
    }

    public function getRevealed(int $depth): array {
        return $this->tiles->getItemsInLocation(["revealed", $depth])->values();
    }

    public function setPlayerOn(int $playerId, Tile $tile): void {
        if ($playerId > 0) {
            $tile->playerOn = $playerId;
            $this->tiles->updateItem($tile, "playerOn");
        } else {
            $tile->playerOn = null;
            $this->tiles->updateItem($tile, "playerOn");
        }
    }

    public function getTemporaryTileOfPlayer(int $playerId): Tile|null {
        $options = $this->tiles->getItemsByFieldName("playerOn", $playerId)->filter(fn($val, $key) => $val->type != "predator");
        if ($options->count() > 0) return $options->first();
        return null;
    }

    public function getTilesWithPlayer(int $playerId): array {
        return $this->tiles->getItemsByFieldName("playerOn", $playerId)->values();
    }

    public function getTileWithId(int $tileId): Tile {
        return $this->tiles->getItemById($tileId);
    }

    public function addTileToGrid(Tile $tile, int $playerId, int $depth): void {
        if ($tile->type == "bubbles" || $tile->type == "predator") {
            throw new \Bga\GameFramework\UserException(_("Undefined error - please reload and/or raise a bug report"));
        } else if ($tile->depth == $depth || ($tile == $this->getTemporaryTileOfPlayer($playerId))) {
            $this->tiles->moveItem($tile, ["hand", $playerId]);
            $this->setPlayerOn(-1, $tile);
        }
    }

    public function getHandofPlayer(int $playerId): array {
        return $this->tiles->getItemsInLocation(["hand", $playerId])->values();
    }

    public function countSelectableAtDepth(int $depth): int {
        return $this->tiles->getItemsInLocation(["revealed", $depth])->count();
    }
}