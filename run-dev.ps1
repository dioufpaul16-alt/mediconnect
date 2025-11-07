# PowerShell helper: checks for npm and runs `npm install` then `npm run dev` (use from project root)
$npm = Get-Command npm -ErrorAction SilentlyContinue
if (-not $npm) {
    Write-Host "ERROR: npm not found in PATH." -ForegroundColor Red
    Write-Host "Install Node.js LTS and re-run. Options:" -ForegroundColor Yellow
    Write-Host " - winget install OpenJS.NodeJS.LTS"
    Write-Host " - choco install nodejs-lts -y  (requires Chocolatey and admin)"
    Write-Host " - Download from https://nodejs.org/ (Windows installer)"
    Write-Host "You can also run the script with the 'check-auth' argument to verify Breeze/auth status." -ForegroundColor Cyan
    if ($args -and ($args[0] -ieq 'check-auth' -or $args[0] -ieq 'finish-breeze')) {
        # continue to check auth or allow finish-breeze to proceed even if npm is missing
    } else {
        exit 1
    }
}

# Only run the default install+build when no action argument is provided
if (-not ($args -and ($args[0] -ieq 'check-auth' -or $args[0] -ieq 'finish-breeze' -or $args[0] -ieq 'verify'))) {
    Write-Host "Running: npm install" -ForegroundColor Cyan
    npm install
    if ($LASTEXITCODE -ne 0) {
        Write-Host "npm install failed with exit code $LASTEXITCODE" -ForegroundColor Red
        exit $LASTEXITCODE
    }

    Write-Host "Running: npm run dev" -ForegroundColor Cyan
    npm run dev
    if ($LASTEXITCODE -ne 0) {
        Write-Host "npm run dev failed with exit code $LASTEXITCODE" -ForegroundColor Red
    } else {
        Write-Host "Asset build completed successfully." -ForegroundColor Green
    }
    # continue so script can also handle other actions if invoked later
}

# Added: simple Breeze / auth status checker
function Check-AuthStatus {
    Write-Host "Checking Laravel Breeze / authentication scaffolding status..." -ForegroundColor Cyan

    # Check composer presence
    $composer = Get-Command composer -ErrorAction SilentlyContinue
    if (-not $composer) {
        Write-Host "WARNING: composer not found in PATH. You will not be able to verify composer packages." -ForegroundColor Yellow
    } else {
        # Check if laravel/breeze is installed in vendor or via composer show
        $breezeInstalled = $false
        try {
            & composer show laravel/breeze 2>$null | Out-Null
            if ($LASTEXITCODE -eq 0) { $breezeInstalled = $true }
        } catch {}
        if (-not $breezeInstalled) {
            if (Test-Path (Join-Path $PSScriptRoot 'vendor\laravel\breeze')) { $breezeInstalled = $true }
        }
        Write-Host "Laravel Breeze installed (vendor or composer): $breezeInstalled"
    }

    # Check for common Breeze artifacts
    $routesAuth = Test-Path (Join-Path $PSScriptRoot 'routes\auth.php')
    $viewsAuthDir = Test-Path (Join-Path $PSScriptRoot 'resources\views\auth')
    $loginView = Test-Path (Join-Path $PSScriptRoot 'resources\views\auth\login.blade.php')
    Write-Host "routes/auth.php present: $routesAuth"
    Write-Host "resources/views/auth directory present: $viewsAuthDir"
    Write-Host "resources/views/auth/login.blade.php present: $loginView"

    # Check for auth routes via artisan (if php and artisan available)
    $php = Get-Command php -ErrorAction SilentlyContinue
    if ($php) {
        $artisan = Join-Path $PSScriptRoot 'artisan'
        if (Test-Path $artisan) {
            $authRoutes = & php artisan route:list --name=login --no-ansi 2>$null
            if ($LASTEXITCODE -eq 0 -and $authRoutes) {
                Write-Host "Auth route 'login' found in route:list" -ForegroundColor Green
            } else {
                Write-Host "Auth 'login' route not found via artisan route:list (may require breeze:install or route caching cleared)" -ForegroundColor Yellow
            }
        } else {
            Write-Host "artisan not found in project root; cannot inspect routes." -ForegroundColor Yellow
        }
    } else {
        Write-Host "php not found in PATH; cannot run artisan to check routes." -ForegroundColor Yellow
    }

    Write-Host ""
    Write-Host "Recommendations to finish Breeze-based auth:"
    Write-Host "1) Ensure composer has Breeze: composer require laravel/breeze --dev  (or run composer update after editing composer.json)."
    Write-Host "2) Run the installer: php artisan breeze:install blade"
    Write-Host "3) Run migrations: php artisan migrate"
    Write-Host "4) Install Node and build assets: npm install && npm run dev"
    Write-Host "After these steps, confirm composer show laravel/breeze and php artisan route:list show auth routes." -ForegroundColor Cyan
}

# New: Finish-Breeze helper to complete Breeze setup (install, migrate, build assets)
function Finish-Breeze {
    Write-Host "Starting Breeze setup: composer => breeze:install => migrate => npm build" -ForegroundColor Cyan

    $projectRoot = $PSScriptRoot
    $composer = Get-Command composer -ErrorAction SilentlyContinue
    $php = Get-Command php -ErrorAction SilentlyContinue

    # Ensure composer/breeze
    $breezeInstalled = $false
    if ($composer) {
        try {
            & composer show laravel/breeze 2>$null | Out-Null
            if ($LASTEXITCODE -eq 0) { $breezeInstalled = $true }
        } catch {}
        if (-not $breezeInstalled) {
            Write-Host "Laravel Breeze not found via composer. Installing laravel/breeze --dev..." -ForegroundColor Yellow
            & composer require laravel/breeze --dev
            if ($LASTEXITCODE -ne 0) {
                Write-Host "composer require failed. Aborting Breeze setup." -ForegroundColor Red
                return
            }
            $breezeInstalled = $true
        } else {
            Write-Host "Laravel Breeze already present." -ForegroundColor Green
        }
    } else {
        Write-Host "composer not found; skipping composer-based Breeze install. Ensure package is installed manually." -ForegroundColor Yellow
    }

    # Run breeze installer
    if ($php) {
        Write-Host "Running: php artisan breeze:install blade" -ForegroundColor Cyan
        & php artisan breeze:install blade --no-interaction
        if ($LASTEXITCODE -ne 0) {
            Write-Host "breeze:install failed or returned non-zero exit code." -ForegroundColor Red
            # continue to next steps if appropriate
        }
    } else {
        Write-Host "php not found; cannot run artisan to install Breeze." -ForegroundColor Yellow
    }

    # Ensure APP_KEY
    $envPath = Join-Path $projectRoot '.env'
    $appKeyMissing = $true
    if (Test-Path $envPath) {
        $envContent = Get-Content $envPath -Raw
        if ($envContent -match 'APP_KEY=.+') { $appKeyMissing = $false }
    }
    if ($php -and $appKeyMissing) {
        Write-Host "Generating application key: php artisan key:generate" -ForegroundColor Cyan
        & php artisan key:generate
    }

    # Run migrations
    if ($php) {
        Write-Host "Running migrations: php artisan migrate --force" -ForegroundColor Cyan
        & php artisan migrate --force
        if ($LASTEXITCODE -ne 0) {
            Write-Host "Migrations failed. Check DB connection and .env settings." -ForegroundColor Red
        }
    }

    # Build frontend assets if npm available
    if (Get-Command npm -ErrorAction SilentlyContinue) {
        Write-Host "Installing Node dependencies and building assets..." -ForegroundColor Cyan
        npm install
        if ($LASTEXITCODE -ne 0) {
            Write-Host "npm install failed." -ForegroundColor Red
        } else {
            npm run dev
            if ($LASTEXITCODE -ne 0) {
                Write-Host "npm run dev failed." -ForegroundColor Red
            }
        }
    } else {
        Write-Host "npm not found; skip asset build. Install Node and run 'npm install' and 'npm run dev' manually." -ForegroundColor Yellow
    }

    Write-Host "`nBreeze setup complete (or attempted)." -ForegroundColor Green
    Write-Host "Next manual steps & verification:" -ForegroundColor Cyan
    Write-Host " - Create an admin user via the register route or a seeder (php artisan tinker or create a seeder)." -ForegroundColor Cyan
    Write-Host " - Verify routes: php artisan route:list | findstr /i login" -ForegroundColor Cyan
    Write-Host " - Visit /login to test authentication." -ForegroundColor Cyan
    Write-Host "If anything failed, re-run .\run-dev.ps1 check-auth to inspect status." -ForegroundColor Cyan
}

# New: Verify-BreezeSetup - confirm Breeze, auth routes, login view, and compiled assets
function Verify-BreezeSetup {
    Write-Host "Verifying Breeze/auth and compiled assets..." -ForegroundColor Cyan

    $projectRoot = $PSScriptRoot
    $composer = Get-Command composer -ErrorAction SilentlyContinue
    $php = Get-Command php -ErrorAction SilentlyContinue

    # Breeze via composer
    $breezeInstalled = $false
    if ($composer) {
        try {
            & composer show laravel/breeze 2>$null | Out-Null
            if ($LASTEXITCODE -eq 0) { $breezeInstalled = $true }
        } catch {}
    }
    if (-not $breezeInstalled) {
        if (Test-Path (Join-Path $projectRoot 'vendor\laravel\breeze')) { $breezeInstalled = $true }
    }
    Write-Host "Laravel Breeze installed: $breezeInstalled"

    # Views / login
    $loginView = Test-Path (Join-Path $projectRoot 'resources\views\auth\login.blade.php')
    Write-Host "resources/views/auth/login.blade.php present: $loginView"

    # Routes: check using artisan if possible
    $loginRouteFound = $false
    if ($php -and (Test-Path (Join-Path $projectRoot 'artisan'))) {
        $routes = & php artisan route:list --no-ansi 2>$null
        if ($LASTEXITCODE -eq 0 -and $routes) {
            if ($routes -match '\s+login\s+' -or $routes -match 'login') { $loginRouteFound = $true }
        }
    } else {
        Write-Host "Warning: php/artisan not available; skipping route list check." -ForegroundColor Yellow
    }
    Write-Host "Auth 'login' route present: $loginRouteFound"

    # Assets: check public files and mix-manifest
    $mixManifest = Test-Path (Join-Path $projectRoot 'public\mix-manifest.json')
    $jsApp = Test-Path (Join-Path $projectRoot 'public\js\app.js')
    $cssApp = Test-Path (Join-Path $projectRoot 'public\css\app.css')
    Write-Host "public/mix-manifest.json present: $mixManifest"
    Write-Host "public/js/app.js present: $jsApp"
    Write-Host "public/css/app.css present: $cssApp"

    # Summary
    $allGood = $breezeInstalled -and $loginView -and ($loginRouteFound -or -not $php) -and ($mixManifest -or ($jsApp -and $cssApp))
    if ($allGood) {
        Write-Host "`nVerification: OK — Breeze/auth and assets appear to be in place." -ForegroundColor Green
    } else {
        Write-Host "`nVerification: Some checks failed or could not be performed. See above messages." -ForegroundColor Yellow
        Write-Host "If composer/php are missing from PATH, open a new terminal with proper PATH and re-run checks." -ForegroundColor Cyan
        Write-Host "Useful commands:" -ForegroundColor Cyan
        Write-Host " - composer show laravel/breeze"
        Write-Host " - php artisan route:list | findstr /i login"
        Write-Host " - dir public\js public\css public\mix-manifest.json"
    }
}

# If script invoked with 'check-auth', run the checker and exit
if ($args -and $args[0] -ieq 'check-auth') {
    Check-AuthStatus
    exit 0
}

# If script invoked with 'finish-breeze', run Finish-Breeze and exit
if ($args -and $args[0] -ieq 'finish-breeze') {
    Finish-Breeze
    exit 0
}

# If script invoked with 'verify', run verifier and exit
if ($args -and $args[0] -ieq 'verify') {
    Verify-BreezeSetup
    exit 0
}
