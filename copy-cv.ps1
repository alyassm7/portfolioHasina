$src = "c:\Users\Hasina\Downloads\CV Ralison Hasiniaina Aimée Samuëla.pdf"
$dstDir = Join-Path $PSScriptRoot "storage\app\public\cv"
$dst = Join-Path $dstDir "CV-Hasina-Samuela.pdf"

if (-not (Test-Path -LiteralPath $src)) {
    Write-Error "Fichier introuvable : $src"
    exit 1
}

New-Item -ItemType Directory -Path $dstDir -Force | Out-Null
Copy-Item -LiteralPath $src -Destination $dst -Force

Write-Host "CV copié vers : $dst"
Write-Host "Taille : $((Get-Item $dst).Length) octets"
Write-Host ""
Write-Host "Ensuite, exécutez :"
Write-Host "  php artisan db:seed"
Write-Host "  php artisan storage:link"
Write-Host "  php artisan cache:clear"
