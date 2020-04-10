<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\Sword;
use pocketmine\Player;

class SwordsmanEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Swordsman";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_EPIC;
    /** @var int */
    public $maxLevel = 3;
    
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;
    
    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 0.1];
    }


    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
            if ($damager instanceof Player) {
                if ($damager->getInventory()->getItemInHand() instanceof Axe) {
                    $event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::SWORDSMAN);
                }
            }
        }
    }
}
