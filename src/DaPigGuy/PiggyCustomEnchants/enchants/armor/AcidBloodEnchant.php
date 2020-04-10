<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class AcidBloodEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "AcidBlood";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $maxLevel = 2;

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
        return ["poisonDurationMultiplier" => 200, "poisonBaseAmplifier" => 3, "poisonAmplifierMultiplier" => 1, "poisonDurationMultiplier" => 200];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($player->getHealth() - $event->getFinalDamage() <= 4) {
                $damager = $event->getDamager();
                $effect = new EffectInstance(Effect::getEffect(Effect::POISON), $this->extraData["poisonDurationMultiplier"] * $level, $level * $this->extraData["poisonAmplifierMultiplier"] + $this->extraData["poisonBaseAmplifier"], false);
                $damager->addEffect($effect);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Acid Blood" . TextFormat::RESET . TextFormat::GRAY . "•");
            }
        }
    }
}
