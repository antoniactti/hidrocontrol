<?php

// ==================================================
// 1. INICIALIZAÇÃO DA SESSÃO
// ==================================================

// Permite acessar e manipular os dados da sessão.
session_start();

// ==================================================
// 2. VERIFICAÇÃO DE AUTENTICAÇÃO
// ==================================================

// Redireciona usuários autenticados para o painel.
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: index.php");
    exit;
}

// Inicializa a mensagem de erro.
$mensagemErro = "";

// ==================================================
// 3. PROCESSAMENTO DO FORMULÁRIO
// ==================================================

// Verifica se o formulário foi enviado pelo método POST.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtém os dados enviados e evita campos inexistentes.
    $matricula = trim($_POST['matricula'] ?? "");
    $senha = $_POST['senha'] ?? "";

    // Credenciais fictícias para fins didáticos.
    // Em um sistema real, os dados viriam de um banco de dados.
    $matriculaValida = "1025";
    $senhaValida = "123456";

    // Verifica se os campos foram preenchidos corretamente.
    if ($matricula !== "" && $senha !== "") {

        // Compara os dados informados com as credenciais simuladas.
        if (
            $matricula === $matriculaValida
            && $senha === $senhaValida
        ) {

            // Gera um novo identificador para a sessão autenticada.
            session_regenerate_id(true);

            // Registra a autenticação do usuário.
            $_SESSION['logado'] = true;

            // Armazena o nome exibido no painel.
            $_SESSION['nome_usuario'] = "Carlos";

            // Redireciona para o painel de monitoramento.
            header("Location: index.php");
            exit;

        } else {

            // Informa que as credenciais não correspondem.
            $mensagemErro = "Matrícula ou senha incorretos. Tente novamente.";
        }

    } else {

        // Informa que os campos são obrigatórios.
        $mensagemErro = "Preencha a matrícula e a senha.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <!-- Define a codificação dos caracteres. -->
    <meta charset="UTF-8">

    <!-- Adapta a página aos dispositivos móveis. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Define o título da página de login. -->
    <title>HidroControl | Login</title>

    <!-- Importa o arquivo de estilos. -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Define o ícone da página. -->
    <link rel="icon" type="image/png" href="src/icon.png">

</head>

<body class="body-login">

    <!-- ==================================================
         ESTRUTURA PRINCIPAL DO LOGIN
    =================================================== -->

    <div class="login-container">

        <!-- ==================================================
             ÁREA DO FORMULÁRIO
        =================================================== -->

        <div class="login-form-area">

            <!-- Logo e identificação institucional. -->
            <div class="login-header">

                <img
                    src="src/logo.png"
                    alt="Logo HidroControl"
                    width="150"
                >

                <span class="badge-scada">
                    SENAI CTTI
                </span>

            </div>

            <!-- Apresentação da página. -->
            <h1>Bem-vindo ao HidroControl</h1>

            <p>
                Acesse o painel de monitoramento da usina.
            </p>

            <!-- Formulário de autenticação. -->
            <form action="login.php" method="POST" class="form-login">

                <!-- Exibe a mensagem quando ocorre um erro. -->
                <?php if ($mensagemErro !== ""): ?>

                    <div
                        role="alert"
                        style="color: #c62828; background-color: #ffebee; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px;"
                    >
                        <?= htmlspecialchars(
                            $mensagemErro,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </div>

                <?php endif; ?>

                <!-- Campo para informar a matrícula. -->
                <label for="matricula">
                    Matrícula do operador
                </label>

                <input
                    type="text"
                    id="matricula"
                    name="matricula"
                    placeholder="Usuário fornecido previamente"
                    autocomplete="username"
                    required
                >

                <!-- Campo para informar a senha. -->
                <label for="senha">
                    Senha de autenticação
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    autocomplete="current-password"
                    required
                >

                <!-- Aviso sobre o acesso ao sistema. -->
                <div class="aviso-seguranca">

                    <p>
                        Acesso destinado exclusivamente a operadores autorizados.
                        Todas as sessões são auditadas.
                    </p>

                </div>

                <!-- Envia as credenciais para validação. -->
                <button type="submit" class="btn-login">
                    Entrar no sistema
                </button>

            </form>

        </div>

        <!-- ==================================================
             ÁREA VISUAL
        =================================================== -->

        <div class="login-image-area">

            <div class="info-overlay">

                <h2>
                    Eficiência energética e segurança operacional em tempo real.
                </h2>

                <p>
                    Supervisão contínua de turbinas Francis, comportas
                    vertedouras e sincronismo de fase para despacho
                    estável à rede nacional.
                </p>

            </div>

        </div>

    </div>

</body>

</html>