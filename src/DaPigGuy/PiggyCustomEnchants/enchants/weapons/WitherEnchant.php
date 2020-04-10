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

class WitherEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Wither";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNCOMMON;
    /** @var int */
    public $maxLevel = 2;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["witherDurationMultiplier" => 100, "witherBaseAmplifier" => 1, "witherAmplifierMultiplier" => 1, "witherDurationMultiplier" => 100, "witherBaseAmplifier" => 1, "witherAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            if ($player instanceof Player) {
                $entity = $event->getEntity();
                if (!$entity->hasEffect(Effect::WITHER)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::WITHER), $this->extraData["witherDurationMultiplier"] * $level, $level * $this->extraData["witherAmplifierMultiplier"] + $this->extraData["witherBaseAmplifier"], false);
                    $entity->addEffect($effect);
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::AQUA . TextFormat::BOLD . "Wither" . TextFormat::RESET . TextFormat::GRAY . "•");
                }
            }
        }
    }
}
