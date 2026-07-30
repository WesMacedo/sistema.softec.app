
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
                                <h4 class="page-title">Lista de prêmios</h4>
                                <div class="">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#">Allow Payments</a>
                                        </li><!--end nav-item-->
                                        <li class="breadcrumb-item"><a href="#">Corrida</a>
                                        </li><!--end nav-item-->
                                        <li class="breadcrumb-item active">Prêmiação</li>
                                    </ol>
                                </div>                                
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                
                <div class="row"> 
                    <div class="col-12">
                        
                            <div class="card-header">
                                                          
                            </div><!--end card-header-->
 

                            <div class="card-body pt-0">


                            <div class="row justify-content-center">
                        
                    
                    <?php if (!empty($premios)): ?>
    <?php foreach ($premios as $premio): ?>
                     <div class="col-md-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h6 class="pt-3 pb-2 m-0 fs-18 fw-medium"><?= esc($premio['id']) ?>° Lugar</h6>
                                         <img src="<?= esc($premio['img']) ?>" class="thumb-md align-self-center rounded" alt="" style="display: inline;width: 100%;height: 160px;object-fit: contain;"> 
 
                                         <div class="pt-3"> 
                                        <h6 class="pt-3 pb-2 m-0 fs-18 fw-medium"><?= esc($premio['descricao']) ?></h6>
                                        </div>
                                       <hr class="hr-dashed">                     
                                        <a href="<?= base_url('premios/editar/' . $premio['id']) ?>" class="btn btn-dark py-2 px-5 mt-3 w-100"><span>Editar Prêmio</span></a>
                                    </div>            
                                </div>
                            </div>
                        </div>
          <?php endforeach; ?>
                                            <?php else: ?>
                                                Erro ao carregar premios.
                                            <?php endif; ?>              
                        
                                                                                
                    </div>
                                 
                         
                        </div>
                    
                </div> <!-- end row --> 
            </div><!-- container -->
 
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/datatable.init.js"></script>
    <script src="assets/js/app.js"></script>
<?= $this->endSection() ?>

