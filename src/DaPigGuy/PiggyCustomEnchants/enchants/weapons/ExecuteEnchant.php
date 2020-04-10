<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ExecuteEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Execute";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_EPIC;
    /** @var int */
    public $maxLevel = 3;
    
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 0.1, "cooldown" => 4];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if ($entity->getHealth() - $event->getFinalDamage() <= 4) {
                    $event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::EXECUTE);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::BOLD . TextFormat::GOLD . "Execute" . TextFormat::RESET . TextFormat::GRAY . "•");
                    $this->setCooldown($player, $this->extraData["cooldown"]);
                }
            }
        }    
    }
}
