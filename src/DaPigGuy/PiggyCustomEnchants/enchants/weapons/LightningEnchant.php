<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class LightningEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Lightning";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_LEGENDARY;
    /** @var int */
    public $maxLevel = 2;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 30];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            if ($entiy instanceof Player) {
                if ($player instanceof Player) {
                    $lightning = Entity::createEntity("PiggyLightning", $event->getEntity()->getLevel(), Entity::createBaseNBT($event->getEntity()));
                    $lightning->setOwningEntity($player);
                    $lightning->spawnToAll();
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::LIGHT_PURPLE . TextFormat::BOLD . "Lightning" . TextFormat::RESET . TextFormat::GRAY . "•");
                    $this->setCooldown($player, $this->extraData["cooldown"]);
                }
            }
        }
    }
}
