<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SuperAdmin()
 * @method static static Admin()
 * @method static static Customer()
 * @method static static User()
 */
final class UserAuthority extends Enum
{
    const SuperAdmin = "super_admin";
    const Admin = "admin";
    const Customer = "customer";
    const User = "user";
}

