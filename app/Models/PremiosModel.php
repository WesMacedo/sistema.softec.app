<?php

namespace App\Models;

use CodeIgniter\Model;

class PremiosModel extends Model
{
    protected $table = 'premios'; 
    protected $primaryKey = 'id';  
    protected $allowedFields = ['id', 'descricao', 'img']; 
}
