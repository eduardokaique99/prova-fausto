<?php

// insere o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../config/connection.php";

// verifica se o id do usuário foi enviado
if (isset($_GET['idUsu'])) {
    // recebe o id do usuário
    $idUsu = $_GET['idUsu'];
    // cria a query de exclusão
    $sql = "DELETE FROM usuarios WHERE idUsu  = '$idUsu'";
    // executa a query
    $result = $pdo->query($sql);
    // verifica se a exclusão foi realizada com sucesso
    if ($result) {
        header("Location: list_usuarios.php");
    }
}
