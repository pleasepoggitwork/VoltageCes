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

class VoodooEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Voodoo";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $usageType = CustomEnchant::TYPE_CHESTPLATE;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_CHESTPLATE;

    public function getDefaultExtraData(): array
    {
        return ["weaknessDurationMultiplier" => 100, "weaknessBaseAmplifier" => 1, "weaknessAmplifierMultiplier" => 1, "weaknessDurationMultiplier" => 100, "weaknessBaseAmplifier" => 1, "weaknessAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $damager = $event->getDamager();
                $effect = new EffectInstance(Effect::getEffect(Effect::WEAKNESS), $this->extraData["weaknessDurationMultiplier"] * $level, $level * $this->extraData["weaknessAmplifierMultiplier"] + $this->extraData["weaknessBaseAmplifier"], false);
                $damager->addEffect($effect);
                $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Voodoo" . TextFormat::RESET . TextFormat::GRAY . "•");
        }
    }
}