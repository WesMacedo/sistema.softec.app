<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes'; 
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'id_cliente',
        'id_empresa',
        'tipo',
        'cpf_cnpj',
        'nome_razaosocial',
        'insc_municipal',
        'insc_estadual',
        'email',
        'whatsapp',
        'celular',
        'telefone',
        'cep',
        'rua',
        'n_casa',
        'bairro',
        'cidade',
        'saldo',
        'estado'
    ];
    protected $useTimestamps = true; 
}