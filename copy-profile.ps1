$dstDir = Join-Path $PSScriptRoot "public\images"
$dst = Join-Path $dstDir "profile.png"

$sources = @(
    "C:\Users\Hasina\Downloads\profile.png",
    "C:\Users\Hasina\Downloads\hasina.png",
    "C:\Users\Hasina\Downloads\photo.png",
    "C:\Users\Hasina\Desktop\hasina\profile.png",
    "C:\Users\Hasina\.cursor\projects\c-Users-Hasina-Desktop-hasina-portfoliohasina\assets\c__Users_Hasina_AppData_Roaming_Cursor_User_workspaceStorage_71edfb5b80614b9fef57df5530ddbe75_images_has-3dba7005-a5cf-4235-9924-40ee45ca2c27.png"
)

$src = $null
foreach ($candidate in $sources) {
    if (Test-Path -LiteralPath $candidate) {
        $src = $candidate
        break
    }
}

if (-not $src) {
    Write-Error "Photo introuvable."
    Write-Host "Copiez votre photo manuellement vers : $dst"
    exit 1
}

New-Item -ItemType Directory -Path $dstDir -Force | Out-Null
Copy-Item -LiteralPath $src -Destination $dst -Force

Write-Host "Photo copiée depuis : $src"
Write-Host "Destination       : $dst"
Write-Host ""
Write-Host "Ensuite exécutez :"
Write-Host "  php artisan tinker --execute=""App\Models\Setting::set('about_photo', 'images/profile.png');"""
Write-Host "  php artisan cache:clear"
