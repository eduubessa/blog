<?php

namespace App\Helpers\Interfaces;

interface ActivationAccountInterface {
    const STATUS_USED       = 'ACTIVATION_ACCOUNT::STATUS::USED';
    const STATUS_ACTIVE     = 'ACTIVATION_ACCOUNT::STATUS::ACTIVE';
    const STATUS_EXPIRED    = 'ACTIVATION_ACCOUNT::STATUS::EXPIRED';
}
