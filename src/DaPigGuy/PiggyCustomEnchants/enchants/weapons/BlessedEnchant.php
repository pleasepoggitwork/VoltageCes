<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class BlessedEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Blessed";
    
        /** @var int */
    public $rarity = CustomEnchant::RARITY_EPIC;
    /** @var int */
    public $maxLevel = 3;
    
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                foreach ($player->getEffects() as $effect) {
                    if ($effect->getType()->isBad()) {
                        $player->removeEffect($effect->getId());
                    }
                }
            }
        }
    }
}
