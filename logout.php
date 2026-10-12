<?php

// ==================================================
// ENCERRAMENTO DA SESSÃO
// ==================================================

// Inicia ou recupera a sessão atual.
session_start();

// Remove os dados armazenados na sessão.
$_SESSION = [];

// Destrói a sessão atual.
session_destroy();

// Redireciona o usuário para a tela de login.
header("Location: login.php");
exit;