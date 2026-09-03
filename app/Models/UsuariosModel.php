<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
 
    protected $allowedFields = [
        'nome_empresa', 
        'nome', 
        'email', 
        'whatsapp', 
        'senha', 
        'tentativas_login', 
        'bloqueado_ate', 
        'otp',          // <-- Adicione esta linha
        'otp_validade', // <-- Adicione esta linha
        'remember_token',
        'token'
    ];
    
    protected $useTimestamps = false;

    /**
     * Atualiza tentativas de login, bloqueio e token do usuário
     *
     * @param int $id
     * @param int $tentativas
     * @param string|null $bloqueado_ate
     * @param string|null $token
     * @return bool
     */
    public function atualizarTentativas($id, $tentativas, $bloqueado_ate = null, $token = null)
    {
        return $this->update($id, [
            'tentativas_login' => $tentativas,
            'bloqueado_ate'    => $bloqueado_ate,
            'token'            => $token
        ]);
    }

    /**
     * Gera um token único para o usuário
     *
     * @return string
     */
    public function gerarToken()
    {
        return bin2hex(random_bytes(16));  // Gera um token de 32 caracteres
    }

    /**
     * Busca o usuário em tempo real utilizando apenas o token de segurança
     *
     * @param string $token
     * @return array|null
     */
    public function getUsuarioPorToken($token)
    {
        if (empty($token)) {
            return null;
        }
        return $this->where('token', $token)->first();
    }
}