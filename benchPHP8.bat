

pushd %~dp0
set "PHP=%CD%\bin\php-8.0.11-Win32-vs16-x64"
set "PHP2=%CD%\bin\php-8.0.11-Win32-vs16-x64\ext"
Set "PATH=%PHP%;%PHP2%"

php -c %~dp0php.ini %~dp0bench.php 
pause