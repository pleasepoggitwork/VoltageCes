<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

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

class ViperEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Viper";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["poisonDurationMultiplier" => 100, "poisonBaseAmplifier" => 1, "poisonAmplifierMultiplier" => 1, "poisonDurationMultiplier" => 100, "poisonBaseAmplifier" => 1, "poisonAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if (!$entity->hasEffect(Effect::POISON)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::POISON), $this->extraData["poisonDurationMultiplier"] * $level, $level * $this->extraData["poisonAmplifierMultiplier"] + $this->extraData["poisonBaseAmplifier"], false);
                    $entity->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Viper" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
            }
        }
    }
}
