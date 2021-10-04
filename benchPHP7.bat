

pushd %~dp0
set "PHP=%CD%\bin\php-7.4.24-Win32-vc15-x64"
set "PHP2=%CD%\bin\php-7.4.24-Win32-vc15-x64\ext"
Set "PATH=%PHP%;%PHP2%"

php -c %~dp0php.ini %~dp0bench.php 
pause