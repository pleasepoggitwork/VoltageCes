<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FastTurnEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "FastTurn";
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["base" => 3, "multiplier" => 0.1];
    }


    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::FASTTURN);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::RED . TextFormat::AQUA . "Fast Turn" . TextFormat::RESET . TextFormat::GRAY . "•");
            }
        }
    }
}
