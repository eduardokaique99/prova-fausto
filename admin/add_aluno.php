<?php
// inicia sessão do usuário
@session_start();
// verifica se o usuário está logado
(!isset($_SESSION['usuario'])) ? (header("Location: index.php") && exit())  : "";

// verifica se os campos foram preenchidos e se o formulário foi enviado
if (isset($_POST['form_idAluno']) && isset($_POST['form_nome'])) {

    // inclui o arquivo de conexão com o banco de dados
    include_once __DIR__ . "/../config/connection.php";

    // recebe os valores do formulário em variáveis locais
    $idAluno = $_POST['form_idAluno'];
    $nome = $_POST['form_nome'];


    // Gabarito da tabela (id, titulo, data, conteudo)
    // cria a query de inserção no banco de dados
    $sql = "INSERT INTO alunos (idAluno, nome) VALUES (:idAluno, :nome)";
    // prepara a query para ser executada
    $pdo = $pdo->prepare($sql);
    // substitui os parâmetros da query
    $pdo->bindParam(":idAluno", $idAluno);
    $pdo->bindParam(":nome", $nome);
    // executa a query
    $pdo->execute();
    // verifica se a query foi executada com sucesso
    if ($pdo->rowCount() == 1) {
        $mensagem = "Aluno inserido com sucesso!";
    } else {
        $mensagem = "Erro ao inserir aluno!";
    }
}

// troca o título da página
$titulo = "Adicionar Aluno";
include_once __DIR__ . "/header_dash.php";
?>
<div class="container p-3">
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>Adicionar Aluno</h3>
                <p>A página de adicionar aluno é uma ferramenta que permite aos usuários criar ealunos em um site. Nesta página, o usuário pode inserir o id e o nome do aluno. </p>
                <?php
                echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
                ?>
            </div>
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="idAluno" class="form-label w-100">
                            <!-- inclui o input de título -->
                            <input class="form-control" type="text" name="form_titulo" placeholder="ID do aluno" id="idAluno">
                        </label>
                    </div>
                    <div>
                        <label for="nome" class="form-label w-100">
                            <!-- inclui o textarea de texto -->
                            <input class="form-control" type="text" name="form_nome" placeholder="Nome do aluno" id="nome">
                        </label>
                    </div>
                    <!-- inclui o botão de enviar -->
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
// inclui o footer do painel de controle
include_once __DIR__ . "/footer_dash.php";
?>