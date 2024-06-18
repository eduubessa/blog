<?php

namespace App\Helpers\Interfaces;

interface CampaignInterface {

    const TYPE_CLASSIC = "CAMPAIGN::TYPE::CLASSIC";

    const STATUS_DRAFT  = 'CAMPAIGN::STATUS::DRAFT';
    const STATUS_ACTIVE = 'CAMPAIGN::STATUS::ACTIVE';
    const STATUS_DEACTIVATED = "CAMPAIGN::STATUS::DEACTIVATED";
    const STATUS_EXPIRED = 'CAMPAIGN::STATUS::EXPIRED';
}
