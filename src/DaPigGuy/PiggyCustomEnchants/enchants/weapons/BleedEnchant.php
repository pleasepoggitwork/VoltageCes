<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
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

class BleedEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Bleed";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_MYTHIC;
    /** @var int */
    public $maxLevel = 1;

    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    /** @var ClosureTask[] */
    public static $tasks;

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 7, "interval" => 20, "durationMultiplier" => 20, "base" => 1, "multiplier" => 0.066];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if (!isset(self::$tasks[$entity->getId()])) {
                    $endTime = time() + $this->extraData["durationMultiplier"] * $level;
                    self::$tasks[$entity->getId()] = new ClosureTask(function () use ($entity, $endTime): void {
                        if (!$entity->isAlive() || $entity->isClosed() || $entity->isFlaggedForDespawn() || $endTime < time()) {
                            self::$tasks[$entity->getId()]->getHandler()->cancel();
                            unset(self::$tasks[$entity->getId()]);
                            return;
                        }
                        $entity->attack(new EntityDamageEvent($entity, EntityDamageEvent::CAUSE_MAGIC, $this->extraData["base"] + $entity->getHealth() * $this->extraData["multiplier"]));
                    });
                    $this->plugin->getScheduler()->scheduleRepeatingTask(self::$tasks[$entity->getId()], $this->extraData["interval"]);
                    $this->setCooldown($player, $this->getDefaultExtraData()["cooldown"]);
                }
            }
        }
    }
}
