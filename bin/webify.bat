@echo off

rem -------------------------------------------------------------
rem  WebifyCMS command line bootstrap script for Windows.
rem
rem  The file is part of the "webifycms/app", WebifyCMS application.
rem
rem  @see https://webifycms.com/
rem
rem  @copyright Copyright (c) 2023 WebifyCMS
rem  @license https://webifycms.com/license
rem  @author Mohammed Shifreen <mshifreen@gmail.com>
rem -------------------------------------------------------------

@setlocal

set WEBIFY_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" "%WEBIFY_PATH%webify" %*

@endlocal
