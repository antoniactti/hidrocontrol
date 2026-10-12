<?php

// ==================================================
// 1. CONTROLE DE ACESSO
// ==================================================

require_once __DIR__ . "/../class/auth.php";

$nomeUsuario = authUsuario();

// Impede o acesso ao painel sem login válido.
if ($nomeUsuario === null) {
    header("Location: /login.php");
    exit;
}

// ==================================================
// 2. CARREGAMENTO DAS CLASSES
// ==================================================

require_once __DIR__ . "/../class/operadorclass.php";
require_once __DIR__ . "/../class/turbinaclass.php";
require_once __DIR__ . "/../class/usinaclass.php";

// ==================================================
// 3. CRIAÇÃO DOS OPERADORES
// ==================================================

// Cria os operadores responsáveis pelas turbinas.
$operadoraMariaAntonia = new Operador(
    "Maria Antonia",
    "1025",
    "Operadora de sala de controle"
);

$operadoraMariaClara = new Operador(
    "Maria Clara",
    "2048",
    "Técnica de operação"
);

// ==================================================
// 4. SIMULAÇÃO DOS INDICADORES OPERACIONAIS
// ==================================================

// Gera valores ilustrativos a cada carregamento do painel.
$nivelReservatorio = (float) random_int(20, 100);
$vazao = (float) random_int(80, 150);

// Calcula uma potência ilustrativa para fins didáticos.
$potenciaGerada = round($vazao * 0.7, 1);

// Simula as temperaturas das três turbinas.
$temperatura1 = (float) random_int(55, 95);
$temperatura2 = (float) random_int(55, 95);
$temperatura3 = (float) random_int(55, 95);

// ==================================================
// 5. CRIAÇÃO DAS TURBINAS
// ==================================================

// Instancia cada turbina com seus dados e responsável.
$turbina1 = new Turbina(
    "Turbina 1",
    $temperatura1,
    true,
    $operadoraMariaAntonia
);

$turbina2 = new Turbina(
    "Turbina 2",
    $temperatura2,
    true,
    $operadoraMariaClara
);

$turbina3 = new Turbina(
    "Turbina 3",
    $temperatura3,
    true,
    $operadoraMariaAntonia
);

// Agrupa as turbinas para facilitar a interação.
$turbinas = [$turbina1, $turbina2, $turbina3];

// ==================================================
// 6. CRIAÇÃO DA USINA
// ==================================================

// Reúne os indicadores e as turbinas em um único objeto.
$usina = new Usina(
    "HidroControl Central",
    $nivelReservatorio,
    $vazao,
    $potenciaGerada,
    $turbinas
);

// ==================================================
// 7. CLASSIFICAÇÃO DO RESERVATÓRIO
// ==================================================

// Obtém a situação atual do nível do reservatório.
$situacaoNivel = $usina->verificarNivel();

// Define a classe CSS de acordo com a situação.
if ($situacaoNivel === "NÍVEL NORMAL") {
    $classeNivel = "normal";
} elseif ($situacaoNivel === "NÍVEL BAIXO") {
    $classeNivel = "atencao";
} else {
    $classeNivel = "critico";
}

// ==================================================
// 8. PREPARAÇÃO DOS ALERTAS
// ==================================================

// Armazena os alertas identificados no monitoramento.
$alertas = [];

// Cria um alerta quando o reservatório está baixo.
if ($situacaoNivel === "NÍVEL BAIXO") {
    $alertas[] = [
        "tipo" => $classeNivel,
        "titulo" => "Nível do reservatório baixo",
        "mensagem" => "O nível está abaixo de 30%. Verifique as condições do reservatório."
    ];
}

// Cria um alerta quando o reservatório está alto.
elseif ($situacaoNivel === "NÍVEL ALTO") {
    $alertas[] = [
        "tipo" => $classeNivel,
        "titulo" => "Nível do reservatório alto",
        "mensagem" => "O nível está acima de 90%. Verifique as condições operacionais."
    ];
}

// Verifica a situação térmica de todas as turbinas.
foreach ($turbinas as $turbina) {

    // Obtém a classificação térmica da turbina.
    $situacaoTermica = $turbina->verificarTemperaturaTurbina();

    // Identifica temperaturas críticas.
    if (str_starts_with($situacaoTermica, "CRÍTICA")) {

        $alertas[] = [
            "tipo" => "critico",
            "titulo" => "Temperatura crítica - "
                . $turbina->getNomeTurbina(),
            "mensagem" => "Temperatura acima do limite recomendado. "
                . "Verifique as condições operacionais e avalie "
                . "a necessidade de desligamento preventivo."
        ];

    // Identifica temperaturas que exigem atenção.
    } elseif (str_starts_with($situacaoTermica, "ATENÇÃO")) {

        $alertas[] = [
            "tipo" => "atencao",
            "titulo" => "Temperatura elevada - "
                . $turbina->getNomeTurbina(),
            "mensagem" => "A temperatura está elevada. "
                . "Acompanhe as condições operacionais da turbina."
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Define a codificação dos caracteres. -->
    <meta charset="UTF-8">

    <!-- Adapta o layout à largura do dispositivo. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Define o título da página. -->
    <title>HidroControl | Painel de Monitoramento</title>

    <!-- Importa a biblioteca de ícones. -->
    <link
        rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/4.0.0/uicons-solid-straight/css/uicons-solid-straight.css"
    >

    <!-- Importa o arquivo de estilos do projeto. -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Define o ícone da página. -->
    <link rel="icon" type="image/png" href="src/icon.png">
</head>

<body class="body-painel">

    <!-- ==================================================
         CABEÇALHO E NAVEGAÇÃO
    =================================================== -->

    <header class="cabecalho">

        <!-- Logo do sistema. -->
        <div class="logo">
            <img src="src/logo.png" alt="Logo do HidroControl">
        </div>

        <!-- Menu principal. -->
        <nav class="menu" aria-label="Menu principal">
            <a href="index.php" class="menu-navegacao">
                Painel
            </a>
        </nav>

        <!-- Identificação do usuário e opção de saída. -->
        <div class="usuario">

            <div class="perfil" aria-label="Perfil do usuário">

                <!-- Ícone vetorial do perfil. -->
                <svg
                    viewBox="0 0 24 24"
                    width="26"
                    height="26"
                    fill="currentColor"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21v-2a8 8 0 0 1 16 0v2z"/>
                </svg>

            </div>

            <!-- Encerra a sessão do usuário. -->
            <a href="logout.php" class="link-sair">
                Sair
            </a>

        </div>

    </header>

    <!-- ==================================================
         CONTEÚDO PRINCIPAL
    =================================================== -->

    <main>

        <!-- Apresentação inicial do painel. -->
        <section class="boas-vindas">

            <h1>
                Bem-vindo,
                <span id="nome-usuario">
                    <?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8') ?>
                </span>!
            </h1>

            <p>
                Confira as condições operacionais da Usina SENAI.
            </p>

        </section>

        <!-- ==================================================
             INDICADORES GERAIS DA USINA
        =================================================== -->

        <section id="indicadores">

            <h2>Visão geral da usina</h2>

            <div class="cards-container">

                <!-- Indicador do nível do reservatório. -->
                <div class="card-indicador">

                    <h3>
                        <i class="fi fi-ss-water" aria-hidden="true"></i>
                        Nível do reservatório
                    </h3>

                    <p>
                        <?= $usina->getNivelReservatorio() ?>%
                    </p>

                    <span class="situacao-nivel <?= $classeNivel ?>">
                        <?= htmlspecialchars($situacaoNivel, ENT_QUOTES, 'UTF-8') ?>
                    </span>

                </div>

                <!-- Indicador da vazão de água. -->
                <div class="card-indicador">

                    <h3>
                        <i class="fi fi-ss-arrows" aria-hidden="true"></i>
                        Vazão de água
                    </h3>

                    <p>
                        <?= $usina->getVazao() ?> m³/s
                    </p>

                </div>

                <!-- Indicador da potência gerada. -->
                <div class="card-indicador">

                    <h3>
                        <i class="fi fi-ss-bolt" aria-hidden="true"></i>
                        Potência gerada
                    </h3>

                    <p>
                        <?= $usina->getPotenciaGerada() ?> MW
                    </p>

                </div>

            </div>

        </section>

        <!-- ==================================================
             MONITORAMENTO INDIVIDUAL DAS TURBINAS
        =================================================== -->

        <section id="turbinas">

            <h2>Monitoramento das turbinas</h2>

            <div class="cards-container">

                <!-- Percorre a coleção e exibe cada turbina. -->
                <?php foreach ($turbinas as $turbina): ?>

                    <?php
                    // Obtém a classificação térmica da turbina.
                    $situacaoTermica = $turbina->verificarTemperaturaTurbina();

                    // Define a classe visual correspondente.
                    if (str_starts_with($situacaoTermica, "CRÍTICA")) {
                        $classeTermica = "critico";
                    } elseif (str_starts_with($situacaoTermica, "ATENÇÃO")) {
                        $classeTermica = "atencao";
                    } else {
                        $classeTermica = "normal";
                    }
                    ?>

                    <div class="card-indicador">

                        <!-- Nome da turbina monitorada. -->
                        <h3>
                            <?= htmlspecialchars(
                                $turbina->getNomeTurbina(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </h3>

                        <!-- Temperatura registrada na simulação. -->
                        <p>
                            <i
                                class="fi fi-ss-thermometer-half"
                                aria-hidden="true"
                            ></i>

                            <?= $turbina->getTemperaturaTurbina() ?> °C
                        </p>

                        <!-- Situação térmica da turbina. -->
                        <span class="situacao-termica <?= $classeTermica ?>">
                            <strong>Situação térmica:</strong>

                            <?= htmlspecialchars(
                                $situacaoTermica,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </span>

                        <!-- Estado operacional da turbina. -->
                        <p class="texto-estado-e-operador">
                            Estado:
                            <?= htmlspecialchars(
                                $turbina->verificarEstadoTurbina(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                        <!-- Operador responsável pela turbina. -->
                        <p class="texto-estado-e-operador">
                            Operador:
                            <?= htmlspecialchars(
                                $turbina->getOperadorResponsavel(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

        <!-- ==================================================
             CENTRAL DE ALERTAS
        =================================================== -->

        <section id="alertas">

            <h2>Central de alertas</h2>

            <!-- Informa quando nenhuma condição de alerta foi encontrada. -->
            <?php if (empty($alertas)): ?>

                <div class="card-alerta sem-alertas">

                    <strong>Nenhum alerta operacional.</strong>

                    <p>
                        Não foram identificadas condições de alerta nesta leitura.
                    </p>

                </div>

            <?php else: ?>

                <div class="lista-alertas">

                    <!-- Exibe cada alerta identificado. -->
                    <?php foreach ($alertas as $alerta): ?>

                        <div class="card-alerta <?= $alerta['tipo'] ?>">

                            <h3>
                                <?= htmlspecialchars(
                                    $alerta['titulo'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    $alerta['mensagem'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </p>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </section>

    </main>

    <!-- ==================================================
         RODAPÉ
    =================================================== -->

    <footer>
        <p>
            &copy; 2026 HidroControl — Painel de monitoramento
        </p>
    </footer>

</body>

</html>