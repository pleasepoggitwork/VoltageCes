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

class CriticalEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Critical";
    
        /** @var int */
    public $rarity = CustomEnchant::RARITY_EPIC;
    /** @var int */
    public $maxLevel = 2;

    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["base" => 1, "multiplier" => 2];
    }


    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::CRITICAL);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::GOLD . TextFormat::BOLD . "Critical" . TextFormat::RESET . TextFormat::GRAY . "•");
            }
        }
    }
}
