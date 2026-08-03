<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\DatabaseHandler;

class Session extends BaseConfig
{
    /**
     * Usa o banco de dados em vez de arquivos locais para evitar perda de sessão
     */
    public string $driver = DatabaseHandler::class;

    /**
     * Nome do cookie de sessão (garanta que seja exclusivo do seu projeto)
     */
    public string $cookieName = 'softec_session';

    /**
     * Tempo de expiração em segundos (2592000 segundos = 30 dias)
     */
    public int $expiration = 2592000;

    /**
     * Nome da tabela que você acabou de criar no banco de dados
     */
    public string $savePath = 'ci_sessions';

    public bool $matchIP = false;

    public int $timeToUpdate = 300;

    public bool $regenerateDestroy = false;

    public ?string $DBGroup = null;

    /**
     * Configurações cruciais de Cookies para PWAs e HTTPS
     */
    public string $cookiePath = '/';
    public ?string $cookieDomain = '';
    public bool $cookieSecure = true;       // Mantenha true já que seu app roda em HTTPS
    public bool $cookieHTTPOnly = true;
    public ?string $cookieSameSite = 'Lax';

    public int $lockRetryInterval = 100_000;
    public int $lockMaxRetries = 300;
}