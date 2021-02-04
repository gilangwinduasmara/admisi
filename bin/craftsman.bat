@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/craftsman/cli/craftsman
php "%BIN_TARGET%" %*
