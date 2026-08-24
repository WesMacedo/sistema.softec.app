<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes'; // Substitua pelo nome real da sua tabela se for diferente
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'id_loja',
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
        'estado'
    ];
    protected $useTimestamps = true; // Opcional, caso tenha created_at e updated_at
}