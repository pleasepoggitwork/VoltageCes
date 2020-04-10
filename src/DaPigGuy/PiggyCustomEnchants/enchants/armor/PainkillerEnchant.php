<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class PainkillerEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Painkiller";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $maxLevel = 1;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_ARMOR_INVENTORY;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 300, "resistanceDurationMultiplier" => 200, "resistanceBaseAmplifier" => 3, "resistanceAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($player->getHealth() - $event->getFinalDamage() <= 4) {
                if (!$player->hasEffect(Effect::RESISTANCE)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::RESISTANCE), $this->extraData["resistanceDurationMultiplier"] * $level, $level * $this->extraData["resistanceAmplifierMultiplier"] + $this->extraData["resistanceBaseAmplifier"], false);
                    $player->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Painkiller" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
            }
        }
    }
}
