<?php

// insere o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../config/connection.php";

// verifica se o id da notícia foi enviado
if (isset($_GET['idDisc'])) {
    // recebe o id da notícia
    $idNot = $_GET['idDisc'];
    // cria a query de exclusão
    $sql = "DELETE FROM disciplinas WHERE id  = '$idDisc'";
    // executa a query
    $result = $pdo->query($sql);
    // verifica se a exclusão foi realizada com sucesso
    if ($result) {
        header("Location: list_disciplina.php");
    }
}