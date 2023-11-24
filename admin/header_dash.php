<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- exibe o título da página  -->
    <title>
        <?php
        // verifica se a variável $titulo foi definida antes do include deste arquivo
        echo (isset($titulo)) ? $titulo : "Painel";
        ?>
    </title>
    <!-- inclui o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- inclui o CSS do Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- inclui o javascript do bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- inclui o css compilado pelo SCSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <?php
    // inclui o menu
    if (!isset($no_menu))
        include_once __DIR__ . "/menu.php";
    ?>