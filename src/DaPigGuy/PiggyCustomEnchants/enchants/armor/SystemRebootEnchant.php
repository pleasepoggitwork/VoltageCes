<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\level\particle\FlameParticle;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class SystemRebootEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "SystemReboot";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNSTABLE;
    /** @var int */
    public $maxLevel = 1;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_BOOTS;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_BOOTS;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($event->getFinalDamage() >= $player->getHealth()) {
                $level > 1 ? $item->addEnchantment($item->getEnchantment(CustomEnchantIds::SYSTEMREBOOT)->setLevel($level - 1)) : $item->removeEnchantment(CustomEnchantIds::SYSTEMREBOOT);
                if (count($item->getEnchantments()) === 0) $item->removeNamedTagEntry(Item::TAG_ENCH);
                $player->getArmorInventory()->setItem($slot, $item);

                $player->removeAllEffects();
                $player->setHealth($player->getMaxHealth());
                $player->setFood($player->getMaxFood());
                $player->setXpLevel(0);
                $player->setXpProgress(0);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::RED . TextFormat::BOLD . "System Reboot" . TextFormat::RESET . TextFormat::GRAY . "•");
                                foreach ($event->getModifiers() as $modifier => $damage) {
                    $event->setModifier(0, $modifier);
                                }
                $event->setBaseDamage(0);
            }
        }
    }
}
