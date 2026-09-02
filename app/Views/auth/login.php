<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="utf-8">
   <meta name="author" content="Softec">
   <meta name="description" content="Sistema de gestão para loja de celulares e informática.">
   <link rel="shortcut icon" href="<?= base_url() ?>images/favicon.png">
   <title>Softec - Login</title>
   <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite9b70.css?ver=3.3.0">
   <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme9b70.css?ver=3.3.0">
   <link rel="manifest" href="/manifest.json">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <style>
      html, body {
         touch-action: pan-x pan-y;
         overscroll-behavior-y: none;
         -webkit-user-select: none;
         user-select: none;
         -webkit-tap-highlight-color: transparent;
      }
      @keyframes pulse {
         0% { transform: scale(0.95); opacity: 0.8; }
         50% { transform: scale(1.05); opacity: 1; }
         100% { transform: scale(0.95); opacity: 0.8; }
      }
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

      /* Estilo refinado dos cards de contas salvas (Estilo Instagram) */
      .saved-account-card {
         background: #ffffff;
         border: 1px solid #e2e8f0;
         border-radius: 10px;
         transition: all 0.2s ease;
      }
      .saved-account-card:hover {
         border-color: #cbd5e1;
         box-shadow: 0 4px 12px rgba(0,0,0,0.05);
         background: #f8fafc;
      }
   </style>
</head>

<body class="nk-body npc-default pg-auth">
   <!-- Tela de Loading Inicial do PWA -->
   <div id="pwa-loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #f5f6fa; display: flex; flex-direction: column; justify-content: center; align-items: center; z-index: 999999; transition: opacity 0.3s ease;">
      <img src="<?= base_url() ?>images/logo_1.svg" alt="Softec" style="width: 120px; margin-bottom: 20px; animation: pulse 1.5s infinite;">
    
   </div>

   <script>
      window.addEventListener('load', function() {
         const loader = document.getElementById('pwa-loader');
         if (loader) {
            loader.style.opacity = '0';
            setTimeout(function() { loader.style.display = 'none'; }, 300);
         }
      });
   </script>

   <div class="nk-app-root">
      <div class="nk-main">
         <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content">
               <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                  <div class="brand-logo pb-3 text-center">
                     <div class="logo-link">
                        <img class="logo-light logo-img logo-img-lg" src="<?= base_url() ?>images/logo.png" alt="logo">
                        <img class="logo-dark logo-img logo-img-lg" src="<?= base_url() ?>images/logo.png" alt="logo-dark">
                     </div>
                     <div id="mensagem" class="mt-2"></div>
                  </div>

                  <!-- Banner de Instalação PWA -->
                  <div id="pwa-install-banner" class="pwa-banner d-none">
                     <div class="pwa-banner-content">
                        <div class="pwa-icon"><em class="icon ni ni-mobile"></em></div>
                        <div class="pwa-text">
                           <h4 id="pwa-title">Instale o aplicativo Softec</h4>
                           <p id="pwa-desc">Clique no botão ao lado para instalar o app no seu dispositivo.</p>
                        </div>
                        <div class="pwa-actions">
                           <button id="btn-install" class="pwa-btn-install">Instalar</button>
                           <div id="ios-instruction" class="ios-instruction d-none" style="font-size: 12px; color: #64748b; line-height: 1.3;">
                              Toque em <b>Compartilhar</b> e depois em <b>"Adicionar à Tela Inicial"</b>.
                           </div>
                           <button id="btn-close-banner" class="pwa-btn-close" title="Fechar">&times;</button>
                        </div>
                     </div>
                  </div>

                  <?php if (session()->getFlashdata('msg')): ?>
                  <div class="alert alert-fill alert-success alert-dismissible fade show shadow-sm mb-3" role="alert">
                     <?= session()->getFlashdata('msg') ?>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php endif; ?>

                  <div class="card-inner card-inner-lg">
                     <div class="nk-block-head">
                        <div class="nk-block-head-content">
                           <h4 class="nk-block-title">
                              <?php
                              date_default_timezone_set('America/Sao_Paulo');
                              $hora = date('H');
                              if ($hora >= 6 && $hora < 12) {
                                 $saudacao = 'Bom dia!';
                              } elseif ($hora >= 12 && $hora < 18) {
                                 $saudacao = 'Boa tarde!';
                              } else {
                                 $saudacao = 'Boa noite!';
                              }
                              echo "Olá, " . $saudacao;
                              ?>
                           </h4>
                           <div class="nk-block-des">
                              <p>Bem-vindo(a) ao sistema.</p>
                           </div>
                        </div>
                     </div>

                     <!-- TELA DE CONTAS SALVAS (ESTILO INSTAGRAM) -->
                     <div id="saved-accounts-section" class="mb-3" style="display: none;">
                        <div id="accounts-list" class="d-flex flex-column gap-3 mb-3">
                           <!-- Preenchido via JavaScript -->
                        </div>
                        <div class="pt-2" style="padding-top: 3.75rem !important;">
                           <button type="button" id="btn-add-another" class="btn btn-lg btn-dark btn-block" style="font-weight: 500;">
                              <em class="icon ni ni-user-add me-1"></em><span>Fazer login com outra conta</span>
                           </button>
                        </div>
                     </div>

                     <!-- FORMULÁRIO DE LOGIN NORMAL -->
                     <form id="loginForm">
                        <div class="form-group">
                           <div class="form-label-group"><label class="form-label" for="email">Email</label></div>
                           <div class="form-control-wrap">
                              <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="form-label-group">
                              <label class="form-label" for="senha">Senha</label>
                              <a class="link link-dark link-sm" href="auth-reset-v2.html">Esqueceu a senha?</a>
                           </div>
                           <div class="form-control-wrap">
                              <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="senha">
                                 <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                 <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                              </a>
                              <input type="password" class="form-control form-control-lg" name="senha" id="senha" placeholder="Senha">
                           </div>
                        </div>

                        <!-- Checkbox Salvar Conta (Lembrar de Mim) -->
                        <div class="form-group">
                           <div class="custom-control custom-control-sm custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="salvar_conta" name="salvar_conta" value="1" checked>
                              <label class="custom-control-label" for="salvar_conta">Salvar conta neste dispositivo</label>
                           </div>
                        </div>

                        <div class="form-group">
                           <button class="btn btn-lg btn-dark btn-block" id="btnEntrar">Entrar</button>
                        </div>
                     </form>

                     <div class="form-note-s2 text-center pt-4" id="register-note">
                        Não possui uma conta? <a class="link link-dark link-sm" href="cadastro" >Cadastre-se</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="<?= base_url() ?>assets/js/bundle9b70.js?ver=3.3.0"></script>
   <script src="<?= base_url() ?>assets/js/scripts9b70.js?ver=3.3.0"></script>
   
   <!-- SCRIPT DE GERENCIAMENTO DE CONTAS SALVAS (LocalStorage) -->
   <script>
   document.addEventListener("DOMContentLoaded", function() {
      const STORAGE_KEY = 'softec_saved_accounts';
      const savedSection = document.getElementById('saved-accounts-section');
      const accountsList = document.getElementById('accounts-list');
      const loginForm = document.getElementById('loginForm');
      const btnAddAnother = document.getElementById('btn-add-another');
      const registerNote = document.getElementById('register-note');

      function getSavedAccounts() {
         try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
         } catch(e) {
            return [];
         }
      }

      function renderAccounts() {
         const accounts = getSavedAccounts();
         if (accounts.length > 0) {
            accountsList.innerHTML = '';
            accounts.forEach(acc => {
               const card = document.createElement('div');
               card.className = 'saved-account-card p-3 shadow-sm d-flex align-items-center justify-content-between';
               card.innerHTML = `
                  <div class="d-flex align-items-center account-trigger" data-email="${acc.email}" data-token="${acc.remember_token}" style="cursor: pointer; flex-grow: 1; overflow: hidden;">
                     <div class="user-avatar bg-dark text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px; font-weight: 600; font-size: 18px;">
                        ${acc.nome.charAt(0).toUpperCase()}
                     </div>
                     <div class="ms-3" style="overflow: hidden;">
                        <h6 class="mb-1 text-dark fw-bold text-truncate" style="font-size: 14px; line-height: 1.2;">${acc.nome}</h6>
                        <span class="text-muted text-truncate d-block" style="font-size: 12px; line-height: 1.1;">${acc.email}</span>
                     </div>
                  </div>
                  <button class="btn btn-icon btn-sm btn-danger btn-dim ms-3 flex-shrink-0 remove-account" title="Remover conta" data-email="${acc.email}">
                     <em class="icon ni ni-trash"></em>
                  </button>
               `;

               // Ação ao clicar no card para fazer login rápido
               card.querySelector('.account-trigger').addEventListener('click', function() {
                  const email = this.getAttribute('data-email');
                  const token = this.getAttribute('data-token');
                  fazerLoginRapido(email, token);
               });

               // Ação para remover conta específica da lista salva
               card.querySelector('.remove-account').addEventListener('click', function(e) {
                  e.stopPropagation();
                  removerContaSalva(acc.email);
               });

               accountsList.appendChild(card);
            });

            // Mostra a tela de perfis salvos e oculta o formulário padrão inicialmente
            savedSection.style.display = 'block';
            loginForm.style.display = 'none';
            if (registerNote) registerNote.style.display = 'none';
         } else {
            savedSection.style.display = 'none';
            loginForm.style.display = 'block';
            if (registerNote) registerNote.style.display = 'block';
         }
      }

      window.salvarContaNoNavegador = function(userInfo) {
         if (!userInfo || !userInfo.remember_token) return;
         let accounts = getSavedAccounts();
         
         // Remove se já existir para atualizar os dados mais recentes
         accounts = accounts.filter(acc => acc.email !== userInfo.email);
         
         // Insere no topo
         accounts.unshift({
            nome: userInfo.nome,
            email: userInfo.email,
            remember_token: userInfo.remember_token
         });

         localStorage.setItem(STORAGE_KEY, JSON.stringify(accounts));
      };

      function removerContaSalva(email) {
         let accounts = getSavedAccounts();
         accounts = accounts.filter(acc => acc.email !== email);
         localStorage.setItem(STORAGE_KEY, JSON.stringify(accounts));
         renderAccounts();
      }

      // Botão "Fazer login com outra conta"
      if (btnAddAnother) {
         btnAddAnother.addEventListener('click', function() {
            savedSection.style.display = 'none';
            loginForm.style.display = 'block';
            if (registerNote) registerNote.style.display = 'block';
         });
      }

      // Executa a verificação ao carregar a página
      renderAccounts();

      // Função de Login Rápido ao clicar no card do perfil
      function fazerLoginRapido(email, remember_token) {
         $('#mensagem').html(`<div class="alert alert-fill alert-info">Entrando na conta de ${email}...</div>`);
         
         fetch('<?= base_url("auth/loginRapido") ?>', {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ email: email, remember_token: remember_token })
         })
         .then(res => res.json())
         .then(data => {
            if (data.success) {
               window.location.href = data.redirect;
            } else {
               alert(data.message);
               removerContaSalva(email);
               location.reload();
            }
         })
         .catch(() => {
            alert('Erro de conexão ao tentar login rápido.');
            location.reload();
         });
      }

      // AJAX de Login Tradicional com captura do Salvamento
      $('#btnEntrar').on('click', function(e) {
         e.preventDefault();

         const email = $('#email').val().trim();
         const senha = $('#senha').val().trim();
         $('#mensagem').empty();

         function emailValido(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
         }

         if (email === '' || senha === '') {
            $('#mensagem').html(`<div class="alert alert-fill alert-warning alert-dismissible fade show shadow-sm mb-0" role="alert">Por favor, preencha todos os campos.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
            return;
         }

         if (!emailValido(email)) {
            $('#mensagem').html(`<div class="alert alert-fill alert-warning alert-dismissible fade show shadow-sm mb-0" role="alert">Por favor, insira um e-mail válido.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
            return;
         }

         $.ajax({
            url: '<?= base_url('auth/autenticar') ?>',
            type: 'POST',
            data: $('#loginForm').serialize(),
            dataType: 'json',
            success: function(response) {
               $('#mensagem').empty();
               if (response.success) {
                  // Se retornou informações do usuário e o checkbox está marcado, salva no localStorage
                  if (response.usuario_info && $('#salvar_conta').is(':checked')) {
                     salvarContaNoNavegador(response.usuario_info);
                  }
                  window.location.href = response.redirect;
               } else {
                  $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">${response.message}<button class="close" data-bs-dismiss="alert"></button></div>`);
               }
            },
            error: function() {
               $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">Erro ao processar a requisição.<button class="close" data-bs-dismiss="alert"></button></div>`);
            }
         });
      });
   });
   </script>

   <!-- Service Worker e PWA scripts originais -->
   <script>
   if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
         navigator.serviceWorker.register('/sw.js').catch(err => console.log('SW error:', err));
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

   const isIOS = () => /iphone|ipad|ipod/.test(window.navigator.userAgent.toLowerCase());
   const isInStandaloneMode = () => (window.matchMedia('(display-mode: standalone)').matches) || (window.navigator.standalone === true);

   if (!isInStandaloneMode()) {
      if (isIOS()) {
         if (pwaDesc) pwaDesc.style.display = 'none';
         if (installBtn) installBtn.style.display = 'none';
         if (iosInstruction) iosInstruction.classList.remove('d-none');
         if (installBanner) installBanner.classList.remove('d-none');
      } else {
         window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            if (installBanner) installBanner.classList.remove('d-none');
         });
      }
   }

   if (installBtn) {
      installBtn.addEventListener('click', async () => {
         if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt = null;
            installBanner.classList.add('d-none');
         }
      });
   }
   if (closeBtn) {
      closeBtn.addEventListener('click', () => { installBanner.classList.add('d-none'); });
   }
   window.addEventListener('appinstalled', () => { installBanner.classList.add('d-none'); });
   </script>
</body>
</html>