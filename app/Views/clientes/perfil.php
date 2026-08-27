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
                           <h5 class="nk-block-title"><em
                                 class="icon ni ni-user"></em><span><?= esc($cliente['nome_razaosocial']) ?></span></h4>

                        </div>
                        <div class="card-tools">
                           <a href="<?= base_url('clientes') ?>" class="btn btn-outline-light btn-white"><em
                                 class="icon ni ni-arrow-left"></em><span>Voltar</span> </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-bordered">
                  <div class="card-aside-wrap">
                     <div class="card-content">
                        <!-- Menu de Abas (Modificado apenas para adicionar o controle do Bootstrap) -->
                        <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card" role="tablist">
                           <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-personal"
                                 role="tab"><em class="icon ni ni-user-circle"></em><span>Dados do cliente</span></a>
                           </li>
                           <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-transactions"
                                 role="tab"><i class="icon bi bi-tools" style="font-size: 15px;"></i><span>Ordens de serviços</span></a></li>
                           <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-documents"
                                 role="tab"><em class="icon ni ni-cart"></em><span>Compras e pedidos</span></a></li> 
                           <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-activities"
                                 role="tab"><em class="icon ni ni-activity"></em><span>Logs da conta</span></a></li>
                           <li class="nav-item nav-item-trigger d-xxl-none"><a href="#"
                                 class="toggle btn btn-icon btn-trigger" data-target="userAside"><em
                                    class="icon ni ni-user-list-fill"></em></a></li>
                        </ul>

                        <!-- Container das Abas -->
                        <div class="tab-content">

                           <!-- ABA 1: PERSONAL (Contém todo o seu HTML original) -->
                           <div class="tab-pane active" id="tab-personal" role="tabpanel">
                              <div class="card-inner">
                                 <div class="nk-block">
                                    <div class="nk-block-head">
                                       <h6 class="title">Informações pessoais</h6>
                                       <p>Dados cadastrados do cliente no sistema.</p>
                                    </div>
                                    <div class="profile-ud-list">

                                       <!-- ID / Código do Cliente -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Código:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['id_cliente'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Nome / Razão Social -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Cliente:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['nome_razaosocial'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Tipo (PF / PJ) -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Tipo:</span>
                                             <span class="profile-ud-value"><?= esc($cliente['tipo'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- CPF / CNPJ -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">CPF / CNPJ:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['cpf_cnpj'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Inscrição Estadual -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Insc. Estadual:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['insc_estadual'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Inscrição Municipal -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Insc. Municipal:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['insc_municipal'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- WhatsApp -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">WhatsApp:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['whatsapp'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Celular -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Celular:</span>
                                             <span class="profile-ud-value"><?= esc($cliente['celular'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- Telefone -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">Telefone:</span>
                                             <span
                                                class="profile-ud-value"><?= esc($cliente['telefone'] ?? '') ?></span>
                                          </div>
                                       </div>

                                       <!-- E-mail -->
                                       <div class="profile-ud-item copiar-texto" style="cursor: pointer;"
                                          title="Clique para copiar">
                                          <div class="profile-ud wider">
                                             <span class="profile-ud-label">E-mail:</span>
                                             <span class="profile-ud-value"><?= esc($cliente['email'] ?? '') ?></span>
                                          </div>
                                       </div>

                                    </div>
                                 </div>

                                 <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-line">
                                       <h6 class="title overline-title text-base">Endereço</h6>
                                    </div>
                                    <div class="profile-ud-list">

                                       <!-- Endereço Completo expandido mantendo a estrutura de label/value -->
                                       <div class="profile-ud-item w-100 copiar-texto"
                                          style="flex-basis: 100%; cursor: pointer;" title="Clique para copiar">
                                          <div class="profile-ud wider w-100">
                                             <span class="profile-ud-label">Endereço:</span>
                                             <span class="profile-ud-value" id="texto-endereco">
                                                <?= esc($cliente['rua'] ?? '') ?>,
                                                <?= esc($cliente['n_casa'] ?? '') ?> -
                                                <?= esc($cliente['bairro'] ?? '') ?>,
                                                <?= esc($cliente['cidade'] ?? '') ?>/<?= esc($cliente['estado'] ?? '') ?>
                                                -
                                                CEP: <?= esc($cliente['cep'] ?? '') ?>
                                             </span>
                                          </div>
                                       </div>

                                    </div>
                                 </div>

                                 <div class="nk-divider divider md"></div>
                                 <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                       <h6 class="title">Observações / Notas </h6>
                                       <a href="#" class="link link-sm" data-bs-toggle="modal"
                                          data-bs-target="#modalForm">+ Adicionar observação</a>
                                    </div>

                                    <div class="bq-note">
                                       <?php if (!empty($notas)): ?>
                                       <?php foreach ($notas as $n): ?>
                                       <div class="bq-note-item" id="nota-item-<?= $n['id_nota'] ?>">
                                          <div class="bq-note-text">
                                             <p><?= nl2br(esc($n['nota'])) ?></p>
                                          </div>
                                          <div class="bq-note-meta">

                                             <?php 
                                    // Array de tradução dos meses
                                    $mesesPt = [
                                       'January' => 'janeiro', 'February' => 'fevereiro', 'March' => 'março', 
                                       'April' => 'abril', 'May' => 'maio', 'June' => 'junho', 
                                       'July' => 'julho', 'August' => 'agosto', 'September' => 'setembro', 
                                       'October' => 'outubro', 'November' => 'novembro', 'December' => 'dezembro'
                                    ];
                                    $mesIngles = date('F', strtotime($n['created_at']));
                                    $mesPt = $mesesPt[$mesIngles] ?? $mesIngles;
                                    ?>

                                             <span class="bq-note-added">
                                                Criada em <span
                                                   class="date"><?= date('d', strtotime($n['created_at'])) ?> de
                                                   <?= $mesPt ?> de <?= date('Y', strtotime($n['created_at'])) ?></span>
                                                ás
                                                <span
                                                   class="time"><?= date('H:i', strtotime($n['created_at'])) ?></span>
                                             </span>
                                             <span class="bq-note-sep sep">|</span>
                                             <span class="bq-note-by">Por
                                                <span><?= esc($n['nome_usuario'] ?? 'Funcionário') ?></span>
                                             </span>
                                             <a href="#" class="link link-sm link-danger btn-deletar-nota"
                                                data-id="<?= $n['id_nota'] ?>">Excluir observação</a>
                                          </div>
                                       </div>
                                       <?php endforeach; ?>
                                       <?php else: ?>
                                       <div class="text-soft p-3">Sem observações.</div>
                                       <?php endif; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- ABA 2: TRANSACTIONS -->
                           <div class="tab-pane" id="tab-transactions" role="tabpanel">
                              <div class="card-inner">
                                 <h5 class="title">Transactions</h5>
                                 <p>Conteúdo da aba Transactions...</p>
                              </div>
                           </div>

                           <!-- ABA 3: DOCUMENTS -->
                           <div class="tab-pane" id="tab-documents" role="tabpanel">
                              <div class="card-inner">
                                 <h5 class="title">Documents</h5>
                                 <p>Conteúdo da aba Documents...</p>
                              </div>
                           </div>
 
                           <!-- ABA 5: ACTIVITIES -->
                           <div class="tab-pane" id="tab-activities" role="tabpanel">
                              <div class="card-inner">
                                 <h5 class="title">Activities</h5>
                                 <p>Conteúdo da aba Activities...</p>
                              </div>
                           </div>

                        </div>
                     </div>

                     <!-- Barra Lateral (Aside) - Intacta e preservada -->
                     <div
                        class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl"
                        data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true"
                        data-toggle-body="true">
                        <div class="card-inner-group" data-simplebar>
                           <div class="card-inner">
                              <div class="user-card user-card-s2">
                                 <div class="user-avatar lg bg-primary">
                                    <span><?= $iniciais ?></span>
                                 </div>
                                 <div class="user-info">
                                    <div class="badge bg-outline-light rounded-pill ucap">
                                       <?= esc($cliente['tipo'] ?? '') ?></div>
                                    <h6><?= esc($cliente['nome_razaosocial'] ?? '') ?></h6><span
                                       class="sub-text"><?= esc($cliente['email'] ?? '') ?></span>
                                 </div>
                              </div>
                           </div>
                           <div class="card-inner card-inner-sm">
                              <ul class="btn-toolbar justify-center gx-1">
                                 <li><a href="<?= base_url('clientes/editar/' . esc($cliente['id_cliente'] ?? '', 'url')) ?>"
                                       class="btn btn-trigger btn-icon"><em class="icon ni ni-edit-profile"></em></a>
                                 </li>
                                 <li>
                                    <a href="#" class="btn btn-trigger btn-icon text-danger btn-excluir"
                                       data-id="<?= $cliente['id_cliente'] ?>">
                                       <em class="icon ni ni-trash-alt"></em>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                           <div class="card-inner">
                              <div class="overline-title-alt mb-2">Saldo em conta</div>
                              <div class="profile-balance">
                                 <!-- ADICIONADO: d-flex justify-content-between align-items-center para jogar um pra cada ponta -->
                                 <div class="profile-balance-group d-flex justify-content-between align-items-center">
                                    <div class="profile-balance-sub">
                                       <div class="profile-balance-amount">
                                          <div class="number">
                                             <span id="displaySaldo">R$
                                                <?= number_format($saldo_cliente, 2, ',', '.') ?></span>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- Botão para abrir o modal alinhado à direita -->
                                    <div class="profile-balance-sub text-end">
                                       <button type="button" class="btn btn-outline-light btn-white btn-sm"
                                          data-bs-toggle="modal" data-bs-target="#modalEditarSaldo"
                                          title="Editar Saldo">
                                          Atualizar saldo
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>


                           <div class="card-inner">
                              <div class="row text-center">
                                 <div class="col-6">
                                    <div class="profile-stats"><span class="amount">23</span><span
                                          class="sub-text">Compras</span></div>
                                 </div>
                                 <div class="col-6">
                                    <div class="profile-stats"><span class="amount">20</span><span
                                          class="sub-text">Consertos</span></div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-inner">
                              <h6 class="overline-title-alt mb-2">Informações adicionais</h6>
                              <div class="row g-3">
                                 <div class="col-6"><span
                                       class="sub-text">Código:</span><span><?= esc($cliente['id_cliente'] ?? '') ?></span>
                                 </div>
                                 <div class="col-6"><span class="sub-text">Último acesso:</span><span>15 Feb,
                                       2019 01:02
                                       PM</span></div>
                                 <div class="col-6"><span class="sub-text">Status:</span><span
                                       class="lead-text text-success">Conta ativa</span>
                                 </div>
                                 <?php 
                                 // Array de tradução dos meses em português
                                 $mesesPt = [
                                    'January' => 'janeiro', 'February' => 'fevereiro', 'March' => 'março', 
                                    'April' => 'abril', 'May' => 'maio', 'June' => 'junho', 
                                    'July' => 'julho', 'August' => 'agosto', 'September' => 'setembro', 
                                    'October' => 'outubro', 'November' => 'novembro', 'December' => 'dezembro'
                                 ];

                                 $dataRegistro = $cliente['created_at'] ?? null;
                                 if (!empty($dataRegistro)) {
                                    $mesIngles = date('F', strtotime($dataRegistro));
                                    $mesPt = $mesesPt[$mesIngles] ?? $mesIngles;
                                    
                                    // Formata a data (dia, mês, ano) + hora e minuto (H:i)
                                    $dataFormatada = date('d', strtotime($dataRegistro)) . ' de ' . $mesPt . ' de ' . date('Y', strtotime($dataRegistro)) . ' às ' . date('H:i', strtotime($dataRegistro));
                                 } else {
                                    $dataFormatada = 'Data não disponível';
                                 }
                                 ?>

                                 <div class="col-6">
                                    <span class="sub-text">Registrado em:</span>
                                    <span><?= $dataFormatada ?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="modalEditarSaldo" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Saldo do cliente</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Fechar">
               <em class="icon ni ni-cross"></em>
            </a>
         </div>
         <div class="modal-body">
            <form id="formSaldo" class="form-validate is-alter">
               <input type="hidden" name="id_cliente" value="<?= esc($cliente['id_cliente']) ?>">

               <div class="form-group mb-3">
                  <label class="form-label" for="operacao">Ação</label>
                  <div class="form-control-wrap">
                     <select class="form-select" id="operacao" name="operacao">
                        <option value="adicionar">Adicionar Saldo (+)</option>
                        <option value="remover">Remover Saldo (-)</option>
                     </select>
                  </div>
               </div>

               <div class="form-group mb-3">
                  <label class="form-label" for="valorInputVisual">Valor</label>
                  <div class="form-control-wrap">
                     <!-- Input visual com máscara -->
                     <input type="text" class="form-control" id="valorInputVisual" placeholder="0,00" autocomplete="off"
                        required>
                     <!-- Input real enviado em centavos inteiros -->
                     <input type="hidden" id="valor" name="valor">
                  </div>
                  <!-- Texto dinâmico da prévia -->
                  <div class="form-note mt-1">
                     Novo saldo estimado: <strong id="previewSaldo" class="text-primary">R$ 0,00</strong>
                  </div>
               </div>

               <div class="form-group text-end">
                  <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" id="btnSalvarSaldo" class="btn btn-primary">Salvar Alteração</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Modal para Adicionar Nota -->
<div class="modal fade" id="modalForm">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Adicionar observação.</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
               <em class="icon ni ni-cross"></em>
            </a>
         </div>
         <div class="modal-body">
            <form id="formAdicionarNota" class="form-validate is-alter">
               <input type="hidden" name="id_cliente" value="<?= esc($cliente['id_cliente']) ?>">

               <div class="form-group">
                  <label class="form-label" for="nota">Descrição</label>
                  <div class="form-control-wrap">
                     <textarea class="form-control" id="nota" name="nota" rows="4"
                        placeholder="Digite a observação sobre o cliente..." required></textarea>
                  </div>
               </div>

               <div class="form-group">
                  <button type="submit" id="btnSalvarNota" class="btn btn-lg btn-primary">Salvar</button>
               </div>
            </form>
         </div>
         <div class="modal-footer bg-light"><span class="sub-text">Apenas a equipe poderá ver as observações</span>
         </div>
      </div>
   </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

   // --- 1. FUNÇÃO DE COPIAR TEXTO ---
   const itensParaCopiar = document.querySelectorAll('.copiar-texto');
   itensParaCopiar.forEach(function(item) {
      item.addEventListener('click', function() {
         let valorElemento = this.querySelector('.profile-ud-value') || this.querySelector(
            '#texto-endereco');
         if (!valorElemento) return;

         const textoParaCopiar = valorElemento.innerText.trim();
         if (textoParaCopiar === '') return;

         navigator.clipboard.writeText(textoParaCopiar).then(function() {
            item.style.transition = 'background-color 0.2s';
            item.style.backgroundColor = 'rgba(78, 140, 255, 0.1)';
            setTimeout(function() {
               item.style.backgroundColor = '';
            }, 300);

            // Alerta nativo do DashLite (NioApp.Toast)
            if (typeof NioApp !== 'undefined' && NioApp.Toast) {
               NioApp.Toast('Copiado para a área de transferência!', 'success', {
                  position: 'bottom-right'
               });
            } else {
               console.log('Copiado: ' + textoParaCopiar);
            }
         }).catch(function(err) {
            console.error('Erro ao tentar copiar: ', err);
         });
      });
   });

   // --- 2. SALVAR NOTA VIA AJAX ---
   const formNota = document.getElementById('formAdicionarNota');
   if (formNota) {
      formNota.addEventListener('submit', function(e) {
         e.preventDefault();

         const formData = new FormData(formNota);
         const btnSubmit = document.getElementById('btnSalvarNota');
         btnSubmit.setAttribute('disabled', 'true');

         // Token CSRF
         const csrfName = '<?= csrf_token() ?>';
         const csrfHash = '<?= csrf_hash() ?>';
         formData.append(csrfName, csrfHash);

         fetch('<?= base_url('clientes/salvarNota') ?>', {
               method: 'POST',
               body: formData,
               headers: {
                  'X-Requested-With': 'XMLHttpRequest'
               }
            })
            .then(response => response.json())
            .then(data => {
               btnSubmit.removeAttribute('disabled');

               if (data.status === 'sucesso') {
                  // FECHA O MODAL IMEDIATAMENTE USANDO O BOOTSTRAP
                  const modalElement = document.getElementById('modalForm');
                  const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(
                     modalElement);
                  modalInstance.hide();

                  // LIMPA O FORMULÁRIO
                  formNota.reset();

                  Swal.fire({
                     icon: 'success',
                     title: 'Sucesso!',
                     text: data.mensagem,
                     timer: 1500,
                     showConfirmButton: false
                  }).then(() => {
                     location.reload();
                  });

               } else {
                  Swal.fire({
                     icon: 'error',
                     title: 'Atenção',
                     text: data.mensagem || 'Ocorreu um erro.'
                  });
               }
            })
            .catch(error => {
               btnSubmit.removeAttribute('disabled');
               console.error('Erro:', error);
               Swal.fire({
                  icon: 'error',
                  title: 'Erro',
                  text: 'Ocorreu um erro ao processar a requisição.'
               });
            });
      });
   }


   // --- 3. EXCLUIR NOTA VIA AJAX ---
   document.body.addEventListener('click', function(e) {
      const btnDelete = e.target.closest('.btn-deletar-nota');
      if (!btnDelete) return;

      e.preventDefault();
      const idNota = btnDelete.getAttribute('data-id');

      Swal.fire({
         title: 'Deseja excluir esta nota?',
         text: "Esta ação não poderá ser desfeita!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#3085d6',
         confirmButtonText: 'Sim, excluir!',
         cancelButtonText: 'Cancelar'
      }).then((result) => {
         if (result.isConfirmed) {
            // Prepara os dados incluindo o token CSRF
            const formData = new FormData();
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

            fetch('<?= base_url('clientes/deletarNota/') ?>' + idNota, {
                  method: 'POST',
                  headers: {
                     'X-Requested-With': 'XMLHttpRequest'
                  },
                  body: formData
               })
               .then(response => response.json())
               .then(data => {
                  if (data.status === 'sucesso') {
                     Swal.fire({
                        icon: 'success',
                        title: 'Excluído!',
                        text: data.mensagem,
                        timer: 1200,
                        showConfirmButton: false
                     }).then(() => {
                        location.reload();
                     });
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: data.mensagem || 'Não foi possível excluir a nota.'
                     });
                  }
               })
               .catch(err => {
                  console.error('Erro na requisição:', err);
                  Swal.fire({
                     icon: 'error',
                     title: 'Erro',
                     text: 'Erro ao conectar com o servidor.'
                  });
               });
         }
      });
   });


   // --- EXCLUIR CLIENTE VIA AJAX ---
   document.body.addEventListener('click', function(e) {
      const btnExcluir = e.target.closest('.btn-excluir');
      if (!btnExcluir) return;

      e.preventDefault();
      const idCliente = btnExcluir.getAttribute('data-id');

      Swal.fire({
         title: 'Excluir cliente do sistema?',
         text: "Esta ação não poderá ser revertida!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#d33',
         cancelButtonColor: '#3085d6',
         confirmButtonText: 'Sim, excluir!',
         cancelButtonText: 'Cancelar'
      }).then((result) => {
         if (result.isConfirmed) {

            // Prepara os dados incluindo o token CSRF exatamente como nas notas
            const formData = new FormData();
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

            fetch('<?= base_url('clientes/excluir/') ?>' + idCliente, {
                  method: 'POST',
                  headers: {
                     'X-Requested-With': 'XMLHttpRequest'
                  },
                  body: formData
               })
               .then(response => response.json())
               .then(data => {
                  if (data.status === 'sucesso') {
                     Swal.fire({
                        icon: 'success',
                        title: 'Excluído!',
                        text: data.mensagem,
                        timer: 1200,
                        showConfirmButton: false
                     }).then(() => {
                        // Redireciona para a listagem geral de clientes
                        window.location.href = '<?= base_url('clientes') ?>';
                     });
                  } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Atenção!',
                        text: data.mensagem || 'Não foi possível excluir o cliente.'
                     });
                  }
               })
               .catch(err => {
                  console.error('Erro na requisição:', err);
                  Swal.fire({
                     icon: 'error',
                     title: 'Erro',
                     text: 'Erro ao conectar com o servidor.'
                  });
               });
         }
      });
   });

   // --- MÁSCARA E PRÉVIA EM TEMPO REAL ---
   const inputVisual = document.getElementById('valorInputVisual');
   const inputRealCentavos = document.getElementById('valor');
   const selectOperacao = document.getElementById('operacao');
   const previewSaldo = document.getElementById('previewSaldo');

   // Lê o saldo atual da tela de forma segura e converte para centavos
   function getSaldoAtualEmCentavos() {
      const displayEl = document.getElementById('displaySaldo');
      if (!displayEl) return 0;

      // Pega o texto (ex: "R$ 1.500,50" ou "1500,50")
      let texto = displayEl.innerText.replace('R$', '').trim();
      // Remove pontos de milhar e troca vírgula por ponto
      texto = texto.replace(/\./g, '').replace(',', '.');
      let valorFloat = parseFloat(texto) || 0;
      return Math.round(valorFloat * 100);
   }

   function atualizarPreview() {
      if (!previewSaldo || !inputRealCentavos) return;

      let centavosInput = parseInt(inputRealCentavos.value) || 0;
      let saldoAtual = getSaldoAtualEmCentavos();
      let operacao = selectOperacao ? selectOperacao.value : 'adicionar';

      let novoTotalCentavos = (operacao === 'adicionar') ? (saldoAtual + centavosInput) : (saldoAtual -
         centavosInput);
      if (novoTotalCentavos < 0) novoTotalCentavos = 0;

      // Formata para exibição em Reais
      let formatado = (novoTotalCentavos / 100).toLocaleString('pt-BR', {
         style: 'currency',
         currency: 'BRL'
      });
      previewSaldo.innerText = formatado;
   }

   if (inputVisual) {
      inputVisual.addEventListener('input', function(e) {
         let valorLimpo = e.target.value.replace(/\D/g, '');
         if (valorLimpo === '') {
            inputVisual.value = '';
            inputRealCentavos.value = '';
            atualizarPreview();
            return;
         }

         let centavos = parseInt(valorLimpo, 10);
         inputRealCentavos.value = centavos; // Envia o valor puro em centavos

         // Formata o input visual como moeda (ex: 150 -> 1,50)
         let reais = centavos / 100;
         inputVisual.value = reais.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
         });

         atualizarPreview();
      });
   }

   if (selectOperacao) {
      selectOperacao.addEventListener('change', atualizarPreview);
   }

   // Atualiza a prévia sempre que o modal for aberto
   const modalEl = document.getElementById('modalEditarSaldo');
   if (modalEl) {
      modalEl.addEventListener('shown.bs.modal', function() {
         if (inputVisual) inputVisual.focus();
         atualizarPreview();
      });
   }


   // --- ATUALIZAR SALDO VIA AJAX ---
   const formSaldo = document.getElementById('formSaldo');
   if (formSaldo) {
      formSaldo.addEventListener('submit', function(e) {
         e.preventDefault();

         const formData = new FormData(formSaldo);
         const btnSubmit = document.getElementById('btnSalvarSaldo');
         btnSubmit.setAttribute('disabled', 'true');

         // Token CSRF padrão do sistema
         const csrfName = '<?= csrf_token() ?>';
         const csrfHash = '<?= csrf_hash() ?>';
         formData.append(csrfName, csrfHash);

         fetch('<?= base_url('clientes/attsaldo') ?>', {
               method: 'POST',
               body: formData,
               headers: {
                  'X-Requested-With': 'XMLHttpRequest'
               }
            })
            .then(response => response.json())
            .then(data => {
               btnSubmit.removeAttribute('disabled');

               if (data.status === 'sucesso') {
                  // Fecha o modal
                  const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(
                     modalEl);
                  modalInstance.hide();

                  // Reseta o form e campos visuais
                  formSaldo.reset();
                  if (inputVisual) inputVisual.value = '';
                  if (inputRealCentavos) inputRealCentavos.value = '';
                  if (previewSaldo) previewSaldo.innerText = 'R$ 0,00';

                  // Atualiza o saldo na tela em tempo real sem precisar recarregar
                  const displaySaldo = document.getElementById('displaySaldo');
                  if (displaySaldo) {
                     displaySaldo.innerText = 'R$ ' + data.novo_saldo_formatado;
                  }

                  Swal.fire({
                     icon: 'success',
                     title: 'Sucesso!',
                     text: data.mensagem, 
                     confirmButtonText: 'OK'
                  }).then(() => {
                     location.reload();
                  });

               } else {
                  Swal.fire({
                     icon: 'error',
                     title: data.title,
                     text: data.mensagem || 'Ocorreu um erro.'
                  });
               }
            })
            .catch(error => {
               btnSubmit.removeAttribute('disabled');
               console.error('Erro:', error);
               Swal.fire({
                  icon: 'error',
                  title: 'Erro',
                  text: 'Ocorreu um erro ao processar a requisição.'
               });
            });
      });
   }

});
</script>
<?= $this->endSection() ?>