<?php

namespace App\Helpers\Interfaces;

interface MailInterface
{
    //
    const STATUS_ACTIVE = 'MAIL::STATUS::ACTIVE';
    const STATUS_DRAFT = 'MAIL::STATUS::DRAFT';
    const STATUS_DEACTIVATED = 'MAIL::STATUS::DEACTIVATED';
    const STATUS_EXPIRED = 'MAIL::STATUS::EXPIRED';
}
