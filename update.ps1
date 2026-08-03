# =========================================================
# SOFTEC - Deploy Tool
# Deploy PowerShell com Forcar Commit
# =========================================================

function Write-ColoredMessage {
    param([string]$Message, [string]$Color = 'White', [string]$BgColor = 'Black')
    $origFG = $Host.UI.RawUI.ForegroundColor
    $origBG = $Host.UI.RawUI.BackgroundColor
    $Host.UI.RawUI.ForegroundColor = $Color
    $Host.UI.RawUI.BackgroundColor = $BgColor
    Write-Host $Message
    $Host.UI.RawUI.ForegroundColor = $origFG
    $Host.UI.RawUI.BackgroundColor = $origBG
}

function Show-Step {
    param([string]$Message, [string]$Status)
    switch ($Status) {
        'ok'    { Write-ColoredMessage " [OK] $Message" 'Green' }
        'error' { Write-ColoredMessage " [X] $Message" 'Red' }
        default { Write-ColoredMessage " [...] $Message" 'Yellow' }
    }
}

Clear-Host

# -------------------- CONFIGURACAO --------------------
$GitHubRepo = "https://github.com/WesMacedo/sistema.softec.app.git"
$IP = "147.93.147.27"
$ServerPath = "/www/wwwroot/sistema.softec.app" 
$URL = "https://sistema.softec.app"
$Branch = "master"
# -------------------------------------------------------

# -------------------- CABECALHO -----------------------
Write-ColoredMessage ' ____   ___  _____ _____ _____ ____  ' 'Cyan'
Write-ColoredMessage '/ ___| / _ \|  ___|_   _| ____/ ___| ' 'Cyan'
Write-ColoredMessage '\___ \| | | | |_    | | |  _|| |     ' 'Cyan'
Write-ColoredMessage ' ___) | |_| |  _|   | | | |__| |___  ' 'Cyan'
Write-ColoredMessage '|____/ \___/|_|     |_| |_____\____| ' 'Cyan'
Write-ColoredMessage '# Auto Deploy, desenvolvido por: Wesley ' 'Cyan'

Write-Host ""
Write-ColoredMessage "URL      : $URL" 'Yellow'
Write-ColoredMessage "GitHub   : $GitHubRepo ($Branch)" 'Yellow'
Write-ColoredMessage "Servidor : ${IP}:${ServerPath}" 'Yellow'
Write-Host ""
# -------------------------------------------------------

# -------------------- MENU DE OPCOES --------------------
Write-ColoredMessage "Escolha uma opcao:" 'Magenta'
Write-ColoredMessage "1 - Deploy completo (commit + push + pull VPS)" 'Cyan'
Write-ColoredMessage "2 - Apenas commit e push no GitHub" 'Cyan'
Write-ColoredMessage "3 - Apenas atualizar servidor VPS" 'Cyan'
Write-ColoredMessage "4 - Forcar deploy completo (commit vazio + pull VPS)" 'Cyan'
Write-ColoredMessage "5 - Sair" 'Cyan'
$option = Read-Host "Digite o numero da opcao"

switch ($option) {
    '1' {
        $deployGit = $true
        $deployVPS = $true
        $forceDeploy = $false
    }
    '2' {
        $deployGit = $true
        $deployVPS = $false
        $forceDeploy = $false
    }
    '3' {
        $deployGit = $false
        $deployVPS = $true
        $forceDeploy = $false
    }
    '4' {
        $deployGit = $true
        $deployVPS = $true
        $forceDeploy = $true
    }
    '5' {
        Write-ColoredMessage "Saindo..." 'Red'
        exit
    }
    default {
        Write-ColoredMessage "Opcao invalida. Saindo..." 'Red'
        exit
    }
}
# -------------------------------------------------------

# -------------------- DETECCAO DE MUDANCAS --------------------
if ($deployGit) {
    $changes = git status --short
    if (-not $changes -and -not $forceDeploy) {
        Write-ColoredMessage "Nenhuma mudanca local detectada. Pulando commit e push..." 'Magenta'
    } else {
        if (-not $changes -and $forceDeploy) {
            Write-ColoredMessage "Forcando commit vazio..." 'Yellow'
            $commitMessage = "Commit forcado em $(Get-Date -Format 'dd/MM/yyyy HH:mm')"
            git commit --allow-empty -m "$commitMessage"
        } else {
            Write-ColoredMessage "Alteracoes locais detectadas:" 'Magenta'
            Write-Host $changes
            $defaultMessage = "Atualizacao em $(Get-Date -Format 'dd/MM/yyyy HH:mm')"
            $commitMessage = Read-Host "Digite a mensagem do commit (Enter = padrao)"
            if ([string]::IsNullOrWhiteSpace($commitMessage)) { $commitMessage = $defaultMessage }
            git add .
            git commit -m "$commitMessage"
        }

        Show-Step "Enviando alteracoes para o GitHub..." "..."
        git push origin $Branch
        if ($LASTEXITCODE -ne 0) { Show-Step "Erro ao enviar para GitHub." "error"; exit }
        Show-Step "GitHub atualizado com sucesso!" "ok"
    }
}

# -------------------- ATUALIZACAO DO SERVIDO --------------------
if ($deployVPS) {
    Show-Step "Atualizando servidor VPS..." "..."
    ssh root@$IP "cd $ServerPath ; git pull origin $Branch"
    if ($LASTEXITCODE -ne 0) { Show-Step "Erro ao atualizar o servidor." "error"; exit }
    Show-Step "Servidor atualizado com sucesso!" "ok"
}

# -------------------- FINAL --------------------
Write-ColoredMessage "=========================================" 'Cyan'
Write-ColoredMessage "           Deploy concluido!             " 'Green'
Write-ColoredMessage "URL: $URL" 'Cyan'
Write-ColoredMessage "=========================================" 'Cyan'