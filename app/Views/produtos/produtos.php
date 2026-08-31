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
               <th>Produto</th>
               <th>Estoque</th>
               <th>Valor</th>
               <th>Catálogo</th>
               <th>Ativo</th>
               <th class="text-end">Ações</th>
            </tr>
         </thead>
         <tbody style="font-size: 13px;">
            <?php if (!empty($produtos)): ?>
            <?php foreach ($produtos as $produto): ?>
            <tr>
               <td>
                  <div class="user-card d-flex align-items-center">
                     <div class="user-avatar sm me-3 flex-shrink-0">
                        <?php if (!empty($produto['img'])): ?>
                           <img src="<?= base_url(esc($produto['img'])) ?>" alt="<?= esc($produto['produto']) ?>">
                        <?php else: ?>
                           <em class="icon ni ni-package"></em>
                        <?php endif; ?>
                     </div>
                     <div class="user- d-flex flex-column">
                        <span class="tb-lead"><?= esc($produto['produto']) ?></span>
                        <span class="badge bg-light text-muted">SKU: <?= esc($produto['id_produto'] ?? 'N/A') ?></span>
                     </div>
                  </div>
               </td>
               <td><?= esc($produto['estoque'] ?? 0) ?> un</td>
               <td>
                  R$ <?= number_format(($produto['valor_varejo'] ?? 0) / 100, 2, ',', '.') ?>
                </td>
               <td>
                  <span class="badge <?= (($produto['catalogo'] ?? 'Sim') == 'Sim') ? 'bg-outline-success ' : 'bg-gray' ?>">
                     <?= esc($produto['catalogo'] ?? 'Sim') ?>
                  </span>
               </td>
               <td>
                  <span class="badge <?= (($produto['ativo'] ?? 'Sim') == 'Sim') ? 'bg-outline-success ' : 'bg-gray' ?>">
                     <?= esc($produto['ativo'] ?? 'Sim') ?>
                  </span>
               </td>
               <td class="text-end">
                  <a href="<?= base_url('produtos/visualizar/' . $produto['id_produto']) ?>" class="btn btn-outline-light btn-white btn-sm" title="Visualizar">
                     <em class="icon ni ni-eye"></em>
                  </a>
                  <a href="<?= base_url('produtos/editar/' . $produto['id_produto']) ?>" class="btn btn-outline-light btn-white btn-sm" title="Editar">
                     <em class="icon ni ni-edit"></em>
                  </a>
               </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
         </tbody>
      </table>
   </div>
</div>

<!-- Estilo CSS Corrigido para o Alinhamento do Ícone Responsivo -->
<style>
   /* Transforma a célula em um container flexível para alinhar perfeitamente o botão '+' e o card do produto */
   table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control,
   table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control {
      display: flex !important;
      align-items: center !important;
   }

   /* Remove o posicionamento absoluto padrão do Datatable que causava o conflito com a imagem */
   table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control:before {
      top: auto !important;
      left: auto !important;
      position: relative !important;
      transform: none !important;
      margin-right: 10px !important;
      display: inline-flex !important;
   }

   /* Mantém o avatar protegido contra redimensionamentos indesejados */
   .user-avatar.flex-shrink-0 {
      flex-shrink: 0;
   }
</style>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>