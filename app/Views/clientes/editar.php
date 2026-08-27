<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
   <div class="nk-content-inner">
      <div class="nk-content-body">
         <div class="components-preview ">
            <div class="nk-block nk-block-lg">
               <div class="nk-block-head">
                  <div class="nk-block-head-content">
                     <div class="card-title-group">
                        <div class="card-title card-title-sm">
                           <h4 class="nk-block-title"><em class="icon ni ni-edit-profile"></em> Atualizar cadastro</h4>
                           <div class="nk-block-des">
                              <p>Atualizar os dados cadastrais do cliente</p>
                           </div>
                        </div>
                        <div class="card-tools">
                           <a href="<?= base_url('clientes/perfil/'."{$cliente['id_cliente']}") ?>" class="btn btn-outline-light btn-white"><em
                                 class="icon ni ni-arrow-left"></em><span>Voltar</span> </a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Início do Formulário com CodeIgniter 4 -->
<?= form_open("clientes/atualizarCliente/{$cliente['id_cliente']}", ['id' => 'formEditarCliente']) ?>

    <!-- ID Oculto do Cliente -->
    <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?? '' ?>">

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="row gy-4">
                <span class="preview-title overline-title" id="campos_obrigatorios">Campos marcados com * são obrigatórios.</span>
                
                <!-- CPF / CNPJ -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="cpf_cnpj" id="cpf_cnpj" value="<?= $cliente['cpf_cnpj'] ?? '' ?>">
                            <label class="form-label-outlined" for="cpf_cnpj">CPF / CNPJ</label>
                        </div>
                    </div>
                </div>

                <!-- Nome / Razão Social -->
                <div class="col-lg-5 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="nome_razaosocial" id="nome_razaosocial" value="<?= $cliente['nome_razaosocial'] ?? '' ?>">
                            <label class="form-label-outlined" for="nome_razaosocial">Nome / Razão social *</label>
                        </div>
                    </div>
                </div>

                <!-- Insc. Municipal -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="insc_municipal" id="insc_municipal" value="<?= $cliente['insc_municipal'] ?? '' ?>">
                            <label class="form-label-outlined" for="insc_municipal">Insc. municipal</label>
                        </div>
                    </div>
                </div>

                <!-- Insc. Estadual -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="insc_estadual" id="insc_estadual" value="<?= $cliente['insc_estadual'] ?? '' ?>">
                            <label class="form-label-outlined" for="insc_estadual">Insc. estadual</label>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="email" id="email" value="<?= $cliente['email'] ?? '' ?>">
                            <label class="form-label-outlined" for="email">Email</label>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="whatsapp" id="whatsapp" value="<?= $cliente['whatsapp'] ?? '' ?>">
                            <label class="form-label-outlined" for="whatsapp">WhatsApp *</label>
                        </div>
                    </div>
                </div>

                <!-- Celular -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="celular" id="celular" value="<?= $cliente['celular'] ?? '' ?>">
                            <label class="form-label-outlined" for="celular">Celular</label>
                        </div>
                    </div>
                </div>

                <!-- Telefone -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="telefone" id="telefone" value="<?= $cliente['telefone'] ?? '' ?>">
                            <label class="form-label-outlined" for="telefone">Telefone</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="preview-hr">

            <div class="row gy-3">
                <!-- CEP -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="cep" id="cep" value="<?= $cliente['cep'] ?? '' ?>">
                            <label class="form-label-outlined" for="cep">CEP</label>
                        </div>
                    </div>
                </div>

                <!-- Rua -->
                <div class="col-lg-3 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="rua" id="rua" value="<?= $cliente['rua'] ?? '' ?>">
                            <label class="form-label-outlined" for="rua">Rua</label>
                        </div>
                    </div>
                </div>

                <!-- Número -->
                <div class="col-lg-1 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="n_casa" id="n_casa" value="<?= $cliente['n_casa'] ?? '' ?>">
                            <label class="form-label-outlined" for="n_casa">N°</label>
                        </div>
                    </div>
                </div>

                <!-- Bairro -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="bairro" id="bairro" value="<?= $cliente['bairro'] ?? '' ?>">
                            <label class="form-label-outlined" for="bairro">Bairro</label>
                        </div>
                    </div>
                </div>

                <!-- Cidade -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-outlined" name="cidade" id="cidade" value="<?= $cliente['cidade'] ?? '' ?>">
                            <label class="form-label-outlined" for="cidade">Cidade</label>
                        </div>
                    </div>
                </div>

                <!-- Estado (UF) -->
                <div class="col-lg-2 col-sm-6">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <select class="form-select js-select2" name="estado" id="estado">
                                <option value="">Selecione o Estado</option>
                                <option value="AC" <?= (isset($cliente['estado']) && $cliente['estado'] == 'AC') ? 'selected' : '' ?>>Acre</option>
                                <option value="AL" <?= (isset($cliente['estado']) && $cliente['estado'] == 'AL') ? 'selected' : '' ?>>Alagoas</option>
                                <option value="AP" <?= (isset($cliente['estado']) && $cliente['estado'] == 'AP') ? 'selected' : '' ?>>Amapá</option>
                                <option value="AM" <?= (isset($cliente['estado']) && $cliente['estado'] == 'AM') ? 'selected' : '' ?>>Amazonas</option>
                                <option value="BA" <?= (isset($cliente['estado']) && $cliente['estado'] == 'BA') ? 'selected' : '' ?>>Bahia</option>
                                <option value="CE" <?= (isset($cliente['estado']) && $cliente['estado'] == 'CE') ? 'selected' : '' ?>>Ceará</option>
                                <option value="DF" <?= (isset($cliente['estado']) && $cliente['estado'] == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
                                <option value="ES" <?= (isset($cliente['estado']) && $cliente['estado'] == 'ES') ? 'selected' : '' ?>>Espírito Santo</option>
                                <option value="GO" <?= (isset($cliente['estado']) && $cliente['estado'] == 'GO') ? 'selected' : '' ?>>Goiás</option>
                                <option value="MA" <?= (isset($cliente['estado']) && $cliente['estado'] == 'MA') ? 'selected' : '' ?>>Maranhão</option>
                                <option value="MT" <?= (isset($cliente['estado']) && $cliente['estado'] == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
                                <option value="MS" <?= (isset($cliente['estado']) && $cliente['estado'] == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                                <option value="MG" <?= (isset($cliente['estado']) && $cliente['estado'] == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
                                <option value="PA" <?= (isset($cliente['estado']) && $cliente['estado'] == 'PA') ? 'selected' : '' ?>>Pará</option>
                                <option value="PB" <?= (isset($cliente['estado']) && $cliente['estado'] == 'PB') ? 'selected' : '' ?>>Paraíba</option>
                                <option value="PR" <?= (isset($cliente['estado']) && $cliente['estado'] == 'PR') ? 'selected' : '' ?>>Paraná</option>
                                <option value="PE" <?= (isset($cliente['estado']) && $cliente['estado'] == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
                                <option value="PI" <?= (isset($cliente['estado']) && $cliente['estado'] == 'PI') ? 'selected' : '' ?>>Piauí</option>
                                <option value="RJ" <?= (isset($cliente['estado']) && $cliente['estado'] == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
                                <option value="RN" <?= (isset($cliente['estado']) && $cliente['estado'] == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                                <option value="RS" <?= (isset($cliente['estado']) && $cliente['estado'] == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                                <option value="RO" <?= (isset($cliente['estado']) && $cliente['estado'] == 'RO') ? 'selected' : '' ?>>Rondônia</option>
                                <option value="RR" <?= (isset($cliente['estado']) && $cliente['estado'] == 'RR') ? 'selected' : '' ?>>Roraima</option>
                                <option value="SC" <?= (isset($cliente['estado']) && $cliente['estado'] == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
                                <option value="SP" <?= (isset($cliente['estado']) && $cliente['estado'] == 'SP') ? 'selected' : '' ?>>São Paulo</option>
                                <option value="SE" <?= (isset($cliente['estado']) && $cliente['estado'] == 'SE') ? 'selected' : '' ?>>Sergipe</option>
                                <option value="TO" <?= (isset($cliente['estado']) && $cliente['estado'] == 'TO') ? 'selected' : '' ?>>Tocantins</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-lighter border-top d-flex align-center justify-content-end py-3">
            <button type="button" class="btn btn-primary" id="btnSalvar"><span>Salvar Alterações</span></button>
        </div>
    </div>

<?= form_close() ?>
            </div>

         </div>

      </div>
   </div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
   // --- FUNÇÃO PARA CAPITALIZAR PALAVRAS (Title Case) ---
   function capitalizarTexto(texto) {
      if (!texto) return "";
      return texto.toLowerCase().replace(/(?:^|\s)\S/g, function(a) {
         return a.toUpperCase();
      });
   }

   // --- FUNÇÃO AUXILIAR DE PREENCHIMENTO COM FLOATING LABEL ---
   function preencherEAtivarLabel(id, valor, formatarTitulo = false, forcarMinusculo = false) {
      const campo = document.getElementById(id);
      if (campo) {
         let valorFinal = valor || "";

         if (valorFinal) {
            if (forcarMinusculo) {
               valorFinal = valorFinal.toLowerCase();
            } else if (formatarTitulo) {
               valorFinal = capitalizarTexto(valorFinal);
            }
         }

         campo.value = valorFinal;

         if (valorFinal) {
            campo.classList.add("focused");
            campo.classList.add("form-control-active");
         } else {
            campo.classList.remove("focused");
            campo.classList.remove("form-control-active");
         }

         const parentControl = campo.closest('.form-control-wrap') || campo.parentElement;
         if (parentControl) {
            if (valorFinal) {
               parentControl.classList.add("focused");
            } else {
               parentControl.classList.remove("focused");
            }
         }

         campo.dispatchEvent(new Event('input', { bubbles: true }));
         campo.dispatchEvent(new Event('change', { bubbles: true }));
      }
   }

   // --- FUNÇÕES DE LIMPEZA ---
   function limparCamposCnpj() {
      preencherEAtivarLabel("nome_razaosocial", "");
      preencherEAtivarLabel("email", "");
      preencherEAtivarLabel("whatsapp", "");
      preencherEAtivarLabel("cep", "");
      limparCamposCep();
   }

   function limparCamposCep() {
      preencherEAtivarLabel("rua", "");
      preencherEAtivarLabel("bairro", "");
      preencherEAtivarLabel("cidade", "");
      preencherEAtivarLabel("n_casa", "");

      const selectEstado = document.getElementById("estado");
      if (selectEstado) {
         selectEstado.value = "";
         selectEstado.classList.remove("focused");
         selectEstado.dispatchEvent(new Event('change', { bubbles: true }));

         if (window.jQuery && $(selectEstado).hasClass('js-select2')) {
            $(selectEstado).val("").trigger('change');
            $(selectEstado).next('.select2-container').removeClass("focused");
         }
      }
   }

   // --- 1. MÁSCARA CPF / CNPJ DINÂMICA E CONSULTA OPENCNPJ ---
   const inputCpfCnpj = document.getElementById("cpf_cnpj");
   let buscandoCnpj = false;

   if (inputCpfCnpj) {
      inputCpfCnpj.addEventListener("input", function(e) {
         let value = e.target.value.replace(/\D/g, "");

         if (value.length < 14 && value.length > 11) {
            limparCamposCnpj();
         }

         if (value.length > 14) value = value.slice(0, 14);

         if (value.length <= 11) {
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
         } else {
            value = value.replace(/^(\d{2})(\d)/, "$1.$2");
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
            value = value.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
         }
         e.target.value = value;

         let valorLimpo = value.replace(/\D/g, "");
         if (valorLimpo.length === 14 && !buscandoCnpj) {
            buscandoCnpj = true;
            let urlCnpj = `https://api.opencnpj.org/${valorLimpo}`;

            fetch(urlCnpj)
               .then(response => {
                  if (!response.ok) throw new Error("CNPJ não encontrado");
                  return response.json();
               })
               .then(data => {
                  buscandoCnpj = false;
                  preencherEAtivarLabel("nome_razaosocial", data.razao_social || data.nome_fantasia, true);

                  if (data.email) {
                     preencherEAtivarLabel("email", data.email, false, true);
                  }

                  if (data.telefones && data.telefones.length > 0) {
                     let telObj = data.telefones[0];
                     let numeroCompleto = telObj.ddd + telObj.numero;
                     preencherEAtivarLabel("whatsapp", numeroCompleto);
                  }

                  if (data.cep) {
                     const inputCep = document.getElementById("cep");
                     if (inputCep) {
                        let cepFormatado = String(data.cep).padStart(8, '0');
                        let numeroTratado = data.numero ? String(parseInt(data.numero, 10)) : null;
                        if (numeroTratado === "NaN") numeroTratado = data.numero;

                        inputCep.value = cepFormatado.replace(/^(\d{5})(\d)/, "$1-$2");
                        inputCep.classList.add("focused");

                        const parentCep = inputCep.closest('.form-control-wrap') || inputCep.parentElement;
                        if (parentCep) parentCep.classList.add("focused");

                        buscarCepNoViaCep(cepFormatado, numeroTratado);
                     }
                  }
               })
               .catch(error => {
                  buscandoCnpj = false;
                  console.error("Erro ao buscar CNPJ:", error);
               });
         }
      });
   }

   // --- 2. MÁSCARA DE TELEFONES ---
   function aplicarMascaraTelefone(id) {
      const input = document.getElementById(id);
      if (!input) return;

      input.addEventListener("input", function(e) {
         let value = e.target.value.replace(/\D/g, "");
         if (value.length > 11) value = value.slice(0, 11);

         if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
         } else if (value.length > 6) {
            value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
         } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
         } else if (value.length > 0) {
            value = value.replace(/^(\d*)/, "($1");
         }
         e.target.value = value;
      });
   }

   aplicarMascaraTelefone("whatsapp");
   aplicarMascaraTelefone("celular");
   aplicarMascaraTelefone("telefone");

   // --- 3. MÁSCARA DE CEP E BUSCA AUTOMÁTICA AO COMPLETAR ---
   const inputCep = document.getElementById("cep");
   let ultimoCepBuscado = "";

   if (inputCep) {
      inputCep.addEventListener("input", function(e) {
         let value = e.target.value.replace(/\D/g, "");

         if (value.length < 8) {
            limparCamposCep();
            ultimoCepBuscado = "";
         }

         if (value.length > 8) value = value.slice(0, 8);

         if (value.length > 5) {
            value = value.replace(/^(\d{5})(\d)/, "$1-$2");
         }
         e.target.value = value;

         let cepLimpo = value.replace(/\D/g, "");
         if (cepLimpo.length === 8 && cepLimpo !== ultimoCepBuscado) {
            ultimoCepBuscado = cepLimpo;
            buscarCepNoViaCep(cepLimpo);
         }
      });

      inputCep.addEventListener("blur", function() {
         let cep = inputCep.value.replace(/\D/g, '');
         if (cep.length === 8 && cep !== ultimoCepBuscado) {
            ultimoCepBuscado = cep;
            buscarCepNoViaCep(cep);
         }
      });
   }

   // --- 4. CARREGAR ESTADOS NO SELECT ---
   const estadosBrasileiros = [
      { sigla: "AC", nome: "Acre" }, { sigla: "AL", nome: "Alagoas" },
      { sigla: "AP", nome: "Amapá" }, { sigla: "AM", nome: "Amazonas" },
      { sigla: "BA", nome: "Bahia" }, { sigla: "CE", nome: "Ceará" },
      { sigla: "DF", nome: "Distrito Federal" }, { sigla: "ES", nome: "Espírito Santo" },
      { sigla: "GO", nome: "Goiás" }, { sigla: "MA", nome: "Maranhão" },
      { sigla: "MT", nome: "Mato Grosso" }, { sigla: "MS", nome: "Mato Grosso do Sul" },
      { sigla: "MG", nome: "Minas Gerais" }, { sigla: "PA", nome: "Pará" },
      { sigla: "PB", nome: "Paraíba" }, { sigla: "PR", nome: "Paraná" },
      { sigla: "PE", nome: "Pernambuco" }, { sigla: "PI", nome: "Piauí" },
      { sigla: "RJ", nome: "Rio de Janeiro" }, { sigla: "RN", nome: "Rio Grande do Norte" },
      { sigla: "RS", nome: "Rio Grande do Sul" }, { sigla: "RO", nome: "Rondônia" },
      { sigla: "RR", nome: "Roraima" }, { sigla: "SC", nome: "Santa Catarina" },
      { sigla: "SP", nome: "São Paulo" }, { sigla: "SE", nome: "Sergipe" },
      { sigla: "TO", nome: "Tocantins" }
   ];

   const selectEstado = document.getElementById("estado");
   if (selectEstado) {
      estadosBrasileiros.forEach(est => {
         let option = document.createElement("option");
         option.value = est.sigla;
         option.textContent = est.nome;
         selectEstado.appendChild(option);
      });

      if (window.jQuery && $(selectEstado).hasClass('js-select2')) {
         $(selectEstado).trigger('change');
      }
   }

   // --- 5. FUNÇÃO CENTRALIZADA DE BUSCA VIACEP ---
   function buscarCepNoViaCep(cep, numeroEmpresa = null) {
      let url = `https://viacep.com.br/ws/${cep}/json/`;

      fetch(url)
         .then(response => response.json())
         .then(data => {
            if (!data.erro) {
               preencherEAtivarLabel("rua", data.logradouro, true);
               preencherEAtivarLabel("bairro", data.bairro, true);
               preencherEAtivarLabel("cidade", data.localidade, true);

               if (selectEstado) {
                  selectEstado.value = data.uf;
                  selectEstado.classList.add("focused");
                  selectEstado.dispatchEvent(new Event('change', { bubbles: true }));

                  if (window.jQuery && $(selectEstado).hasClass('js-select2')) {
                     $(selectEstado).val(data.uf).trigger('change');
                     $(selectEstado).next('.select2-container').addClass("focused");
                  }
               }

               if (numeroEmpresa) {
                  preencherEAtivarLabel("n_casa", numeroEmpresa);
               }

               const nCasa = document.getElementById("n_casa");
               if (nCasa) {
                  if (!numeroEmpresa) nCasa.focus();
                  nCasa.classList.add("focused");
                  const parentCasa = nCasa.closest('.form-control-wrap') || nCasa.parentElement;
                  if (parentCasa) parentCasa.classList.add("focused");
               }
            } else {
               alert("CEP não encontrado.");
               limparCamposCep();
               ultimoCepBuscado = "";
            }
         })
         .catch(error => {
            console.error("Erro ao buscar o CEP:", error);
            ultimoCepBuscado = "";
         });
   }

 // --- ATUALIZAÇÃO VIA AJAX (EDITAR CLIENTE) ---
const btnSalvar = document.getElementById("btnSalvar");

if (btnSalvar) {
   btnSalvar.addEventListener("click", function(e) {
      e.preventDefault(); // Impede o envio padrão do formulário

      const form = document.getElementById("formEditarCliente");
      let formData = new FormData(form);

      // Garante que o valor atual do select2 do estado seja coletado corretamente no FormData
      const selectEstado = document.getElementById("estado");
      if (selectEstado) {
         formData.set('estado', selectEstado.value);
      }

      btnSalvar.disabled = true;
      let htmlOriginal = btnSalvar.innerHTML;
      btnSalvar.innerHTML = '<span>Salvando alterações...</span> <em class="icon ni ni-loader spin"></em>';

      fetch("<?= base_url('clientes/atualizarCliente/' . ($cliente['id_cliente'] ?? '')) ?>", {
            method: "POST",
            headers: {
               "X-Requested-With": "XMLHttpRequest"
            },
            body: formData
         })
         .then(response => response.json())
         .then(data => {
            btnSalvar.disabled = false;
            btnSalvar.innerHTML = htmlOriginal; // Restaura o botão original

            if (data.status === "sucesso") {
               Swal.fire({
                  icon: 'success',
                  title: 'Sucesso!',
                  text: data.mensagem,
                  confirmButtonText: 'OK'
               }).then((result) => {
                  if (result.isConfirmed) {
                     // Redireciona para a página de perfil do cliente
                     window.location.href = `<?= base_url('clientes/perfil/') ?>` + (data.id_cliente || '<?= $cliente['id_cliente'] ?? '' ?>');
                  }
               });
            } else {
               Swal.fire({
                  icon: 'error',
                  title: 'Atenção!',
                  text: data.mensagem || 'Ocorreu um erro ao atualizar os dados.',
                  confirmButtonText: 'OK'
               });
            }
         })
         .catch(error => {
            btnSalvar.disabled = false;
            btnSalvar.innerHTML = htmlOriginal;
            console.error("Erro na requisição:", error);

            Swal.fire({
               icon: 'error',
               title: 'Erro Inesperado',
               text: 'Não foi possível processar a requisição no momento.',
               confirmButtonText: 'Fechar'
            });
         });
   });
}
});
</script>
<?= $this->endSection() ?>