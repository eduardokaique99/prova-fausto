<?php
// inicia a sessão em PHP
@session_start();
// verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // se não estiver logado, redireciona para a página de login
    header("Location: index.php");
    // encerra o script
    exit();
}

// define o título da página
$titulo = "Painel de Controle - Listar Disciplina";
include_once __DIR__ . "/header_dash.php";
// inclui o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../config/connection.php";
?>

<div class="container p-3">
    <div class="row">
        <div class="col-md-6">
            <h3>Listar notícias</h3>
            <p>Explicação sobre a listagem de disciplinas</p>
            <?php
            // condicional ternário
            echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
            ?>
        </div>
        <div class="col-md-6">

            <ul class="list-group list-group-numbered">
                <!-- Começo a listagem -->
                <?php
                // cria a query de consulta ao banco de dados
                $sql = "SELECT * FROM disciplinas";
                // executa a consulta e armazena o resultado em 
                $resultado = $pdo->query($sql);
                // verifica se houve resultados
                // note que aqui estamos usando o if e else com :
                if ($resultado->rowCount() > 0) :
                    // transforma o resultado em um array associativo
                    $resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    // percorre o array associativo com o foreach
                    // note que aqui estamos usando o foreach com :
                    // com isto vamos precisar usar endforeach; no final
                    foreach ($resultado as $disciplina) :
                ?>
                        <!-- inicio do looping -->
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <!-- Título do item -->
                            <div class="ms-2 me-auto">
                                <?php echo $disciplina['titulo']; ?>
                            </div>
                            <!-- sistema de botões -->
                            <ul class="list-inline m-0">
                                <!-- Editar -->
                                <li class="list-inline-item">
                                    <a href="edit_noticia.php?idNot=<?php echo $disciplina['id']; ?>" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="bi bi-pencil"></i></a>
                                </li>
                                <!-- Excluir -->
                                <li class="list-inline-item">
                                    <a href="delete_noticia.php?idNot=<?php echo $disciplina['id']; ?>" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
                                </li>
                            </ul>
                        </li>
                        <!-- fim do looping -->
                <?php
                    // finaliza o foreach inicado com ":"
                    endforeach;

                // note que aqui estamos usando o else do if com ":" e endif; no final
                else :
                    echo "<li class='list-group-item d-flex justify-content-between align-items-start'>";
                    echo "<div class='ms-2 me-auto'>";
                    echo "<div class='fw-bold'>Nenhuma notícia cadastrada</div>";
                    echo "</div>";
                    echo "</li>";
                endif;
                ?>
            </ul>
        </div>
    </div>
    <?php
    include __DIR__ . "/footer_dash.php";