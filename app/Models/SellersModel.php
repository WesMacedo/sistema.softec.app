<?php

namespace App\Models;

use CodeIgniter\Model;

class SellersModel extends Model
{
    protected $table = 'top_sellers_ranking'; // nome da tabela no banco
    protected $primaryKey = 'id'; // ajuste se necessário
    protected $allowedFields = ['position', 'name', 'total_amount']; // ajuste conforme os campos reais
}
