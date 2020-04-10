<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use pocketmine\block\Block;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;

class DeflectEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Deflect";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_EPIC;
    /** @var int */
    public $maxLevel = 2;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_ARMOR;
    

    /** @var ClosureTask[] */
    public static $tasks;

    public function getDefaultExtraData(): array
    {
        return ["base" => 1, "multiplier" => 0.066];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
            $damager->attack(new EntityDamageEvent($damager, EntityDamageEvent::CAUSE_MAGIC, $this->extraData["base"] + $damager->getHealth() * $this->extraData["multiplier"]));
            $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Deflect" . TextFormat::RESET . TextFormat::GRAY . "•");
        }
    }
}
