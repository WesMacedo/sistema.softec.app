<!DOCTYPE html>
<html lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softec"> 
    <meta name="description" content="Sistema de gestão para loja de celulares e iformática.">
    <link rel="shortcut icon" href="<?= base_url() ?>images/favicon.png">
    <title>Softec - Login</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite9b70.css?ver=3.3.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme9b70.css?ver=3.3.0">
        <link rel="manifest" href="/manifest.json"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<style>
    html, body {
    /* Impede o zoom por pinça do usuário */
    touch-action: pan-x pan-y;
    
    /* Impede que a página seja puxada para baixo gerando o efeito elástico/atualização */
    overscroll-behavior-y: none;
    
    /* Evita seleção de texto indesejada ao tocar na tela como app */
    -webkit-user-select: none;
    user-select: none;
    
    /* Remove o destaque cinza ao clicar em botões no mobile */
    -webkit-tap-highlight-color: transparent;
}
</style>

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
<!-- Banner de Instalação PWA (Versão Universal) -->
<div id="pwa-install-banner" class="pwa-banner d-none">
    <div class="pwa-banner-content">
        <div class="pwa-icon">
            <i class="fas fa-mobile-alt"></i>
        </div>
        <div class="pwa-text">
            <h4 id="pwa-title">Instale o Softec System</h4>
            <p id="pwa-desc">Clique no botão ao lado para instalar o app no seu dispositivo.</p>
        </div>
        <div class="pwa-actions">
            <!-- Botão para Android/Desktop/Windows -->
            <button id="btn-install" class="pwa-btn-install">Instalar</button>
            <!-- Instrução visual para iOS -->
            <div id="ios-instruction" class="ios-instruction d-none" style="font-size: 12px; color: #64748b; line-height: 1.3;">
                Toque em <b>Compartilhar</b> <i class="fas fa-share-square"></i> e depois em <b>"Adicionar à Tela Inicial"</b>.
            </div>
            <button id="btn-close-banner" class="pwa-btn-close" title="Fechar">&times;</button>
        </div>
    </div>
</div>

<style>
.pwa-banner {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 90%;
    max-width: 450px;
    background: #ffffff;
    color: #333333;
    padding: 14px 18px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    border-left: 5px solid #317EFB;
}
.pwa-banner-content { display: flex; align-items: center; gap: 12px; }
.pwa-icon { background: #eef2ff; color: #317EFB; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.pwa-text { flex-grow: 1; }
.pwa-text h4 { margin: 0 0 2px 0; font-size: 15px; font-weight: 700; color: #1e293b; }
.pwa-text p { margin: 0; font-size: 12px; color: #64748b; }
.pwa-actions { display: flex; align-items: center; gap: 8px; }
.pwa-btn-install { background-color: #317EFB; color: #ffffff; border: none; padding: 7px 12px; border-radius: 6px; font-weight: 600; font-size: 12px; cursor: pointer; white-space: nowrap; }
.pwa-btn-close { background: transparent; border: none; font-size: 20px; color: #94a3b8; cursor: pointer; padding: 0; }
.d-none { display: none !important; }
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
    const iosInstruction = document.getElementById('ios-instruction');
    const pwaDesc = document.getElementById('pwa-desc');

    // Função para detectar se é iOS (iPhone / iPad / iPod)
    const isIOS = () => {
        const userAgent = window.navigator.userAgent.toLowerCase();
        return /iphone|ipad|ipod/.test(userAgent);
    };

    // Função para verificar se o app já está rodando instalado (modo standalone)
    const isInStandaloneMode = () => {
        return (window.matchMedia('(display-mode: standalone)').matches) || (window.navigator.standalone === true);
    };

    // Se já estiver instalado, nem mostra o banner
    if (!isInStandaloneMode()) {
        if (isIOS()) {
            // Se for iPhone, mostra o banner adaptado com o passo a passo manual
            if (pwaDesc) pwaDesc.style.display = 'none'; // Esconde o texto padrão
            if (installBtn) installBtn.style.display = 'none'; // Esconde o botão de clique automático
            if (iosInstruction) iosInstruction.classList.remove('d-none'); // Mostra o texto do Safari
            if (installBanner) installBanner.classList.remove('d-none'); // Exibe o banner
        } else {
            // Para Android / Windows / Mac (comportamento padrão via evento)
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                if (installBanner) installBanner.classList.remove('d-none');
            });
        }
    }

    // Ação do botão de instalar (para Android/Windows)
    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                deferredPrompt = null;
                installBanner.classList.add('d-none');
            }
        });
    }

    // Fechar banner
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            installBanner.classList.add('d-none');
        });
    }

    window.addEventListener('appinstalled', () => {
        installBanner.classList.add('d-none');
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pega parâmetros da URL (ex: ?sucesso=...)
        const urlParams = new URLSearchParams(window.location.search);
        const mensagemSucesso = urlParams.get('sucesso');

        if (mensagemSucesso) {
            const alertaHTML = `
                <div class="alert alert-fill alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
                    ${decodeURIComponent(mensagemSucesso)}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            
            // Insira no seu container de mensagens da tela de login
            // Substitua '#mensagem-login' pelo ID real da div de alerta da sua view de login
            $('#mensagem-login').html(alertaHTML);
        }
    });
</script>
</html>