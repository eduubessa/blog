<?php

namespace App\Helpers\Interfaces;

interface UserInterface {

    const STATUS_ACTIVE         = "USER::STATUS::ACTIVE";
    const STATUS_INACTIVE       = "USER::STATUS::INACTIVE";
    const STATUS_PENDING        = "USER::STATUS::PENDING";
    const STATUS_SUSPENDED      = "USER::STATUS::SUSPENDED";
    const STATUS_DELETED        = "USER::STATUS::DELETED";
    const STATUS_BANNED         = "USER::STATUS::BANNED";
    const STATUS_EXPIRED        = "USER::STATUS::EXPIRED";
    const TYPE_CLIENT           = "USER::TYPE::CLIENT";
    const TYPE_ADMIN            = "USER::TYPE::ADMIN";

}
