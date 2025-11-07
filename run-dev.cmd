@echo off
REM CMD helper: checks for npm and runs install + dev (run from project root)
where npm >nul 2>&1
IF ERRORLEVEL 1 (
  echo ERROR: npm not found in PATH.
  echo Install Node.js LTS: https://nodejs.org/
  exit /b 1
)

echo Running: npm install && npm run dev
npm install && npm run dev
