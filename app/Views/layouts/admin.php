<!DOCTYPE html>
<html lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta name="author" content="Softec">
   <meta name="description"
      content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
   <link rel="shortcut icon" href="<?= base_url('images/favicon.png')?>">
   <title>Softec</title>
   <link rel="stylesheet" href="<?= base_url('assets/css/dashlite9b70.css')?>">
   <link id="skin-default" rel="stylesheet" href="<?= base_url('assets/css/theme9b70.css')?>">
   <link rel="manifest" href="<?= base_url('manifest.json')?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 


   <!-- FontAwesome Icons -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/libs/fontawesome-icons9b70.css')?>">

   <!-- Themify Icons -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/libs/themify-icons9b70.css')?>">

   <!-- Bootstrap Icons -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/libs/bootstrap-icons9b70.css')?>">
   <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/libs/bootstrap-icons.min.css')?>">
   <!-- SweetAlert2 CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

   <!-- SweetAlert2 JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar -mode" theme=""> 
   <!-- Tela de Loading Inicial do PWA -->
   <div id="pwa-loader"
      style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;  display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 999999; transition: opacity 0.3s ease;">
      <div class="spinner-border text-primary" role="status"></div>
      
   </div>

 
   <script>
   // Assim que a página carregar por completo, esmaece e remove o loader suavemente
   window.addEventListener('load', function() {
      const loader = document.getElementById('pwa-loader');
      if (loader) {
         loader.style.opacity = '0';
         setTimeout(function() {
            loader.style.display = 'none';
         }, 500);
      }
   });
   </script>
   <div class="nk-app-root">
      <div class="nk-main ">
         <div class="nk-wrap ">
            <?= $this->include('layouts/navbar') ?>
            <?= $this->include('layouts/sidebar') ?>
            <div class="nk-content ">

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
                        <div id="ios-instruction" class="ios-instruction d-none"
                           style="font-size: 12px; color: #64748b; line-height: 1.3;">
                           Toque em <b>Compartilhar</b> <i class="fas fa-share-square"></i> e depois em <b>"Adicionar à
                              Tela Inicial"</b>.
                        </div>
                        <button id="btn-close-banner" class="pwa-btn-close" title="Fechar">&times;</button>
                     </div>
                  </div>
               </div>
               <?= $this->renderSection('content') ?>
            </div>
         </div>
      </div>
   </div>

   <!-- Footer -->
   <?= $this->include('layouts/footer') ?>
   </div>
   </div>


   <script src="<?= base_url('assets/js/bundle9b70.js')?>"></script>
   <script src="<?= base_url('assets/js/scripts9b70.js')?>"></script>
   <script src="<?= base_url('assets/js/demo-settings9b70.js')?>"></script>   
   <script src="<?= base_url('assets/js/libs/datatable-btns9b70.js?ver=3.3.0')?>"></script>

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
            const {
               outcome
            } = await deferredPrompt.userChoice;
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
   const publicVapidKey = 'BCyPg8VlqtHZOsIEmvhwLAIt9uU4rfF409XbwTLO0IChduRuVaecg-8Rt92lUSAkSdCJYqKtSLh4DPMI3ZogT2k';

   async function ativarPush() {
      if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
         alert('Seu navegador não suporta notificações push.');
         return;
      }

      const permission = await Notification.requestPermission();
      if (permission !== 'granted') {
         alert('Permissão de notificação negada.');
         return;
      }

      try {
         const registration = await navigator.serviceWorker.ready;
         const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(publicVapidKey)
         });

         // Aponta para a rota global da nova Controller
         const response = await fetch('<?= base_url("push/salvar-inscricao") ?>', {
            method: 'POST',
            body: JSON.stringify(subscription),
            headers: {
               'Content-Type': 'application/json'
            }
         });

         const resultado = await response.json();
         if (resultado.success) {
            alert('Notificações ativadas com sucesso!');
         } else {
            alert('Erro ao salvar no banco.');
         }

      } catch (error) {
         console.error('Erro:', error);
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

   document.addEventListener('touchstart', function(e) {
      if (e.touches.length === 1) {
         let touchX = e.touches[0].clientX;

         // Verifica se o toque começou exatamente nos primeiros 20 pixels da bordinha esquerda ou direita
         // (que é onde o Android e o iOS acionam o gesto de voltar arrastando)
         if (touchX < 20 || touchX > (window.innerWidth - 20)) {
            // Cancela apenas esse gesto de arrastar nas bordas extremas, liberando cliques normais
            e.preventDefault();
         }
      }
   }, {
      passive: false
   });

   document.addEventListener("DOMContentLoaded", function() {
    <?php if (session()->has('swal')): ?>
        <?php $swal = session()->getFlashdata('swal'); ?>
        Swal.fire({
            icon: '<?= $swal['icon'] ?? 'info' ?>',
            title: '<?= $swal['title'] ?? 'Aviso' ?>',
            text: '<?= $swal['text'] ?? '' ?>',
            confirmButtonText: '<?= $swal['confirmButtonText'] ?? 'OK' ?>'
        });
    <?php endif; ?>
});
   </script>

</body>

</html>