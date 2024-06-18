<?php

use App\Repositories\NotificationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;

function encrypt_data($value): string
{
    return Crypt::encryptString($value);
}

function decrypt_data($value): string
{
    return !is_null($value) ? Crypt::decryptString($value) : "";
}

function getCampaignIdFromCode(string $code): string
{
    return str_replace('#', '', strstr($code, "#"));
}

function date_format_trans(string $date, bool $with_week = false): string
{
    $weeks = ["Sun" => "Domingo","Mon" => "Segunda", "Tue" => "Terça", "Wed" => "Quarta","Thu" => "Quinta","Fri" => "Sexta","Sat" => "Sábado"];

    $months = [
        "Jan" => "Janeiro", "Feb" => "Fevereiro", "Mar" => "Março", "Apr" => "Abril", "May" => "Maio", "Jun" => "Junho", "Jul" => "Julho", "Aug" => "Agosto", "Sep" => "Setembro", "Oct" => "Outubro", "Nov" => "Novembro", "Dec" => "Dezembro"
    ];

    $date = (new DateTime())->setDate(date('Y'), date_format(date_create($date), 'm'), date_format(date_create($date), 'd'));

    if ($with_week == false) {
        $date = $date->format('M, d');

    } else {
        $date = $date->format('D, M, d');
    }

    $date = explode(", ", $date);

    if($with_week && !array_key_exists($date[1], $months)){
        return "Invalid date";
    }else if($with_week && !array_key_exists($date[0], $weeks)){
        return "Invalid date";
    }else if(!$with_week && !array_key_exists($date[0], $months)){
        return "Invalid date";
    }

    return $with_week ? $weeks[$date[0]] .", ". $months[$date[1]] .", ". $date[2] : $months[$date[0]] . ", " . $date[1];
}

function notifications($type = "list"): int|array|Collection
{
    $notificationRepository = new NotificationRepository();

    switch($type) {
        case "counter": return $notificationRepository->getNotificationsGlobalNotRead()->count();
        case "list": return $notificationRepository->getNotificationsGlobalNotRead()->toArray();
        case "collection":
        default: return $notificationRepository->getNotificationsGlobalNotRead()->get();
    }
}

function notification_datetime(string $datetime): string {
    $diff = now()->diff(new \DateTime($datetime));

    if($diff->h <= 24 && $diff->h >= 1)
    {
        return ($diff->h > 1) ? "à {$diff->h} horas atrás" : "à {$diff->h} hora atrás";
    }else if($diff->m > 0 && $diff->h < 1){
        return ($diff->m > 1) ? "à {$diff->m} minutos atrás" : "à {$diff->m} minuto atrás";
    }else if($diff->m < 1 && $diff->h <= 1){
        return ($diff->s > 1) ? "à {$diff->s} segundos atrás" : "à {$diff->s} segundo atrás";
    }else{
        $datetime = new DateTime($datetime);
        return "{$datetime->format('d-m-y H:i:s')}";
    }
}

function weekday($weekday_number): string
{
    $weekday = [
        1 => "Domingo", 2 => "Segunda", 3 => "Terça", 4 => "Quarta", 5 => "Quinta", 6 => "Sexta", 7 => "Sábado"
    ];

    return $weekday[$weekday_number];
}

function generateHexColor(): string
{
    return sprintf('#%06x', mt_rand(0, 0xFFFFFF));
}
