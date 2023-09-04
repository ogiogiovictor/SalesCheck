<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Active()
 * @method static static Inactive()
 */
final class CompanyStatusEnum extends Enum
{
    const Active = 1;
    const Inactive = 0;
}
