<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\item\Sword;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class DodgeEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Dodge";

    /** @var int */
    public $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    public function getDefaultExtraData(): array
    {
        return ["absorbedDamageMultiplier" => 0.50];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
            if ($damager instanceof Player) {
                    $event->setModifier(-($event->getFinalDamage() * $this->extraData["absorbedDamageMultiplier"] * $level), CustomEnchantIds::DODGE);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::GRAY . TextFormat::BOLD . "Dodge" . TextFormat::RESET . TextFormat::GRAY . "•");
            }
        }
    }
}

