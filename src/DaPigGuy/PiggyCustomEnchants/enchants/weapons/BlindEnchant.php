<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class BlindEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Blind";
    
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $maxLevel = 1;
    
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["blindnessDurationMultiplier" => 100, "blindnessBaseAmplifier" => 1, "blindnessAmplifierMultiplier" => 1, "blindnessDurationMultiplier" => 200, "blindnessBaseAmplifier" => 1, "blindnessAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if ($entity instanceof Player) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::BLINDNESS), $this->extraData["blindnessDurationMultiplier"] * $level, $level * $this->extraData["blindnessAmplifierMultiplier"] + $this->extraData["blindnessBaseAmplifier"], false);
                    $entity->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::GOLD . TextFormat::BOLD . "Blind" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
            }
        }
    }
}
