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
                     <!-- Banner de Instalação PWA -->
<div id="pwa-install-banner" class="alert alert-primary alert-dismissible fade show m-3 d-none shadow" role="alert" style="background-color: #317EFB; color: white; border: none;">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h5 class="alert-heading mb-1 font-weight-bold">📱 Instalar o Softec System</h5>
            <p class="mb-0">Instale nosso aplicativo na sua tela inicial para um acesso mais rápido e prático!</p>
        </div>
        <div>
            <button id="btn-install" class="btn btn-light btn-sm font-weight-bold px-3 py-2 text-primary">Instalar Agora</button>
            <button type="button" class="close text-white border-0 bg-transparent ml-2" data-dismiss="alert" aria-label="Close" id="btn-close-banner" style="font-size: 1.5rem; cursor: pointer;">&times;</button>
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

    // Ouve o evento do navegador que avisa que o app pode ser instalado
    window.addEventListener('beforeinstallprompt', (e) => {
        // Impede que o mini-infobar padrão do Chrome apareça automaticamente
        e.preventDefault();
        // Guarda o evento para disparar quando o usuário clicar no botão
        deferredPrompt = e;
        
        // Exibe o nosso banner customizado
        if (installBanner) {
            installBanner.classList.remove('d-none');
        }
    });

    // Quando o usuário clica no botão "Instalar Agora"
    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                // Mostra a janela nativa de instalação do navegador
                deferredPrompt.prompt();
                // Espera a escolha do usuário
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('Usuário aceitou instalar o PWA');
                } else {
                    console.log('Usuário recusou instalar o PWA');
                }
                deferredPrompt = null;
                installBanner.classList.add('d-none');
            }
        });
    }

    // Botão para fechar/esconder o banner se o usuário não quiser agora
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            installBanner.classList.add('d-none');
        });
    }

    // Esconde o banner caso o app já tenha sido instalado com sucesso
    window.addEventListener('appinstalled', () => {
        installBanner.classList.add('d-none');
        console.log('PWA instalado com sucesso!');
    });
</script>

</html>