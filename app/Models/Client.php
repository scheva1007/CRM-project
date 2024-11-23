<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUSES = [
        'ordered' => 'Заказывал',
        'not ordered' => 'Не заказывал',
        'vip client' => 'ВИП клиент',
    ];
}
