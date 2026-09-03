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
   html,
   body {
      touch-action: pan-x pan-y;
      overscroll-behavior-y: none;
      -webkit-user-select: none;
      user-select: none;
      -webkit-tap-highlight-color: transparent;
   }

   /* Estilo das caixinhas individuais para o OTP */
   .otp-inputs-container {
      display: flex;
      justify-content: space-between;
      gap: 8px;
      margin: 15px 0 10px 0;
   }

   .otp-box {
      width: 45px;
      height: 55px;
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      border: 1px solid #ced4da; /* Borda fina e cor padrão do Dashlite */
      border-radius: 8px;        /* Mantém os cantos arredondados */
      background-color: #fff;
      transition: all 0.2s ease;
   }

   .otp-box:focus {
      border-color: #1f2b3a;
      box-shadow: 0 0 0 3px rgba(31, 43, 58, 0.15);
      outline: none;
   }

   /* Estilo para erro nas caixinhas */
   .otp-box.is-invalid {
      border-color: #e85347 !important;
      background-color: #fff5f5;
   }

   /* Animação de erro (tremor) */
   @keyframes shake {
      0% { transform: translateX(0); }
      20% { transform: translateX(-6px); }
      40% { transform: translateX(6px); }
      60% { transform: translateX(-6px); }
      80% { transform: translateX(6px); }
      100% { transform: translateX(0); }
   }

   .shake {
      animation: shake 0.4s ease-in-out;
   }
   </style>
</head>

<body class="nk-body npc-default pg-auth">
   <div class="nk-app-root">
      <div class="nk-main">
         <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content">

               <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                  <div class="brand-logo pb-3 text-center" id="card-logo">
                     <div class="logo-link">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="80mm" height="14.3932mm"
                            version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 8364.88 1439.32" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:xodm="http://www.corel.com/coreldraw/odm/2003">
                           <defs>
                              <style type="text/css">
                              <![CDATA[
                              .fil0 {
                                 fill: #1f2b3a
                              }
                              ]]>
                              </style>
                           </defs>
                           <g id="Camada_x0020_1">
                              <metadata id="CorelCorpID_0Corel-Layer" />
                              <g id="_2068353902336">
                                 <path class="fil0"
                                    d="M723.45 572.84c0,-39.59 83.6,-108.75 113.88,-129.5 28.5,19.53 91.17,91.62 124.82,124.77 18.22,17.94 29.76,22.44 47.8,41.72l70.99 95.69c44.9,90.4 46.74,186.52 -3.44,274.96 -42.49,74.87 -204.07,239.3 -252.83,265.7 -27.17,-18.62 -107.55,-95.51 -107.55,-129.49 0,-55.56 196.13,-185.5 196.13,-265.45 0,-136.5 -189.8,-199.88 -189.8,-278.4zm-145.51 401.41c-16.58,-4.53 -106.33,-94.27 -131.35,-118.08 -70.14,-66.77 -158.59,-167.53 -152.63,-276.02 6.21,-112.89 93.1,-196.62 159.02,-264.69l47.25 -42.28c14.73,-13.63 21.39,-28.18 38.07,-45.21 16.14,-16.46 28.06,-31.33 45.97,-43.61 22.06,15.12 101.22,92.12 101.22,123.02 0,37.72 -34.74,64.73 -55.35,85.79 -74.74,76.35 -192.72,151.85 -106.66,267.77 90.23,121.55 213.78,148.89 128.92,240.6 -21.08,22.78 -50.92,56.58 -74.46,72.71zm506.13 -932.32l-158.2 -0.03c-94.1,5.2 -18.21,10.1 -133.16,0.36l-448.85 -0.33c-212.49,0 -285.31,68.99 -291.23,271.71 -1.59,54.41 6.25,91.33 6.79,135.92l-0.52 719.19c1.39,143.03 99.93,203.33 221.67,206.93 41.65,1.24 80.81,11.4 131.96,5.52 180.83,-20.8 725.76,20.84 825.48,-22.8 159.53,-69.81 117.91,-287.31 118.1,-442.42 0.09,-76.68 5.51,-669.95 -4.67,-713.89 -8.65,-37.31 -25.12,-71.38 -47.31,-94.02 -58.08,-59.27 -136.66,-66.14 -220.06,-66.14z" />
                                 <path class="fil0"
                                    d="M2469.58 883.61c0,63.95 -62.09,84.17 -120.2,84.17l-316.55 0.22c-42.65,-0.06 -70.4,-6.76 -119.98,-6.71 -48.42,0.05 -80.4,6.25 -120.23,6.47 -71.49,0.39 -75.9,16.63 -75.9,71.24 0,92.24 30.27,83.92 145.73,83.95 36.61,0 43.07,5.91 75.5,6.9l453.04 -9.42c67.7,-10.43 77.52,4.84 131.47,-27.32 123.87,-73.85 147.95,-299.06 24.65,-411.85 -57.42,-52.52 -124.92,-50.16 -229.37,-50.16 -90.67,0.01 -181.36,0 -272.03,0 -70.98,0 -141.45,16.98 -176.8,-32.72 -30.96,-43.54 -21.82,-91.73 13.7,-121.23 41.52,-34.5 218.04,-20.86 295.95,-20.86l366.98 0.03c28.23,-1.52 23.09,-5.88 50.58,-6.5 11.04,-186.04 24.61,-145.32 -88.78,-148.7 -37.44,-1.12 -66.87,-6.69 -113.68,-6.69 -69.76,0 -114.9,6.83 -183.68,6.7 -39.12,-0.08 -49.04,-6.86 -88.14,-6.92 -77.51,-0.11 -241.44,-2.66 -300.66,22.96 -168.65,72.96 -157.66,336.09 -48.62,425.13 80.64,65.84 226.13,50.67 368.04,50.67 53.65,0 257.16,-11.82 295.12,15.22 21.23,15.12 33.86,41.23 33.86,75.42z" />
                                 <path class="fil0"
                                    d="M3684.28 831.81c0,93.09 -29.15,130.04 -107.31,129.74 -81.96,-0.32 -146.27,6.24 -221.66,6.24 -37.89,0 -291.77,-2.69 -322.83,-19.26 -20.49,-10.93 -37.79,-51.64 -37.79,-84.35l0 -310.77c0,-81.82 52.97,-91.3 132.85,-90.65 44.12,0.36 65.51,-5.59 101.03,-6.68 114.15,-3.5 241.51,6.84 348.4,6.45 82.07,-0.31 107.31,32.39 107.31,142.68 0,73.13 -6.19,75.76 -6.78,110.11l6.78 116.49zm-847.75 -271.93l0 310.78c0,308.46 251.75,253.8 506.16,252.46 46.35,-0.24 65.91,6.66 107.3,6.74l206.59 -9.15c146.92,-24.34 180.4,-118.39 179.51,-263.04 -0.29,-45.46 6.15,-64.58 6.61,-103.29 3.44,-285.22 19.56,-498.35 -361.79,-454.42 -35.85,4.13 -76.28,-0.15 -102.03,-3.76 -72.5,-10.17 -248.62,4.93 -320.99,4.63 -162.38,-0.66 -221.36,105.34 -221.36,259.05z" />
                                 <path class="fil0"
                                    d="M7834.51 1129.64l411.23 0c76.86,0 63.27,-48.99 63.27,-129.49 0,-34.8 -48.19,-34.96 -76.8,-37.95l-568.67 -0.74c-84,0.58 -107.39,-15.41 -107.39,-129.65 0,-428.73 -57.37,-369.05 347.96,-369.05 67.91,0 279.22,3.14 337.3,-4.42 75.05,-9.77 67.6,-3.71 67.6,-112.11 0,-24.79 -7.18,-41.1 -28.73,-48.3 -27.42,-9.17 -514.1,-3.5 -584.95,-3.5 -357.87,0 -297.34,213.24 -297.34,479.11 0,200.29 -3.23,343.14 246.53,349.83 68.45,1.83 118.21,6.27 189.99,6.27z" />
                                 <path class="fil0"
                                    d="M5158.38 300.9c0,197.52 -12.11,147 67.81,157.21 65.28,8.35 250.54,4.65 324.43,4.65 0,32.83 6.33,35.28 6.33,71.23 0,170.3 2.88,318.22 -6.37,485.56 -6.47,117.15 8.62,103.61 120.25,103.61 29.53,0 44.29,-15.09 44.29,-45.32l0 -615.08c64.32,0 318.51,5.39 366.64,-6.77 42.18,-10.67 31.93,-51.83 31.93,-116.24 0,-30.23 -14.76,-45.32 -44.29,-45.32l-765.52 0c-57.52,0 -89.04,6.47 -145.5,6.47z" />
                                 <path class="fil0"
                                    d="M4044.9 890.08c0,174.2 -29.5,270.53 117.97,230.8 24.49,-6.59 28.28,-11.31 35.35,-35.04 21.08,-70.63 -18.38,-224.51 23.96,-266.84 29.8,-29.8 62.6,-26.12 120.07,-26.03l430.29 0.08c105.31,0.78 94.82,-19.9 94.82,-110.15 0,-23.66 -17.46,-51.8 -37.96,-51.8l-556.74 0c-158.71,0 -227.76,104.37 -227.76,258.98z" />
                                 <path class="fil0"
                                    d="M6309.81 1006.63c0,96.23 -17.17,123.01 88.57,123.01 148.34,0 688.95,12.84 797.15,-12.95 3.06,-37.58 21.96,-134.18 -17.25,-150.69 -26.16,-11.01 -734.19,-4.7 -824.18,-4.7 -29.54,0 -44.29,15.1 -44.29,45.33z" />
                                 <path class="fil0"
                                    d="M6309.81 339.75c0,96.23 -17.17,123.01 88.57,123.01 98.19,0 731,7.63 776.74,-7.93 38.51,-13.11 28.92,-103.14 20.25,-134.34 -3.8,-13.67 -1.94,-26.06 -50.45,-26.06l-790.82 0c-29.54,0 -44.29,15.09 -44.29,45.32z" />
                                 <path class="fil0"
                                    d="M4051.23 307.38c-9.84,43.23 -25.59,148.91 37.96,148.91l835.11 0c37.45,0 25.3,-61.88 25.3,-129.49 0,-15.15 -10.5,-25.9 -25.3,-25.9 -103.7,0 -834.98,-8.65 -873.07,6.48z" />
                                 <path class="fil0"
                                    d="M6309.81 669.95c0,56.42 -4.43,69.29 6.33,116.54 67.9,16.19 636.25,6.48 752.86,6.48 67.82,0 42.35,-101.45 37.96,-155.39 -68.16,-16.25 -653.42,-6.48 -771.84,-6.48 -19.45,0 -25.31,18.97 -25.31,38.85z" />
                              </g>
                           </g>
                        </svg>
                        <div class="nk-block-des" style="font: menu;">
                            O SOFTWARE DA SUA ASSISTÊNCIA TÉCNICA
                        </div>
                     </div>
                     <div id="mensagem" class="mt-2"></div>
                  </div> 
                  <div class="card-inner card-inner-lg">
                     <div class="nk-block-head">
                        <div class="nk-block-head-content">
                           <h4 class="nk-block-title" id="titulo-etapa">Redefinir senha de acesso</h4>
                        </div>
                     </div>

                     <!-- PASSO 1: Informar E-mail -->
                     <form id="formEmail">
                        <div class="form-group">
                           <div class="form-label-group"><label class="form-label" for="email">Informe o email
                              cadastrado</label></div>
                           <div class="form-control-wrap">
                              <input type="email" class="form-control form-control-lg" id="email" name="email"
                                 placeholder="Seu e-mail cadastrado">
                           </div>
                        </div>
                        <div class="form-group">
                           <button type="button" class="btn btn-lg btn-dark btn-block"
                              id="btnEnviarOtp">Avançar</button>
                        </div>
                     </form>

                     <!-- PASSO 2: Inserir Código OTP em Caixinhas (Oculto inicialmente) -->
                     <form id="formOtp" style="display: none;">
                        <input type="hidden" id="emailOculto" name="email">
                        
                        <div class="form-group text-center mb-2">
                           <div class="form-label-group justify-content-center">
                              <label class="form-label" style="font-size: 15px; font-weight: 600;">Digite o código de verificação</label>
                           </div>
                           <span class="text-muted small">O código de verificação foi enviado para</span><br>
                           <strong id="whatsappDestino" class="text-dark"></strong>
                        </div>

                        <!-- Caixinhas Separadas (6 dígitos) -->
                        <div class="form-group mb-1">
                           <div class="otp-inputs-container" id="otpContainer">
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" autocomplete="one-time-code" />
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
                              <input type="text" class="otp-box" maxlength="1" pattern="[0-9]*" inputmode="numeric" />
                           </div>
                           <!-- Input real oculto que armazena os 6 dígitos para o AJAX -->
                           <input type="hidden" id="otp" name="otp">

                           <!-- Label exclusiva para exibir mensagem de código errado -->
                           <div class="text-center mb-2">
                              <span id="labelErroOtp" class="text-danger small fw-bold" style="display: none;"></span>
                           </div>

                           <div class="text-center mt-2 text-muted small">
                              <span id="textoTimer">Não recebeu ainda? Reenviar após <span id="timer" class="fw-bold text-danger">05:00</span></span>
                              <button type="button" id="btnReenviarOtp" class="btn btn-sm btn-outline-dark mt-1" style="display: none;">Reenviar código</button>
                           </div>
                        </div> 
                     </form>

                     <!-- PASSO 3: Nova Senha (Oculto inicialmente) -->
                     <form id="formNovaSenha" style="display: none;">
                        <input type="hidden" id="emailSenha" name="email">
                        <input type="hidden" id="otpSenha" name="otp">

                        <div class="form-group">
                           <div class="form-label-group"><label class="form-label" for="senha">Nova senha</label></div>
                           <div class="form-control-wrap">
                              <input type="password" class="form-control form-control-lg" id="senha" name="senha"
                                 placeholder="Nova senha">
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="form-label-group"><label class="form-label" for="confirma_senha">Confirme a nova
                                 senha</label></div>
                           <div class="form-control-wrap">
                              <input type="password" class="form-control form-control-lg" id="confirma_senha"
                                 name="confirma_senha" placeholder="Repita a nova senha">
                           </div>
                           <!-- Label de validação em tempo real para as senhas -->
                           <div class="mt-1">
                              <span id="labelErroSenha" class="text-danger small fw-bold" style="display: none;">As senhas não coincidem.</span>
                           </div>
                        </div>

                        <div class="form-group mt-3">
                           <button type="button" class="btn btn-lg btn-dark btn-block" id="btnSalvarSenha">Redefinir senha</button>
                        </div>
                     </form>

                     <div class="form-note-s2 text-center pt-4">
                        Lembrou a senha? <a class="link link-dark link-sm"
                           href="<?= base_url('auth/login') ?>">Entrar</a>
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
document.addEventListener("DOMContentLoaded", function() {
    let countdownInterval;

    function iniciarTimer(duracaoEmSegundos) {
        let timer = duracaoEmSegundos, minutos, segundos;
        clearInterval(countdownInterval);
        
        // Garante que o texto do timer aparece e o botão de reenvio some ao reiniciar
        $('#textoTimer').show();
        $('#btnReenviarOtp').hide();
        $('.otp-box').prop('disabled', false);

        countdownInterval = setInterval(function () {
            minutos = parseInt(timer / 60, 10);
            segundos = parseInt(timer % 60, 10);

            minutos = minutos < 10 ? "0" + minutos : minutos;
            segundos = segundos < 10 ? "0" + segundos : segundos;

            $('#timer').text(minutos + ":" + segundos);

            if (--timer < 0) {
                clearInterval(countdownInterval);
                $('#textoTimer').hide();
                $('#btnReenviarOtp').fadeIn(); // Exibe o botão de reenviar
                $('.otp-box').prop('disabled', true);
            }
        }, 1000);
    }

    const $otpBoxes = $('.otp-box');
    
    // Ao digitar, limpa o aviso de erro anterior e remove borda vermelha
    $otpBoxes.on('input', function() {
        const $this = $(this);
        const val = $this.val();
        
        if (!/^[0-9]$/.test(val)) {
            $this.val('');
            return;
        }

        $('#labelErroOtp').fadeOut();
        $otpBoxes.removeClass('is-invalid');

        const $next = $this.next('.otp-box');
        if ($next.length && val) {
            $next.focus();
        }

        juntarEEnviarOtp();
    });

    $otpBoxes.on('keydown', function(e) {
        const $this = $(this);
        if (e.key === 'Backspace') {
            $('#labelErroOtp').fadeOut();
            $otpBoxes.removeClass('is-invalid');

            if ($this.val() === '') {
                const $prev = $this.prev('.otp-box');
                if ($prev.length) {
                    $prev.focus().val('');
                }
            } else {
                $this.val('');
            }
            e.preventDefault();
            juntarEEnviarOtp();
        }
    });

    $otpBoxes.on('paste', function(e) {
        e.preventDefault();
        const pasteData = e.originalEvent.clipboardData.getData('text').trim();
        if (/^\d{6}$/.test(pasteData)) {
            $otpBoxes.each(function(index) {
                $(this).val(pasteData[index]);
            });
            $otpBoxes.last().focus();
            juntarEEnviarOtp();
        }
    });

    function juntarEEnviarOtp() {
        let otpCompleto = '';
        $otpBoxes.each(function() {
            otpCompleto += $(this).val();
        });
        $('#otp').val(otpCompleto);

        if (otpCompleto.length === 6) {
            validarCodigoOtp(otpCompleto);
        }
    }

    // PASSO 1 e REENVIO: Enviar E-mail e gerar OTP
    $('#btnEnviarOtp, #btnReenviarOtp').on('click', function(e) {
        e.preventDefault();
        $('#mensagem').empty();

        const email = $('#emailOculto').val().trim() || $('#email').val().trim();

        if (email === '') {
            $('#mensagem').html(`<div class="alert alert-fill alert-warning alert-dismissible fade show shadow-sm mb-0" role="alert">Por favor, informe o e-mail.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
            return;
        }

        $.ajax({
            url: '<?= base_url('auth/enviarOtp') ?>',
            type: 'POST',
            data: { email: email },
            dataType: 'json',
            success: function(response) {
                $('#mensagem').empty();
                if (response.success) {
                    $('#emailOculto').val(email);
                    $('#emailSenha').val(email);
                    
                    $('#whatsappDestino').text(response.whatsapp);
                    
                    $('#formEmail').hide();
                    $('#card-logo').hide();
                    $('#formOtp').fadeIn();
                    $('#titulo-etapa').text('');
                    
                    // Limpa caixas caso venha do reenvio
                    $otpBoxes.val('').removeClass('is-invalid');
                    $('#otp').val('');

                    iniciarTimer(5 * 60);
                    $otpBoxes.first().focus();
                } else {
                    $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">${response.message}<button class="close" data-bs-dismiss="alert"></button></div>`);
                }
            },
            error: function() {
                $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">Erro ao processar a requisição.<button class="close" data-bs-dismiss="alert"></button></div>`);
            }
        });
    });

    // PASSO 2: Validação Automática via AJAX com exibição na Label de Erro
    function validarCodigoOtp(otp) {
        const email = $('#emailOculto').val().trim();
        $('#labelErroOtp').hide();

        $.ajax({
            url: '<?= base_url('auth/validarOtp') ?>',
            type: 'POST',
            data: { email: email, otp: otp },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#otpSenha').val(otp);
                    clearInterval(countdownInterval);

                    $('#formOtp').hide();
                    $('#formNovaSenha').fadeIn();
                    $('#titulo-etapa').text('Cadastre uma nova senha');
                    $('#mensagem').empty();
                } else {
                    $('#labelErroOtp').text(response.message || 'Código incorreto. Tente novamente.').fadeIn();
                    $otpBoxes.addClass('is-invalid');
                    $('#otpContainer').addClass('shake');
                    
                    setTimeout(() => {
                        $('#otpContainer').removeClass('shake');
                    }, 400);

                    $otpBoxes.val('');
                    $('#otp').val('');
                    $otpBoxes.first().focus();
                }
            },
            error: function() {
                $('#labelErroOtp').text('Erro ao validar o código. Tente novamente.').fadeIn();
                $otpBoxes.addClass('is-invalid');
                $otpBoxes.val('');
                $('#otp').val('');
                $otpBoxes.first().focus();
            }
        });
    }

    // Validação em tempo real se as senhas coincidem ao digitar
    $('#senha, #confirma_senha').on('input', function() {
        const senha = $('#senha').val();
        const confirma = $('#confirma_senha').val();

        if (confirma !== '' && senha !== confirma) {
            $('#labelErroSenha').fadeIn();
            $('#confirma_senha').addClass('is-invalid');
        } else {
            $('#labelErroSenha').fadeOut();
            $('#confirma_senha').removeClass('is-invalid');
        }
    });

    // PASSO 3: Salvar Nova Senha
    $('#btnSalvarSenha').on('click', function(e) {
        e.preventDefault();
        $('#mensagem').empty();

        const email = $('#emailSenha').val().trim();
        const otp = $('#otpSenha').val().trim();
        const senha = $('#senha').val().trim();
        const confirmaSenha = $('#confirma_senha').val().trim();

        if (senha === '' || confirmaSenha === '') {
            $('#mensagem').html(`<div class="alert alert-fill alert-warning alert-dismissible fade show shadow-sm mb-0" role="alert">Por favor, preencha todos os campos de senha.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
            return;
        }

        if (senha !== confirmaSenha) {
            $('#labelErroSenha').fadeIn();
            $('#confirma_senha').addClass('is-invalid');
            return;
        }

        $.ajax({
            url: '<?= base_url('auth/atualizarSenha') ?>',
            type: 'POST',
            data: { 
                email: email, 
                otp: otp, 
                senha: senha, 
                confirma_senha: confirmaSenha 
            },
            dataType: 'json',
            success: function(response) {
                $('#mensagem').empty();
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">${response.message}<button class="close" data-bs-dismiss="alert"></button></div>`);
                }
            },
            error: function() {
                $('#mensagem').html(`<div class="alert alert-fill alert-danger alert-dismissible alert-icon">Erro ao atualizar a senha.<button class="close" data-bs-dismiss="alert"></button></div>`);
            }
        });
    });
});
</script>
</body>
</html>