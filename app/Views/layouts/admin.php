<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softec">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="<?= base_url('images/favicon.png') ?>">
    <title>Softec</title>

    <!-- Meta Tag para Responsividade + Bloqueio de Zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">

    <!-- Configurações para PWA -->
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#7952b3">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Softec">
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/icon-192.png') ?>">

    <!-- CSS do Template -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashlite9b70.css') ?>">
    <link id="skin-default" rel="stylesheet" href="<?= base_url('assets/css/theme9b70.css') ?>">
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar">   
    <div class="nk-app-root">
        <div class="nk-main"> 
            <div class="nk-wrap"> 
                <?= $this->include('layouts/navbar') ?>
                <?= $this->include('layouts/sidebar') ?>
                <div class="nk-content"> 
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner de Instalação do PWA (DashLite Style) -->
    <div id="pwaInstallBanner" class="alert alert-fill alert-primary alert-icon shadow-lg fixed-bottom m-3 d-none" style="z-index: 9999; max-width: 420px;" role="alert">
        <em class="icon ni ni-download-cloud"></em>
        <span>Instale nosso aplicativo para acesso rápido!</span>
        <button id="btnInstallPWA" class="btn btn-sm btn-light ms-2">Instalar</button>
        <button type="button" class="btn-close" onclick="$('#pwaInstallBanner').addClass('d-none');" aria-label="Close"></button>
    </div>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>
    
    <!-- Scripts do Template -->
    <script src="<?= base_url('assets/js/bundle9b70.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts9b70.js') ?>"></script>
    <script src="<?= base_url('assets/js/demo-settings9b70.js') ?>"></script>

    <!-- Script de Registro e Controle do PWA -->
    <script>
        // 1. Registro do Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('<?= base_url('sw.js') ?>')
                    .catch(err => console.error('Erro ao registrar o Service Worker:', err));
            });
        }

        // 2. Lógica para Exibir e Executar o Prompt de Instalação PWA
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            $('#pwaInstallBanner').removeClass('d-none');
        });

        $('#btnInstallPWA').on('click', function () {
            $('#pwaInstallBanner').addClass('d-none');
            
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('O usuário aceitou a instalação do PWA.');
                    }
                    deferredPrompt = null;
                });
            }
        });

        // 3. Bloqueia gesto de Pinça e Duplo Toque (Zoom no Safari/iOS)
        document.addEventListener('gesturestart', function (e) {
            e.preventDefault();
        });

        document.addEventListener('dblclick', function (e) {
            e.preventDefault();
        }, { passive: false });
    </script>
    <script>
// 1. Registra o Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('<?= base_url('sw.js') ?>')
            .catch(err => console.log('Erro no Service Worker:', err));
    });
}

// 2. Lógica para exibir a mensagem e botão de instalação PWA
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    // Impede o Chrome de exibir o prompt padrão automaticamente
    e.preventDefault();
    deferredPrompt = e;

    // Exibe o nosso banner personalizado
    $('#pwaInstallBanner').removeClass('d-none');
});

// Clique no botão "Instalar"
$('#btnInstallPWA').on('click', function () {
    $('#pwaInstallBanner').addClass('d-none');
    
    if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('Usuário aceitou a instalação do PWA');
            }
            deferredPrompt = null;
        });
    }
});

// 3. Bloqueia o zoom no Safari/iOS e navegadores móveis (Double tap & Pinch)
document.addEventListener('gesturestart', function (e) {
    e.preventDefault();
});

document.addEventListener('dblclick', function (e) {
    e.preventDefault();
}, { passive: false });
</script>
</body> 

</html>