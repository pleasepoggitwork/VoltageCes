<?php

declare(strict_types=1);

namespace xSuper\PiggyCustomEnchants;

use xSuper\PiggyCustomEnchants\enchants\armor\DodgeEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\InfernoEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\AcidBloodEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\DamageLimiterEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\DeflectEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\LastStandEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\PainkillerEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\ArmoredEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\TankEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\EnlightedEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\OverloadEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\GodlyOverloadEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\VoodooEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\AdrenlineEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\SystemRebootEnchant;
use xSuper\PiggyCustomEnchants\enchants\armor\helmet\ImplantsEnchant;
use xSuper\PiggyCustomEnchants\enchants\CustomEnchant;
use xSuper\PiggyCustomEnchants\enchants\CustomEnchantIds;
use xSuper\PiggyCustomEnchants\enchants\miscellaneous\AutoRepairEnchant;
use xSuper\PiggyCustomEnchants\enchants\miscellaneous\LuckyCharmEnchant;
use xSuper\PiggyCustomEnchants\enchants\miscellaneous\RadarEnchant;
use xSuper\PiggyCustomEnchants\enchants\miscellaneous\SoulboundEnchant;
use xSuper\PiggyCustomEnchants\enchants\miscellaneous\ToggleableEffectEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\axes\LumberjackEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\DrillerEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\EnergizingEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\ExplosiveEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\hoe\FarmerEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\hoe\FertilizerEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\hoe\HarvestEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\pickaxe\JackpotEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\QuickeningEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\SmeltingEnchant;
use xSuper\PiggyCustomEnchants\enchants\tools\TelepathyEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\BlessedEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\ConditionalDamageMultiplierEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\LacedWeaponEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\LifestealEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\LightningEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\LightWeightEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\SwordsmanEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\CanabilismEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\AxemanEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\FamineEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\EnrageEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\TrapEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\ExecuteEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\ConfusionEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\WitherEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\BerserkEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\BleedEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\ViperEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\CriticalEnchant;
use xSuper\PiggyCustomEnchants\enchants\weapons\FastTurnEnchant;
use xSuper\DaPigGuy\PiggyCustomEnchants\utils\Utils;
use pocketmine\entity\Effect;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\enchantment\Enchantment;
use ReflectionException;
use ReflectionProperty;
use SplFixedArray;

class CustomEnchantManager
{
    /** @var PiggyCustomEnchants */
    private static $plugin;

    /** @var CustomEnchant[] */
    public static $enchants = [];

    /**
     * @throws ReflectionException
     */
    public static function init(SuperCustomEnchants $plugin): void
    {
        self::$plugin = $plugin;
        $vanillaEnchantments = new SplFixedArray(1024);

        $property = new ReflectionProperty(Enchantment::class, "enchantments");
        $property->setAccessible(true);
        foreach ($property->getValue() as $key => $value) {
            $vanillaEnchantments[$key] = $value;
        }
        $property->setValue($vanillaEnchantments);

        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::GEARS, "Gears", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::SPEED, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::GLOWING, "Glowing", 1, CustomEnchant::TYPE_HELMET, CustomEnchant::ITEM_TYPE_HELMET, Effect::NIGHT_VISION, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::HASTE, "Haste", 5, CustomEnchant::TYPE_HAND, CustomEnchant::ITEM_TYPE_PICKAXE, Effect::HASTE, 0, 1, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::OXYGENATE, "Oxygenate", 1, CustomEnchant::TYPE_HAND, CustomEnchant::ITEM_TYPE_PICKAXE, Effect::WATER_BREATHING, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::SPRINGS, "Springs", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::JUMP_BOOST, 1, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::MERMAID, "Mermaid", 1, CustomEnchant::TYPE_HELMET, CustomEnchant::ITEM_TYPE_HELMET, Effect::WATER_BREATHING, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::ANTIGRAVITY, "AntiGravity", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::JUMP_BOOST, 2, 0, CustomEnchant::RARITY_UNCOMMON));

        self::registerEnchantment(new ArmoredEnchant($plugin, CustomEnchantIds::ARMORED));
        self::registerEnchantment(new AutoRepairEnchant($plugin, CustomEnchantIds::AUTOREPAIR));
        self::registerEnchantment(new EnlightedEnchant($plugin, CustomEnchantIds::ENLIGHTED));
        self::registerEnchantment(new ImplantsEnchant($plugin, CustomEnchantIds::IMPLANTS));
        self::registerEnchantment(new LifestealEnchant($plugin, CustomEnchantIds::LIFESTEAL));
        self::registerEnchantment(new LightningEnchant($plugin, CustomEnchantIds::LIGHTNING));
        self::registerEnchantment(new OverloadEnchant($plugin, CustomEnchantIds::OVERLOAD));
        self::registerEnchantment(new TankEnchant($plugin, CustomEnchantIds::TANK));
        self::registerEnchantment(new DodgeEnchant($plugin, CustomEnchantIds::DODGE));
        self::registerEnchantment(new InfernoEnchant($plugin, CustomEnchantIds::INFERNO));
        self::registerEnchantment(new AcidBloodEnchant($plugin, CustomEnchantIds::ACIDBLOOD));
        self::registerEnchantment(new DamageLimiterEnchant($plugin, CustomEnchantIds::DAMAGELIMITER));
        self::registerEnchantment(new DeflectEnchant($plugin, CustomEnchantIds::DEFLECT));
        self::registerEnchantment(new PainkillerEnchant($plugin, CustomEnchantIds::PAINKILLER));
        self::registerEnchantment(new LastStandEnchant($plugin, CustomEnchantIds::LASTSTAND));
        self::registerEnchantment(new GodlyOverloadEnchant($plugin, CustomEnchantIds::GODLYOVERLOAD));
        self::registerEnchantment(new VoodooEnchant($plugin, CustomEnchantIds::VOODOO));
        self::registerEnchantment(new AdrenlineEnchant($plugin, CustomEnchantIds::ADRENLINE));
        self::registerEnchantment(new SystemRebootEnchant($plugin, CustomEnchantIds::SYSTEMREBOOT));
        self::registerEnchantment(new LightWeightEnchant($plugin, CustomEnchantIds::LIGHTWEIGHT));
        self::registerEnchantment(new ExecuteEnchant($plugin, CustomEnchantIds::EXECUTE));
        self::registerEnchantment(new CanabilismEnchant($plugin, CustomEnchantIds::CANABILISM));
        self::registerEnchantment(new SwordsmanEnchant($plugin, CustomEnchantIds::SWORDSMAN));
        self::registerEnchantment(new AxemanEnchant($plugin, CustomEnchantIds::AXEMAN));
        self::registerEnchantment(new FamineEnchant($plugin, CustomEnchantIds::FAMINE));
        self::registerEnchantment(new EnrageEnchant($plugin, CustomEnchantIds::ENRAGE));
        self::registerEnchantment(new TrapEnchant($plugin, CustomEnchantIds::TRAP));
        self::registerEnchantment(new BlessedEnchant($plugin, CustomEnchantIds::BLESSED));
        self::registerEnchantment(new ConfusionEnchant($plugin, CustomEnchantIds::CONFUSION));
        self::registerEnchantment(new BerserkEnchant($plugin, CustomEnchantIds::BERSERK));
        self::registerEnchantment(new BleedEnchant($plugin, CustomEnchantIds::BLEED));
        self::registerEnchantment(new ViperEnchant($plugin, CustomEnchantIds::VIPER));
        self::registerEnchantment(new CriticalEnchant($plugin, CustomEnchantIds::CRITICAL));
        self::registerEnchantment(new FastTurnEnchant($plugin, CustomEnchantIds::FASTTURN));
        self::registerEnchantment(new BerserkEnchant($plugin, CustomEnchantIds::BERSERK));
        self::registerEnchantment(new BlindEnchant($plugin, CustomEnchantIds::BLIND));
        self::registerEnchantment(new WitherEnchant($plugin, CustomEnchantIds::WITHER));
    }

    public static function getPlugin(): SuperCustomEnchants
    {
        return self::$plugin;
    }

    public static function registerEnchantment(CustomEnchant $enchant): void
    {
        Enchantment::registerEnchantment($enchant);
        /** @var CustomEnchant $enchant */
        $enchant = Enchantment::getEnchantment($enchant->getId());
        self::$enchants[$enchant->getId()] = $enchant;

        self::$plugin->getLogger()->debug("Custom Enchantment '" . $enchant->getName() . "' registered with id " . $enchant->getId());
    }

    /**
     * @param int|Enchantment $id
     * @throws ReflectionException
     */
    public static function unregisterEnchantment($id): void
    {
        $id = $id instanceof Enchantment ? $id->getId() : $id;
        self::$enchants[$id]->unregister();
        self::$plugin->getLogger()->debug("Custom Enchantment '" . self::$enchants[$id]->getName() . "' unregistered with id " . self::$enchants[$id]->getId());
        unset(self::$enchants[$id]);

        $property = new ReflectionProperty(Enchantment::class, "enchantments");
        $property->setAccessible(true);
        $value = $property->getValue();
        unset($value[$id]);
        $property->setValue($value);
    }

    /**
     * @return CustomEnchant[]
     */
    public static function getEnchantments(): array
    {
        return self::$enchants;
    }

    public static function getEnchantment(int $id): ?CustomEnchant
    {
        return self::$enchants[$id] ?? null;
    }

    public static function getEnchantmentByName(string $name): ?CustomEnchant
    {
        foreach (self::$enchants as $enchant) {
            if (
                strtolower(str_replace(" ", "", $enchant->getName())) === strtolower(str_replace(" ", "", $name)) ||
                strtolower(str_replace(" ", "", $enchant->getDisplayName())) === strtolower(str_replace(" ", "", $name))
            ) return $enchant;
        }
        return null;
    }
}
