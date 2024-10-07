<?php

declare(strict_types=1);

namespace App\Enum;

enum CommentStatusEnum: string
{
	case VALID = 'valid';
	case INVALID = 'invalid';
	case REJECTED = 'rejected';
	case WAITING = 'waiting';
}
