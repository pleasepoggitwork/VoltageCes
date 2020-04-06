<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants;

use DaPigGuy\PiggyCustomEnchants\enchants\armor\DodgeEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\InfernoEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\AcidBloodEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\DamageLimiterEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\DeflectEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\LastStandEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\PainkillerEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\ArmoredEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\TankEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\EnlightedEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\OverloadEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\GodlyOverloadEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\VoodooEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\AdrenlineEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\SystemRebootEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\armor\helmet\ImplantsEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\AutoRepairEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\LuckyCharmEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\RadarEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\SoulboundEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\ToggleableEffectEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\axes\LumberjackEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\DrillerEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\EnergizingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\ExplosiveEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\hoe\FarmerEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\hoe\FertilizerEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\hoe\HarvestEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\pickaxe\JackpotEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\QuickeningEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\SmeltingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\tools\TelepathyEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\BlessedEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\AutoAimEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\BombardmentEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\BountyHunterEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\GrapplingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\HeadhunterEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\HealingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\MissileEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\MolotovEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\ParalyzeEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\PiercingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\ProjectileChangingEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\ShuffleEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\bows\VolleyEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\ConditionalDamageMultiplierEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\LacedWeaponEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\LifestealEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\LightningEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\LightWeightEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\SwordsmanEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\CanabilismEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\AxemanEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\FamineEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\EnrageEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\TrapEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\ExecuteEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\ConfusionEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\WitherEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\BerserkEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\BleedEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\ViperEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\CriticalEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\FastTurnEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\weapons\BlindEnchant;
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
    public static function init(PiggyCustomEnchants $plugin): void
    {
        self::$plugin = $plugin;
        $vanillaEnchantments = new SplFixedArray(1024);

        $property = new ReflectionProperty(Enchantment::class, "enchantments");
        $property->setAccessible(true);
        foreach ($property->getValue() as $key => $value) {
            $vanillaEnchantments[$key] = $value;
        }
        $property->setValue($vanillaEnchantments);

        self::registerEnchantment(new ProjectileChangingEnchant($plugin, CustomEnchantIds::BLAZE, "Blaze", "PiggyFireball"));
        self::registerEnchantment(new ProjectileChangingEnchant($plugin, CustomEnchantIds::HOMING, "Homing", "HomingArrow", 3, CustomEnchant::RARITY_MYTHIC));
        self::registerEnchantment(new ProjectileChangingEnchant($plugin, CustomEnchantIds::PORKIFIED, "Porkified", "PigProjectile", 3, CustomEnchant::RARITY_MYTHIC));
        self::registerEnchantment(new ProjectileChangingEnchant($plugin, CustomEnchantIds::WITHERSKULL, "Wither Skull", "PiggyWitherSkull", 1, CustomEnchant::RARITY_MYTHIC));

        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::GEARS, "Gears", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::SPEED, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::GLOWING, "Glowing", 1, CustomEnchant::TYPE_HELMET, CustomEnchant::ITEM_TYPE_HELMET, Effect::NIGHT_VISION, 0, 0, CustomEnchant::RARITY_COMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::HASTE, "Haste", 5, CustomEnchant::TYPE_HAND, CustomEnchant::ITEM_TYPE_PICKAXE, Effect::HASTE, 0, 1, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::OXYGENATE, "Oxygenate", 1, CustomEnchant::TYPE_HAND, CustomEnchant::ITEM_TYPE_PICKAXE, Effect::WATER_BREATHING, 0, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::SPRINGS, "Springs", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::JUMP_BOOST, 1, 0, CustomEnchant::RARITY_UNCOMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::MERMAID, "Mermaid", 1, CustomEnchant::TYPE_HELMET, CustomEnchant::ITEM_TYPE_HELMET, Effect::WATER_BREATHING, 0, 0, CustomEnchant::RARITY_COMMON));
        self::registerEnchantment(new ToggleableEffectEnchant($plugin, CustomEnchantIds::ANTIGRAVITY, "AntiGravity", 1, CustomEnchant::TYPE_BOOTS, CustomEnchant::ITEM_TYPE_BOOTS, Effect::JUMP_BOOST, 2, 0, CustomEnchant::RARITY_UNCOMMON));

        self::registerEnchantment(new AutoAimEnchant($plugin, CustomEnchantIds::AUTOAIM));
        self::registerEnchantment(new AutoRepairEnchant($plugin, CustomEnchantIds::AUTOREPAIR));
        self::registerEnchantment(new ArmoredEnchant($plugin, CustomEnchantIds::ARMORED));
        self::registerEnchantment(new BombardmentEnchant($plugin, CustomEnchantIds::BOMBARDMENT));
        self::registerEnchantment(new BountyHunterEnchant($plugin, CustomEnchantIds::BOUNTYHUNTER));
        self::registerEnchantment(new DrillerEnchant($plugin, CustomEnchantIds::DRILLER));
        self::registerEnchantment(new EnergizingEnchant($plugin, CustomEnchantIds::ENERGIZING));
        self::registerEnchantment(new EnlightedEnchant($plugin, CustomEnchantIds::ENLIGHTED));
        self::registerEnchantment(new ExplosiveEnchant($plugin, CustomEnchantIds::EXPLOSIVE));
        self::registerEnchantment(new FarmerEnchant($plugin, CustomEnchantIds::FARMER));
        self::registerEnchantment(new FertilizerEnchant($plugin, CustomEnchantIds::FERTILIZER));
        self::registerEnchantment(new GrapplingEnchant($plugin, CustomEnchantIds::GRAPPLING));
        self::registerEnchantment(new HarvestEnchant($plugin, CustomEnchantIds::HARVEST));
        self::registerEnchantment(new HeadhunterEnchant($plugin, CustomEnchantIds::HEADHUNTER));
        self::registerEnchantment(new HealingEnchant($plugin, CustomEnchantIds::HEALING));
        self::registerEnchantment(new ImplantsEnchant($plugin, CustomEnchantIds::IMPLANTS));
        self::registerEnchantment(new JackpotEnchant($plugin, CustomEnchantIds::JACKPOT));
        self::registerEnchantment(new LifestealEnchant($plugin, CustomEnchantIds::LIFESTEAL));
        self::registerEnchantment(new LightningEnchant($plugin, CustomEnchantIds::LIGHTNING));
        self::registerEnchantment(new LuckyCharmEnchant($plugin, CustomEnchantIds::LUCKYCHARM));
        self::registerEnchantment(new LumberjackEnchant($plugin, CustomEnchantIds::LUMBERJACK));
        self::registerEnchantment(new MissileEnchant($plugin, CustomEnchantIds::MISSILE));
        self::registerEnchantment(new MolotovEnchant($plugin, CustomEnchantIds::MOLOTOV));
        self::registerEnchantment(new OverloadEnchant($plugin, CustomEnchantIds::OVERLOAD));
        self::registerEnchantment(new ParalyzeEnchant($plugin, CustomEnchantIds::PARALYZE));
        self::registerEnchantment(new PiercingEnchant($plugin, CustomEnchantIds::PIERCING));
        self::registerEnchantment(new QuickeningEnchant($plugin, CustomEnchantIds::QUICKENING));
        self::registerEnchantment(new RadarEnchant($plugin, CustomEnchantIds::RADAR));
        self::registerEnchantment(new ShuffleEnchant($plugin, CustomEnchantIds::SHUFFLE));
        self::registerEnchantment(new SmeltingEnchant($plugin, CustomEnchantIds::SMELTING));
        self::registerEnchantment(new SoulboundEnchant($plugin, CustomEnchantIds::SOULBOUND));
        self::registerEnchantment(new TankEnchant($plugin, CustomEnchantIds::TANK));
        self::registerEnchantment(new TelepathyEnchant($plugin, CustomEnchantIds::TELEPATHY));
        self::registerEnchantment(new VolleyEnchant($plugin, CustomEnchantIds::VOLLEY));
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

    public static function getPlugin(): PiggyCustomEnchants
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
