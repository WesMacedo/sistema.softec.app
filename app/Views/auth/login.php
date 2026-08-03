<!DOCTYPE html>
<html lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestão para loja de celulares e iformática.">
    <link rel="shortcut icon" href="<?= base_url() ?>images/favicon.png">
    <title>Softec - Login</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite9b70.css?ver=3.3.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme9b70.css?ver=3.3.0">
        <link rel="manifest" href="/manifest.json"> 
</head>

<body class="nk-body npc-default pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content "> 
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center"><div
                                class="logo-link"><img class="logo-light logo-img logo-img-lg"
                                    src="<?= base_url() ?>images/logo_1.png" srcset="/demo3/images/logo_1.png 2x"
                                    alt="logo"><img class="logo-dark logo-img logo-img-lg"
                                    src="<?= base_url() ?>images/logo_1.png"
                                    srcset="/demo3/images/logo_1.png 2x" alt="logo-dark"></div><div id="mensagem" class="mt-3"></div></div>
                                     
                        <div class=""> 
                           <!-- Banner de Instalação PWA Softec System -->
<div id="pwa-install-banner" class="pwa-banner d-none">
    <div class="pwa-banner-content">
        <div class="pwa-icon">
            <i class="fas fa-mobile-alt"></i> <!-- Ícone de celular (ou use uma tag <img> se preferir) -->
        </div>
        <div class="pwa-text">
            <h4>Instale o Softec System</h4>
            <p>Tenha acesso rápido direto na tela inicial do seu dispositivo, sem ocupar espaço.</p>
        </div>
        <div class="pwa-actions">
            <button id="btn-install" class="pwa-btn-install">Instalar Agora</button>
            <button id="btn-close-banner" class="pwa-btn-close" title="Fechar">&times;</button>
        </div>
    </div>
</div>

<!-- Estilos do Banner (Pode colocar no seu arquivo CSS principal ou dentro de <style>) -->
<style>
.pwa-banner {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    max-width: 500px;
    background: #ffffff;
    color: #333333;
    padding: 16px 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    z-index: 9999; 
    animation: slideUp 0.4s ease-out;
}

.pwa-banner-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.pwa-icon {
    background: #eef2ff;
    color: #317EFB;
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.pwa-text {
    flex-grow: 1;
}

.pwa-text h4 {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
}

.pwa-text p {
    margin: 0;
    font-size: 13px;
    color: #64748b;
    line-height: 1.4;
}

.pwa-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.pwa-btn-install {
    background-color: #317EFB;
    color: #ffffff;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
}

.pwa-btn-install:hover {
    background-color: #2563eb;
}

.pwa-btn-close {
    background: transparent;
    border: none;
    font-size: 22px;
    color: #94a3b8;
    cursor: pointer;
    padding: 0;
    line-height: 1;
}

.pwa-btn-close:hover {
    color: #334155;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translate(-50%, 20px);
    }
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}
</style>
                            <div class="card-inner card-inner-lg"> 
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Login no sistema.</h4>
                                        <div class="nk-block-des">
                                            <p>Faça login com suas credênciais.</p>
                                        </div>
                                    </div>
                                </div> 
                                <form id="loginForm">
                                    <div class="form-group">
                                        <div class="form-label-group"><label class="form-label"
                                                for="default-01">Email</label></div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="email"
                                                name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group"><label class="form-label"
                                                for="password">Senha</label><a class="link link-primary link-sm"
                                                href="auth-reset-v2.html">Esqueceu a senha?</a></div>
                                        <div class="form-control-wrap"><a href="#"
                                                class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password"><em
                                                    class="passcode-icon icon-show icon ni ni-eye"></em><em
                                                    class="passcode-icon icon-hide icon ni ni-eye-off"></em></a>
                                            <input type="password" class="form-control form-control-lg" name="senha"
                                                id="senha" placeholder="Senha">
                                        </div>
                                    </div>
                                    <div class="form-group"><button class="btn btn-lg btn-primary btn-block"
                                            id="btnEntrar">Entrar</button></div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Não possui uma conta ? <a
                                        href="cadastro">Cadastre-se</a></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url() ?>assets/js/bundle9b70.js?ver=3.3.0"></script>
    <script src="<?= base_url() ?>assets/js/scripts9b70.js?ver=3.3.0"></script>
    <script>
        $(document).ready(function () {
            $('#btnEntrar').on('click', function (e) {
                e.preventDefault();

                const email = $('#email').val().trim();
                const senha = $('#senha').val().trim();
                $('#mensagem').empty();

                // Função para validar formato do email
                function emailValido(email) {
                    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return regex.test(email);
                }

                // Validação dos campos
                if (email === '' || senha === '') {
                    const alertaCampos = `
                    <div class="alert alert-fill alert-warning alert-icon alert-dismissible fade show shadow-sm border-theme-white-2 mb-0" role="alert">
                 
                    Por favor, preencha todos os campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    $('#mensagem').html(alertaCampos);
                    return;
                }

                // Validação do formato do e-mail
                if (!emailValido(email)) {
                    const alertaEmail = `
                    <div class="alert alert-fill alert-warning alert-icon alert-dismissible fade show shadow-sm border-theme-white-2 mb-0" role="alert">
                    
                    Por favor, insira um e-mail válido.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                    $('#mensagem').html(alertaEmail);
                    return;
                }

                // Se passou na validação, faz o AJAX
                $.ajax({
                    url: '<?= base_url('auth/autenticar') ?>',
                    type: 'POST',
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $('#mensagem').empty();

                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            const alertaErro = ` 
                             <div class="alert alert-fill alert-danger alert-dismissible alert-icon">
                                 ${response.message} 
                                <button class="close" data-bs-dismiss="alert"></button>
                            </div>`;
                            $('#mensagem').html(alertaErro);
                        }
                    },
                    error: function () {
                        const alertaErro = `
                    <div class="alert alert-fill alert-danger alert-dismissible alert-icon">
                      Erro ao processar a requisição. 
                    <button class="close" data-bs-dismiss="alert"></button>
                    </div>   
                `;
                        $('#mensagem').html(alertaErro);
                    }
                });
            });
        });


    </script>
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => {
                    console.log('Service Worker registrado com sucesso:', reg.scope);
                })
                .catch(err => {
                    console.log('Falha ao registrar o Service Worker:', err);
                });
        });
    }
</script>
    <script>
    let deferredPrompt;
    const installBanner = document.getElementById('pwa-install-banner');
    const installBtn = document.getElementById('btn-install');
    const closeBtn = document.getElementById('btn-close-banner');

    // Ouve o evento do navegador quando o PWA está pronto para ser instalado
    window.addEventListener('beforeinstallprompt', (e) => {
        // Evita que o navegador mostre o mini-infobar padrão
        e.preventDefault();
        // Salva o evento para usar depois
        deferredPrompt = e;
        
        // Exibe o nosso banner bonito
        if (installBanner) {
            installBanner.classList.remove('d-none');
        }
    });

    // Ação ao clicar no botão "Instalar Agora"
    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                // Dispara o prompt nativo de instalação do navegador
                deferredPrompt.prompt();
                // Aguarda a resposta do usuário
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('Usuário aceitou a instalação');
                }
                deferredPrompt = null;
                installBanner.classList.add('d-none');
            }
        });
    }

    // Botão para fechar o banner (caso o usuário recuse no momento)
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            installBanner.classList.add('d-none');
        });
    }

    // Esconde o banner automaticamente se o app já foi instalado
    window.addEventListener('appinstalled', () => {
        installBanner.classList.add('d-none');
        console.log('Softec System instalado com sucesso!');
    });
</script>

</html>