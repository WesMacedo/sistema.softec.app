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
                           <h4 class="nk-block-title"><em class="icon ni ni-users"></em> Clientes</h4>
                           <div class="nk-block-des">
                              <p>Clientes registrados no sistema</p>
                           </div>
                        </div>
                        <div class="card-tools">
                           <a href="<?= base_url('clientes/cadastrar') ?>" class="btn btn-outline-light btn-white"><em
                                 class="icon ni ni-user-add"></em><span>Novo cliente</span> </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-bordered card-preview">
                  <div class="card-inner">
                     <!-- Mantida a classe original do seu template para preservar o design -->
                     <table class="datatable-init nowrap table">
                        <thead>
                           <tr>
                              <th>Nome / Razão Social</th>
                              <th>CPF / CNPJ</th>
                              <th>WhatsApp</th>
                              <th>Cidade / UF</th>
                              <th>Tipo</th>
                              <th class="text-end">Ações</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (!empty($clientes)): ?>
                           <?php foreach ($clientes as $cliente): ?>
                           <tr>
                              <td><?= esc($cliente['nome_razaosocial']) ?></td>
                              <td><?= esc($cliente['cpf_cnpj'] ?? '-') ?></td>
                              <td><?= esc($cliente['whatsapp'] ?? '-') ?></td>
                              <td><?= esc($cliente['cidade'] ?? '') ?> / <?= esc($cliente['estado'] ?? '') ?></td>
                              <td>
                                 <span
                                    class="badge badge-dim <?= ($cliente['tipo'] == 'PJ') ? 'bg-outline-info' : 'bg-outline-primary' ?>">
                                    <?= esc($cliente['tipo']) ?>
                                 </span>
                              </td>
                              <td class="text-end">
                                 <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                       data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                       <ul class="link-list-opt no-bdr">
                                          <li><a href="<?= base_url('clientes/editar/' . $cliente['id']) ?>"><em
                                                   class="icon ni ni-edit"></em><span>Editar</span></a></li>
                                          <li><a href="#" onclick="deletarCliente(<?= $cliente['id'] ?>)"><em
                                                   class="icon ni ni-trash"></em><span>Excluir</span></a></li>
                                       </ul>
                                    </div>
                                 </div>
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