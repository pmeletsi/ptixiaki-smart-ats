@echo off
setlocal

if exist "%~dp0mailpit.exe" (
    echo Starting Mailpit from %~dp0mailpit.exe
    start "Mailpit" "%~dp0mailpit.exe"
    echo.
    echo Mailpit should now be launching.
    echo Open http://127.0.0.1:8000 in your browser.
    echo SMTP server will listen on 127.0.0.1:1025.
) else (
    echo Mailpit executable not found in this folder.
    echo.
    echo Download Mailpit for Windows from:
    echo https://github.com/mailpit/mailpit/releases
    echo.
    echo After downloading, place mailpit.exe next to this mailpit.bat
    echo and run this file again.
)
endlocal
