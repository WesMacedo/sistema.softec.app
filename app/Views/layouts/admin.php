<!DOCTYPE html>
<html lang="">
 
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softec">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Softec</title>
    <link rel="stylesheet" href="assets/css/dashlite9b70.css">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme9b70.css">
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar ">  
    <div class="nk-app-root">
        <div class="nk-main "> 
            <div class="nk-wrap "> 
                <?= $this->include('layouts/navbar') ?>
                <?= $this->include('layouts/sidebar') ?>
                <div class="nk-content "> 
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    </div>

        <!-- Footer -->
        <?= $this->include('layouts/footer') ?>
        </div>
    </div> 
    
  
    <script src="assets/js/bundle9b70.js"></script>
    <script src="assets/js/scripts9b70.js"></script>
    <script src="assets/js/demo-settings9b70.js"></script>
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => {
                    console.log('Service Worker registrado com sucesso:', reg.scope);
                })
                .catch(err => {
                    console.log('Falha ao registrar o Service Worker:', err);
                });
        });
    }
</script>
</body> 

</html>