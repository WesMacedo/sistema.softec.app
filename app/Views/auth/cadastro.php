<!DOCTYPE html>
<html lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gestão para loja de celulares e iformática.">
    <link rel="shortcut icon" href="<?= base_url() ?>images/favicon.png">
    <title>Softec</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dashlite9b70.css?ver=3.3.0">
    <link id="skin-default" rel="stylesheet" href="<?= base_url() ?>assets/css/theme9b70.css?ver=3.3.0">
</head>

<body class="nk-body npc-default pg-auth">
    <div class="nk-app-root">
	<div class="nk-main ">
		<div class="nk-wrap nk-wrap-nosidebar">
			<div class="nk-content ">
				<div class="nk-block nk-block-middle nk-auth-body  wide-xs">
					<div class="brand-logo text-center">
						<a href="<?= base_url() ?>index.html" class="logo-link">
							<img class="logo-light logo-img logo-img-lg" src="<?= base_url() ?>images/logo.png"
							srcset="/demo3/images/logo2x.png 2x" alt="logo">
							<img class="logo-dark logo-img logo-img-lg" src="<?= base_url() ?>images/logo-dark.png"
							srcset="/demo3/images/logo-dark2x.png 2x" alt="logo-dark">
						</a>
						<div id="mensagem" class="mt-3">
						</div>
					</div>
					<div class=" ">
						<div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">TESTE GRÁTIS POR 7 DIAS</h4>
                                        <div class="nk-block-des">
                                            <p>Cadastre-se para iniciar seu teste grátis.</p>
                                        </div>
                                    </div>
                                </div> 
							<form id="cadForm"> 
    <!-- Nome da Empresa -->
    <div class="form-group"> 
        <div class="form-label-group">
            <label class="form-label" for="nome_empresa">Nome da empresa</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" class="form-control form-control-lg" id="nome_empresa" name="nome_empresa" placeholder="Informe o nome da empresa">
        </div>
    </div>

    <!-- Nome do Responsável -->
    <div class="form-group"> 
        <div class="form-label-group">
            <label class="form-label" for="nome">Nome do responsável</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" class="form-control form-control-lg" id="nome" name="nome" placeholder="Nome e sobrenome">
        </div>
    </div> 

    <!-- E-mail -->
    <div class="form-group"> 
        <div class="form-label-group">
            <label class="form-label" for="email">E-mail</label>
        </div>
        <div class="form-control-wrap">
            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Informe seu e-mail">
        </div>
    </div>

    <!-- WhatsApp -->
    <div class="form-group"> 
        <div class="form-label-group">
            <label class="form-label" for="whatsapp">WhatsApp</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" class="form-control form-control-lg" id="whatsapp" name="whatsapp" placeholder="Número do WhatsApp">
        </div>
    </div>

    <!-- Senha de Acesso -->
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="senha">Senha de acesso</label> 
        </div>
        <div class="form-control-wrap">
            <input type="password" class="form-control form-control-lg" name="senha" id="senha" placeholder="Senha">
        </div>
    </div>

    <!-- Confirmar Senha -->
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="confirma_senha">Confirmar senha</label> 
        </div>
        <div class="form-control-wrap">
            <input type="password" class="form-control form-control-lg" name="confirma_senha" id="confirma_senha" placeholder="Repita a senha">
            <small id="feedback-senha" class="form-text mt-1 d-block" style="font-size: 0.85rem;"></small>
        </div>
    </div>

    <!-- Container de Mensagens gerais -->
    <div id="mensagem" class="mt-2 mb-2"></div>

    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" id="btnEntrar">
            Cadastrar
        </button>
    </div>
</form>
							<div class="form-note-s2 text-center pt-4">
								<a href="login">
									Já tenho uma conta
								</a>
							</div>
						</div>
					</div>
				</div>
				 
			</div>
		</div>
	</div>
</div>


    <script src="<?= base_url() ?>assets/js/bundle9b70.js?ver=3.3.0"></script>
    <script src="<?= base_url() ?>assets/js/scripts9b70.js?ver=3.3.0"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
$(document).ready(function () {

    // --- 1. Máscara Dinâmica do WhatsApp ---
    const maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    };

    const options = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    };

    $('#whatsapp').mask(maskBehavior, options);


    // --- 2. Validação de Senhas em Tempo Real ---
    $('#senha, #confirma_senha').on('keyup input', function () {
        const senha = $('#senha').val();
        const confirmaSenha = $('#confirma_senha').val();
        const $feedback = $('#feedback-senha');

        if (confirmaSenha.length === 0) {
            $feedback.text('').removeClass('text-success text-danger');
            $('#confirma_senha').removeClass('is-valid is-invalid');
            return;
        }

        if (senha === confirmaSenha) {
            $feedback.text('As senhas coincidem.').addClass('text-success').removeClass('text-danger');
            $('#confirma_senha').addClass('is-valid').removeClass('is-invalid');
        } else {
            $feedback.text('As senhas não coincidem.').addClass('text-danger').removeClass('text-success');
            $('#confirma_senha').addClass('is-invalid').removeClass('is-valid');
        }
    });


    // --- 3. Submissão do Formulário ---
    $('#btnEntrar').on('click', function (e) {
        e.preventDefault();

        const $btn = $(this);
        const nomeEmpresa = $('#nome_empresa').val()?.trim() || '';
        const nome = $('#nome').val()?.trim() || '';
        const email = $('#email').val()?.trim() || '';
        const whatsapp = $('#whatsapp').val()?.trim() || '';
        const senha = $('#senha').val()?.trim() || '';
        const confirmaSenha = $('#confirma_senha').val()?.trim() || '';

        $('#mensagem').empty();

        // Validação A: Campos vazios
        if (!nomeEmpresa || !nome || !email || !whatsapp || !senha || !confirmaSenha) {
            exibirAlerta('Por favor, preencha todos os campos do formulário.', 'warning');
            return;
        }

        // Validação B: Formato do e-mail
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email)) {
            exibirAlerta('Por favor, insira um e-mail válido.', 'warning');
            return;
        }

        // Validação C: Quantidade de dígitos do WhatsApp
        const whatsappNumeros = whatsapp.replace(/\D/g, '');
        if (whatsappNumeros.length < 10 || whatsappNumeros.length > 11) {
            exibirAlerta('Por favor, insira um número de WhatsApp válido com DDD.', 'warning');
            return;
        }

        // Validação D: Igualdade de senhas
        if (senha !== confirmaSenha) {
            exibirAlerta('As senhas informadas não coincidem.', 'warning');
            return;
        }

        // Bloqueia o botão enquanto aguarda resposta do servidor
        $btn.prop('disabled', true).text('Cadastrando...');

        // Envio dos dados via AJAX
        $.ajax({
            url: '<?= base_url('auth/registrar') ?>',
            type: 'POST',
            data: $('#cadForm').serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Redireciona passando a mensagem codificada na URL para a tela de login exibir
                    window.location.href = response.redirect + '?sucesso=' + encodeURIComponent(response.message);
                } else {
                    exibirAlerta(response.message || 'Erro ao realizar o cadastro.', 'danger');
                    $btn.prop('disabled', false).text('Cadastrar');
                }
            },
            error: function () {
                exibirAlerta('Erro de conexão ao processar a requisição.', 'danger');
                $btn.prop('disabled', false).text('Cadastrar');
            }
        });
    });

    // --- 4. Função auxiliar de mensagens de alerta ---
    function exibirAlerta(texto, tipo) {
        const classeTipo = tipo === 'warning' ? 'alert-warning' : 'alert-danger';
        const alertaHTML = `
            <div class="alert alert-fill ${classeTipo} alert-dismissible fade show shadow-sm mb-0" role="alert">
                ${texto}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        $('#mensagem').html(alertaHTML);
    }
});
</script>

</html>