<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="nk-content-inner">
      <div class="nk-content-body">
         <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block nk-block-lg">
               <div class="nk-block-head">
                  <div class="nk-block-head-content">
                     <div class="card-title-group">
                        <div class="card-title card-title-sm">
                           <h4 class="nk-block-title"><em class="icon ni ni-package"></em> Produtos</h4>
                           <div class="nk-block-des">
                              <p>Produtos registrados no sistema</p>
                           </div>
                        </div>
                        <div class="card-tools">
                           <a href="<?= base_url('produtos/cadastrar') ?>" class="btn btn-outline-light btn-white">
                              <em class="icon ni ni-plus"></em><span>Novo produto</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-bordered card-preview">
                  <div class="card-inner">
                     <table class="datatable-init nowrap table">
                        <thead>
                           <tr>
                              <th>SKU</th>
                              <th>Nome</th>
                              <th>Estoque</th>
                              <th>Valor</th>
                              <th>Catálogo</th>
                              <th>Status</th>
                              <th class="text-end">Ações</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (!empty($produtos)): ?>
                           <?php foreach ($produtos as $produto): ?>
                           <tr>
                              <td><span class="badge badge-dim bg-outline-secondary"><?= esc($produto['sku'] ?? 'N/A') ?></span></td>
                              <td><?= esc($produto['nome']) ?></td>
                              <td><?= esc($produto['estoque'] ?? 0) ?> un</td>
                              <td>R$ <?= number_format($produto['valor_varejo'] ?? 0, 2, ',', '.') ?></td>
                              <td>R$ <?= number_format($produto['catalogo']); ?></td>
                              <td>
                                 <span class="badge badge-dim <?= (($produto['ativo'] ?? 'Sim') == 'Sim') ? 'bg-outline-success' : 'bg-outline-danger' ?>">
                                    <?= esc($produto['ativo'] ?? 'Sim') ?>
                                 </span>
                              </td>
                              <td class="text-end">
                                 <a href="<?= base_url('produtos/visualizar/' . $produto['sku']) ?>" class="btn btn-outline-light btn-white btn-sm">
                                    <em class="icon ni ni-external"></em>
                                 </a> 
                              </td>
                           </tr>
                           <?php endforeach; ?>
                           <?php endif; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>