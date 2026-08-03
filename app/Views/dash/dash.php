<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="nk-content-inner">
      <div class="nk-content-body">
         <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
               <div class="nk-block-head-content">
                  <h5 class="title nk-block-title">Olá, <?php echo htmlspecialchars($usuario['nome'] ?? 'Usuário'); ?>!</h5>

<p><strong>Empresa:</strong> <?php echo htmlspecialchars($usuario['nome_empresa']); ?></p>
<p><strong>E-mail:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
<p><strong>WhatsApp:</strong> <?php echo htmlspecialchars($usuario['whatsapp']); ?></p>
                  <div class="nk-block-des text-soft">
                     <p>Aqui está o resumo do dia</p>
                  </div>
               </div>
               <div class="nk-block-head-content">
                  <div class="toggle-wrap nk-block-tools-toggle">
                     <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                     <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                           <li>
                              <div class="drodown">
                                 <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                 <div class="dropdown-menu dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                       <li><a href="#"><span>Last 30 Days</span></a></li>
                                       <li><a href="#"><span>Last 6 Months</span></a></li>
                                       <li><a href="#"><span>Last 1 Years</span></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </li>
                           <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>