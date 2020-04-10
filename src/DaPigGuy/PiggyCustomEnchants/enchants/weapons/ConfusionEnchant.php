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

class ConfusionEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Confusion";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_COMMON;
    /** @var int */
    public $maxLevel = 1;

    public function getDefaultExtraData(): array
    {
        return ["nauseaDurationMultiplier" => 100, "nauseaBaseAmplifier" => 1, "nauseaAmplifierMultiplier" => 1, "nauseaDurationMultiplier" => 200, "nauseaBaseAmplifier" => 1, "nauseaAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if (!$entity->hasEffect(Effect::NAUSEA)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::NAUSEA), $this->extraData["nauseaDurationMultiplier"] * $level, $level * $this->extraData["nauseaAmplifierMultiplier"] + $this->extraData["nauseaBaseAmplifier"], false);
                    $entity->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::GRAY . TextFormat::BOLD . "Confusion" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
            }
        }
    }
}
