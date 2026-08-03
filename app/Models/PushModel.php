<?php

namespace App\Models;

use CodeIgniter\Model;

class PushModel extends Model
{
    protected $table      = 'push_subscriptions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'endpoint', 'p256dh', 'auth', 'criado_em'];
}