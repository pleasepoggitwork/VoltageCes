<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class EnrageEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Enrage";

    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["cooldown" => 300, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 1, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
            if ($player instanceof Player) {
                if ($player->getHealth() - $event->getFinalDamage() <= 4) {
                    if (!$player->hasEffect(Effect::STRENGTH)) {
                        $effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                        $player->addEffect($effect);
                    }
                    $player->sendMessage(TextFormat::GRAY . "•" . TextFormat::GOLD . TextFormat::BOLD . "Enrage" . TextFormat::RESET . TextFormat::GRAY . "•");
                    $this->setCooldown($player, $this->extraData["cooldown"]);
                }
            }
        }
    }
}
