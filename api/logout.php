<?php

require_once __DIR__ . "/../class/auth.php";

// Remove o cookie de autenticação.
authLogout();

header("Location: /login.php");
exit;