<!DOCTYPE html>
<html lang="">
 
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softec">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Softec</title>
    <link rel="stylesheet" href="assets/css/dashlite9b70.css">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme9b70.css">
    <link rel="manifest" href="/manifest.json"> 
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar ">  
    <div class="nk-app-root">
        <div class="nk-main "> 
            <div class="nk-wrap "> 
                <?= $this->include('layouts/navbar') ?>
                <?= $this->include('layouts/sidebar') ?>
                <div class="nk-content "> 
                    <button onclick="ativarNotificacoesSistema()">Ativar Notificações</button>

<script>
const publicVapidKey = 'BCyPg8VlqtHZOsIEmvhwLAIt9uU4rfF409XbwTLO0IChduRuVaecg-8Rt92lUSAkSdCJYqKtSLh4DPMI3ZogT2k';

async function ativarNotificacoesSistema() {
    if (!('serviceWorker' in navigator)) {
        alert('Seu navegador não suporta Service Worker.');
        return;
    }

    const permission = await Notification.requestPermission();
    if (permission !== 'granted') {
        alert('Você precisa permitir as notificações.');
        return;
    }

    try {
        const registration = await navigator.serviceWorker.ready;
        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(publicVapidKey)
        });

        // Envia para o arquivo PHP salvar no SQL
        const response = await fetch('salvar-inscricao.php', {
            method: 'POST',
            body: JSON.stringify(subscription),
            headers: { 'Content-Type': 'application/json' }
        });

        const resultado = await response.json();
        if (resultado.success) {
            alert('Notificações ativadas com sucesso neste dispositivo!');
        } else {
            alert('Erro ao salvar: ' + resultado.message);
        }

    } catch (error) {
        console.error('Erro ao ativar push:', error);
    }
}

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
</script>
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

        <!-- Footer -->
        <?= $this->include('layouts/footer') ?>
        </div>
    </div> 
    
  
    <script src="assets/js/bundle9b70.js"></script>
    <script src="assets/js/scripts9b70.js"></script>
    <script src="assets/js/demo-settings9b70.js"></script>
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
</body> 

</html>