<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Configurações do sistema</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Allow Payments</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item"><a href="#">Corrida</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item active">Configurações</li>
                    </ol>
                </div>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab"
                                aria-selected="true">Corrida de faturamento</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#vendedores" role="tab" aria-selected="false"
                                tabindex="-1">Vendedores ( fake )</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#usuarios" role="tab" aria-selected="false"
                                tabindex="-1">Usuários do sistema</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#senha" role="tab" aria-selected="false"
                                tabindex="-1">Minha conta</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane p-3 active show" id="home" role="tabpanel"
                            style="padding: 5px !important;">

 <div class="row">
    <div class="col-md-6 col-lg-6">
        <!-- Data da corrida -->
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title" style="font-size: 13px; font-weight: 400;">Data da corrida</h4>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <form id="form-validation-2" class="form">
                <div style="display:flex;">
                    <div class="mb-2 col-md-6 col-lg-6">
                        <label class="form-label">Início</label>
                        <input class="form-control" type="text" name="inicio_corrida"
                            value="<?= esc($config['inicio_corrida'] ?? '') ?>">
                    </div>
                    <div class="mb-2 col-md-6 col-lg-6" style="margin-left: 5px;">
                        <label class="form-label">Término</label>
                        <input class="form-control" type="text" name="termino_corrida"
                            value="<?= esc($config['termino_corrida'] ?? '') ?>">
                    </div>
                </div>
        </div>

        <!-- Informações de contato -->
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title" style="font-size: 13px; font-weight: 400;">Informações de contato</h4>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div style="display:flex;">
                <div class="mb-2 col-md-6 col-lg-6">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" name="email"
                        value="<?= esc($config['email'] ?? '') ?>">
                </div>
                <div class="mb-2 col-md-6 col-lg-6" style="margin-left: 5px;">
                    <label class="form-label">Instagram</label>
                    <input class="form-control" type="text" name="instagram"
                        value="<?= esc($config['instagram'] ?? '') ?>">
                </div>
            </div>
            <div class="mb-2 col-md-6 col-lg-6">
                <label class="form-label">WhatsApp</label>
                <input class="form-control" type="text" name="whatsapp"
                    value="<?= esc($config['whatsapp'] ?? '') ?>">
            </div>
        </div>
    </div>

    <!-- Página da corrida -->
    <div class="col-lg-6">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title" style="font-size: 13px; font-weight: 400;">Página da corrida</h4>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label text-end">Status da página</label>
            <div class="col-sm-10">
                <select name="status" class="form-select">
                    <option value="Em manutenção" <?php if (($config['status'] ?? '') === 'Em manutenção') echo 'selected'; ?>>Em manutenção</option>
                    <option value="Ativa" <?php if (($config['status'] ?? '') === 'Ativa') echo 'selected'; ?>>Ativa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label text-end">URL Botão Gateway</label>
            <div class="col-sm-10">
                <input class="form-control" type="url" name="botao_gateway"
                    value="<?= esc($config['botao_gateway'] ?? '') ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label text-end">URL Botão Plataforma</label>
            <div class="col-sm-10">
                <input class="form-control" type="url" name="botao_plataforma"
                    value="<?= esc($config['botao_plataforma'] ?? '') ?>">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="settings_corrida">Salvar configurações</button>
    </form>
</div>

<!-- Script AJAX puro -->
<script>
document.getElementById('form-validation-2').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);

    fetch('<?= base_url("Settings/saveSettings") ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                text: data.message || 'Não foi possível salvar.',
                confirmButtonText: 'Fechar'
            });
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        Swal.fire({
            icon: 'error',
            text: 'Erro ao enviar o formulário.',
            confirmButtonText: 'Fechar'
        });
    });
});
</script> 
                        </div>
                        <div class="tab-pane p-3" id="vendedores" role="tabpanel" style="padding: 5px !important;">
                           <div style="padding: 10px !important; margin-top: 20px; border: 1px solid #ff00002e; border-radius: 5px; background-color: #ff000014; color: red;">
                            Você não tem permissões para gerenciar os vendedores fakes.
                           </div>
                        </div>
                        <div class="tab-pane p-3" id="usuarios" role="tabpanel" style="padding: 5px !important;">
                           <div style="padding: 10px !important; margin-top: 20px; border: 1px solid #ff00002e; border-radius: 5px; background-color: #ff000014; color: red;">
                            Você não tem permissões para gerenciar novos usuários para o sistema.
                           </div>
                        </div>
                        <div class="tab-pane p-3" id="senha" role="tabpanel" style="padding: 5px !important;">
                           <div style="padding: 10px !important; margin-top: 20px; border: 1px solid #ff00002e; border-radius: 5px; background-color: #ff000014; color: red;">
                            Você não tem permissões acessar essa aba.
                           </div>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
    </div>



 
</div><!-- container -->
<?= $this->endSection() ?>