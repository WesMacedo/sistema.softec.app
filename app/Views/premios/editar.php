<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<link href="assets/libs/simple-datatables/style.css" rel="stylesheet" type="text/css" />
<!-- App css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <h4 class="page-title">Editar prêmio</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Allow Payments</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item"><a href="#">Corrida</a>
                        </li><!--end nav-item-->
                        <li class="breadcrumb-item active">Editar prêmio</li>
                    </ol>
                </div>
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">
        <div class="col-12">

            <div class="card-header">

            </div><!--end card-header-->

 <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-6">
                           <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">                      
                                            <h4 class="card-title" style="color:#6d01ef;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16" data-darkreader-inline-fill="" style="--darkreader-inline-fill: currentColor;">
                            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z">
                            </path>
                        </svg> <?= esc($premio['id']) ?>° lugar: </h4>                      
                                        </div><!--end col-->
                                    </div>  <!--end row-->                                  
                                </div><!--end card-header-->
                                <div class="card-body pt-0">
                                   <form id="editar" class="form" action="<?= base_url('premios/atualizar') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= esc($premio['id']) ?>">

    <div class="mb-2">
        <label class="form-label">Descrição do prêmio:</label>
        <input class="form-control" type="text" name="descricao" id="descricao" value="<?= esc($premio['descricao']) ?>" required>
    </div>

    <div class="mb-3" style="display: grid;">
        <label class="form-label" style="text-align:center;">Clique na imagem para alterar</label><br>
        <input type="file" id="imgInput" name="img" accept="image/*" style="display:none;">
        <img src="<?= esc($premio['img']) ?>" id="previewImg" class="thumb-md align-self-center rounded" alt="Foto" style="display:inline;width:100%;height:160px;object-fit:contain;cursor:pointer;">
    </div>

    <button type="submit" class="btn btn-primary w-100">Salvar</button>
</form>            
                                </div> 
                            </div>
                        </div> <!--end col-->                                   
                    </div>

        </div> <!-- end row -->
    </div><!-- container -->

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/datatable.init.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
    const imgInput = document.getElementById('imgInput');
    const previewImg = document.getElementById('previewImg');

    previewImg.addEventListener('click', () => {
        imgInput.click();
    });

    imgInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
    <?= $this->endSection() ?>