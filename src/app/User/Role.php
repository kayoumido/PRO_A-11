<?php

namespace App\User;

use MyCLabs\Enum\Enum;

/**
 * @method static self PRESENTER()
 * @method static self ATENDEE()
 */
class Role extends Enum
{
    private const PRESENTER = "presenter";
    private const ATENDEE = "atendee";
}