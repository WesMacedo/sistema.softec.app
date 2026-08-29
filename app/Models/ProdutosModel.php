<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $table = 'produtos'; 
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sku',
        'id_empresa',
        'id_user',
        'categoria',
        'nome',
        'descricao',
        'garantia_dias',
        'estoque',
        'valor_custo',
        'valor_atacado',
        'valor_varejo',
        'cor',
        'tamanho',
        'modelo',
        'ativo',
        'catalogo',
        'desconto',
        'valor_desconto',
        'alterado_por',
        'ultima_alteracao'
    ];
    
    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'ultima_alteracao';
}