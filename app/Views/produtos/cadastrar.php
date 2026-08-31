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
                           <h4 class="nk-block-title"><em class="icon ni ni-user-add"></em> Cadastrar cliente</h4>
                           <div class="nk-block-des">
                              <p>Cadastrar novo cliente no sistema</p>
                           </div>
                        </div>
                        <div class="card-tools">
                           <a href="<?= base_url('clientes') ?>" class="btn btn-outline-light btn-white"><em
                                 class="icon ni ni-arrow-left"></em><span>Voltar</span> </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-bordered card-preview">
                  <div class="card-inner">
                     <div class="row gy-4"><span class="preview-title overline-title" id="campos_obrigatorios">Campos
                           marcados com * são
                           obrigatórios.</span>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="cpf_cnpj"><label
                                    class="form-label-outlined" for="">CPF / CNPJ</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="nome_razaosocial"><label
                                    class="form-label-outlined" for="">Nome / Razão social *</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="insc_municipal"><label
                                    class="form-label-outlined" for="">Insc. municipal</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="insc_estadual"><label
                                    class="form-label-outlined" for="">Insc. estadual</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="email"><label
                                    class="form-label-outlined" for="">Email</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="whatsapp"><label
                                    class="form-label-outlined" for="">WhatsApp *</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="celular"><label
                                    class="form-label-outlined" for="">Celular</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="telefone"><label
                                    class="form-label-outlined" for="">Telefone</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <hr class="preview-hr">
                     <div class="row gy-3">
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="cep"><label
                                    class="form-label-outlined" for="">CEP</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="rua"><label
                                    class="form-label-outlined" for="">Rua</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-1 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="n_casa"><label
                                    class="form-label-outlined" for="">N°</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="bairro"><label
                                    class="form-label-outlined" for="">Bairro</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><input type="text"
                                    class="form-control form-control-outlined" id="cidade"><label
                                    class="form-label-outlined" for="">Cidade</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                           <div class="form-group">
                              <div class="form-control-wrap"><select class="form-select js-select2" id="estado">
                                    <option value="">Selecione o Estado</option>
                                    <!-- Os estados serão carregados via JS aqui -->
                                 </select></div>
                           </div>
                        </div>

                     </div>

                  </div>
                  <div class="card-footer bg-lighter border-top d-flex align-center justify-content-end py-3">
                     <button type="button" class="btn btn-primary" id="btnSalvar"><span>Finalizar cadastro
                        </span></button>
                  </div>
               </div>
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

         campo.dispatchEvent(new Event('input', {
            bubbles: true
         }));
         campo.dispatchEvent(new Event('change', {
            bubbles: true
         }));
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
         selectEstado.dispatchEvent(new Event('change', {
            bubbles: true
         }));

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

         // SÓ LIMPA SE ESTIVER APAGANDO UM CNPJ (tamanho entre 12 e 13 dígitos)
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

                        // TRATAMENTO DO NÚMERO: Remove o zero à esquerda se houver
                        let numeroTratado = data.numero ? String(parseInt(data.numero, 10)) : null;
                        if (numeroTratado === "NaN") numeroTratado = data.numero; // Fallback caso venha algo não numérico

                        inputCep.value = cepFormatado.replace(/^(\d{5})(\d)/, "$1-$2");
                        inputCep.classList.add("focused");

                        const parentCep = inputCep.closest('.form-control-wrap') || inputCep.parentElement;
                        if (parentCep) parentCep.classList.add("focused");

                        // Passa o número já tratado para a função do ViaCEP
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
   const estadosBrasileiros = [{
         sigla: "AC",
         nome: "Acre"
      }, {
         sigla: "AL",
         nome: "Alagoas"
      },
      {
         sigla: "AP",
         nome: "Amapá"
      }, {
         sigla: "AM",
         nome: "Amazonas"
      },
      {
         sigla: "BA",
         nome: "Bahia"
      }, {
         sigla: "CE",
         nome: "Ceará"
      },
      {
         sigla: "DF",
         nome: "Distrito Federal"
      }, {
         sigla: "ES",
         nome: "Espírito Santo"
      },
      {
         sigla: "GO",
         nome: "Goiás"
      }, {
         sigla: "MA",
         nome: "Maranhão"
      },
      {
         sigla: "MT",
         nome: "Mato Grosso"
      }, {
         sigla: "MS",
         nome: "Mato Grosso do Sul"
      },
      {
         sigla: "MG",
         nome: "Minas Gerais"
      }, {
         sigla: "PA",
         nome: "Pará"
      },
      {
         sigla: "PB",
         nome: "Paraíba"
      }, {
         sigla: "PR",
         nome: "Paraná"
      },
      {
         sigla: "PE",
         nome: "Pernambuco"
      }, {
         sigla: "PI",
         nome: "Piauí"
      },
      {
         sigla: "RJ",
         nome: "Rio de Janeiro"
      }, {
         sigla: "RN",
         nome: "Rio Grande do Norte"
      },
      {
         sigla: "RS",
         nome: "Rio Grande do Sul"
      }, {
         sigla: "RO",
         nome: "Rondônia"
      },
      {
         sigla: "RR",
         nome: "Roraima"
      }, {
         sigla: "SC",
         nome: "Santa Catarina"
      },
      {
         sigla: "SP",
         nome: "São Paulo"
      }, {
         sigla: "SE",
         nome: "Sergipe"
      },
      {
         sigla: "TO",
         nome: "Tocantins"
      }
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
                  selectEstado.dispatchEvent(new Event('change', {
                     bubbles: true
                  }));

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

   // --- 6. CADASTRO VIA AJAX (COM SWEETALERT2) ---
   const btnSalvar = document.getElementById("btnSalvar");

   if (btnSalvar) {
      btnSalvar.addEventListener("click", function(e) {
         e.preventDefault(); // Impede qualquer recarregamento da página

         const campos = [
            "cpf_cnpj", "nome_razaosocial", "insc_municipal", "insc_estadual",
            "email", "whatsapp", "celular", "telefone", "cep", "rua",
            "n_casa", "bairro", "cidade", "estado"
         ];

         let formData = new FormData();
         campos.forEach(id => {
            const elemento = document.getElementById(id);
            if (elemento) {
               formData.append(id, elemento.value);
            }
         });

         btnSalvar.disabled = true;
         let htmlOriginal = btnSalvar.innerHTML;
         btnSalvar.innerHTML = '<span>Salvando dados...</span> <em class="icon ni ni-loader spin"></em>';

         fetch("<?= base_url('clientes/salvar') ?>", {
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
                  // Exibe o alerta na tela atual e só redireciona APÓS clicar em OK
                  Swal.fire({
                     icon: 'success',
                     title: 'Sucesso!',
                     text: data.mensagem,
                     confirmButtonText: 'OK'
                  }).then((result) => {
                     if (result.isConfirmed) {
                        // Redireciona para a página de perfil usando o ID retornado pelo PHP
                        window.location.href = `<?= base_url('clientes/perfil/') ?>` + data.id_cliente;
                     }
                  });

               } else {
                  Swal.fire({
                     icon: 'error',
                     title: 'Atenção!',
                     text: data.mensagem || 'Ocorreu um erro ao salvar os dados.',
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