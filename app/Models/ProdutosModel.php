<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $table = 'produtos'; 
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_empresa',
        'id_user',
        'id_produto',
        'categoria',
        'produto',
        'descricao',
        'garantia',
        'estoque',
        'valor_custo',
        'valor_varejo',
        'valor_atacado',
        'atacado',
        'cor',
        'tamanho',
        'modelo',
        'ativo',
        'catalogo',
        'tipo_desconto',
        'valor_desconto',
        'alterado_por',
        'ultima_alteracao'
    ];
    
    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'ultima_alteracao';
}