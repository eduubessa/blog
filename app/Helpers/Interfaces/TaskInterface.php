<?php

namespace App\Helpers\Interfaces;

interface TaskInterface {

    const STATUS_RUNNING = "AUTOMATION::STATUS::RUNNING";
    const STATUS_WAITING = "AUTOMATION::STATUS::WAITING";
    const STATUS_PAUSED  = "AUTOMATION::STATUS::PAUSED";
    const STATUS_STOPPED = "AUTOMATION::STATUS::STOPPED";

    const NOTIFICATION_ON = "AUTOMATION::NOTIFICATION::ON";
    const NOTIFICATION_OFF = "AUTOMATION::NOTIFICATION::OFF";

    const NOTIFICATION_TYPE_MAIL = "AUTOMATION::NOTIFICATION::MAIL";
    const NOTIFICATION_TYPE_ALERT = "AUTOMATION::NOTIFICATION::ALERT";
    const NO_REPEAT = "AUTOMATION::REPEAT::NO_REPEAT";
    const SECONDLY = "AUTOMATION::REPEAT::SECONDLY";
    const MINUTELY = "AUTOMATION::REPEAT::MINUTELY";
    const HOURLY = "AUTOMATION::REPEAT::HOURLY";
    const DAILY= "AUTOMATION::REPEAT::DAILY";
    const WEEKLY = "AUTOMATION::REPEAT::WEEKLY";
    const MONTHLY = "AUTOMATION::REPEAT::MONTHLY";
    const YEARLY = "AUTOMATION::REPEAT::YEARLY";
}
