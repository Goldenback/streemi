<?php

declare(strict_types=1);

namespace App\Enum;

enum UserStatusEnum: string
{
	case ACTIVE = 'active';
	case INACTIVE = 'inactive';
	case DELETED = 'delete';
	case PENDING = 'pending';
	case SUSPENDED = 'suspended';
	case BANNED = 'banned';
}
