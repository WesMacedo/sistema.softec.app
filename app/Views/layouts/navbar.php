<div class="nk-header nk-header-fixed is-light">
   <div class="container-fluid">
      <div class="nk-header-wrap">
         <div class="nk-menu-trigger d-xl-none ms-n1">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
               <em class="icon ni ni-menu">
               </em>
            </a>
         </div>
         <div class="nk-header-app-name">
            <div class="nk-header-app-logo">
    <img src="<?= base_url('images/logo.png') ?>" alt="Logo" class="logo-svg">
</div>
             
         </div>
         <div class="nk-header-menu is-light">
            <div class="nk-header-menu-inner">
               <ul class="nk-menu nk-menu-main">
                  <li class="nk-menu-item">
                     <a href="index.html" class="nk-menu-link">
                        <span class="nk-menu-text">
                        <em class="icon ni ni-chat-msg" style="font-size: 18px;"></em>   Suporte
                        </span>
                     </a>
                  </li>
                  <li class="nk-menu-item">
                     <a href="components.html" class="nk-menu-link">
                        <span class="nk-menu-text">
                            <em class="icon ni ni-question" style="font-size: 18px;"></em> 
                           Portal do técnico
                        </span>
                     </a>
                  </li> 
               </ul>
            </div>
         </div>
         <div class="nk-header-tools">
            <ul class="nk-quick-nav">
               <li class="dropdown notification-dropdown">
                  <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                     <div class="icon-status icon-status-info">
                        <em class="icon ni ni-bell">
                        </em>
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                     <div class="dropdown-head">
                        <span class="sub-title nk-dropdown-title">
                           Notificações
                        </span> 
                     </div>
                     <div class="dropdown-body">
                        <div class="nk-notification">
                           <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-icon"> 
                                 <em class="icon ni ni-info" style="font-size:33px;"></em>
                              </div>
                              <div class="nk-notification-content">
                                 <div class="nk-notification-text">
                                     Seu teste grátis vence em 3 dias.
                                 </div>
                                 <div class="nk-notification-time">
                                    5 minutos atrás
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="dropdown-foot center">
                        <a href="#">
                           Ver todas
                        </a>
                     </div>
                  </div>
               </li>
               <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                     <div class="user-toggle">
                        <div class="user-avatar sm">
                           <em class="icon ni ni-user-alt">
                           </em>
                        </div>
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-end"> 
                     <div class="dropdown-inner">
                        <ul class="link-list"> 
                           <li>
                              <a href="user-profile-setting.html">
                                 <em class="icon ni ni-account-setting"></em>
                                 <span>
                                    Configurações da conta
                                 </span>
                              </a>
                           </li>
                           <li>
                              <a href="user-profile-activity.html">
                                 <em class="icon ni ni-timeline"></em>
                                 <span>
                                    Hitórico de acesso
                                 </span>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="dropdown-inner">
                        <ul class="link-list">
                           <li>
                              <a href="<?= base_url() ?>auth/logout">
                                 <em class="icon ni ni-signout">
                                 </em>
                                 <span>
                                    Sair
                                 </span>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>