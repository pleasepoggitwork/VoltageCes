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
use pocketmine\utils\TextFormat;

class CanabilismEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Canabilism";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_COMMON;
    /** @var int */
    public $maxLevel = 3;

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 5, "foodMultiplier" => 2];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            if ($entity instanceof Player) {
                if ($player instanceof Player) {
                    $player->setFood($player->getFood() + ($event->getFinalDamage() * $this->extraData["foodMultiplier"]) > $player->getMaxFood() ? $player->getMaxFood() : $player->getFood() + ($event->getFinalDamage() * $this->extraData["foodMultiplier"]));
                    $this->setCooldown($player, $this->extraData["cooldown"]);
                }
            }
        }
    }
}
