<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class LifestealEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Lifesteal";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_RARE;
    /** @var int */
    public $maxLevel = 3;


    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            if ($entity instanceof Player) {
                if ($player instanceof Player) {
                    $player->setHealth($player->getHealth() + $this->extraData["base"] + $level * $this->extraData["multiplier"] > $player->getMaxHealth() ? $player->getMaxHealth() : $player->getHealth() + $this->extraData["base"] + $level * $this->extraData["multiplier"]);
                }
            }
        }
    }
}
