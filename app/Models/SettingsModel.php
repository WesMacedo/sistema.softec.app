<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'inicio_corrida',
        'termino_corrida',
        'email',
        'instagram',
        'whatsapp',
        'status',
        'botao_gateway',
        'botao_plataforma',
    ];
}

class FakeSellerModel extends Model
{
    protected $table = 'fake_seller';
    protected $primaryKey = 'id';
    protected $allowedFields = ['total_amount_in_cents', 'name'];
}
