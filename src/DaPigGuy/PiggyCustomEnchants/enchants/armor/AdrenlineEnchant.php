<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class AdrenlineEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Adrenline";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
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

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 300, "speedDurationMultiplier" => 200, "speedBaseAmplifier" => 2, "speedAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($player->getHealth() - $event->getFinalDamage() <= 4) {
                $damager = $event->getDamager();
                if ($damager instanceof Player) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::SPEED), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Adrenline" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
                $this->setCooldown($player, $this->extraData["cooldown"]);
            }
        }
    }
}
