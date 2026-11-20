<?php

declare(strict_types=1);

namespace Bga\Games\DeepDive;

use Bga\GameFramework\Components\ItemManager\Item;
use Bga\GameFramework\Components\ItemManager\ItemField;
use Bga\GameFramework\Components\ItemManager\ItemFieldKind;

#[Item('tile')]
class Tile {
    #[ItemField(kind: ItemFieldKind::ID)]
    public int $id;

    #[ItemField(kind: ItemFieldKind::LOCATION, locationIndex: 0)]
    public string $location;

    #[ItemField(kind: ItemFieldKind::LOCATION, locationIndex: 1)]
    public int|null $depth;

    #[ItemField(kind: ItemFieldKind::ORDER)]
    public int $order;

    #[ItemField]
    public int $points;

    #[ItemField]
    public string $type;

    #[ItemField]
    public array $coords;

    #[ItemField]
    public bool $highPlayerCount;

    #[ItemField]
    public ?int $playerOn;
}
