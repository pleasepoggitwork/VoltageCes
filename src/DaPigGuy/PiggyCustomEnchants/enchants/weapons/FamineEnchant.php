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

class FamineEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Famine";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_COMMON;
    /** @var int */
    public $maxLevel = 3;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 5, "foodMultiplier" => 2];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if ($entity instanceof Living) {
                    $entity->setFood($entity->getFood() - ($event->getFinalDamage() * $this->extraData["foodMultiplier"]) > $entity->getMaxFood() ? $entity->getMaxFood() : $entity->getFood() - ($event->getFinalDamage() * $this->extraData["foodMultiplier"]));
                    $this->setCooldown($player, $this->extraData["cooldown"]);
                }
            }
        }
    }
}


