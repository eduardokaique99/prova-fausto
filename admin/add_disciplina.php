<?php
// inicia sessão do usuário
@session_start();
// verifica se o usuário está logado
(!isset($_SESSION['usuario'])) ? (header("Location: index.php") && exit())  : "";

// verifica se os campos foram preenchidos e se o formulário foi enviado
if (isset($_POST['form_idDisc']) && isset($_POST['form_nome']) && isset($_POST['form_carga'])) {

    // inclui o arquivo de conexão com o banco de dados
    include_once __DIR__ . "/../config/connection.php";

    // recebe os valores do formulário em variáveis locais
    $idDisc = $_POST['form_idDisc'];
    $nome = $_POST['form_nome'];
    $carga = date("form_carga");

    // Gabarito da tabela (id, titulo, data, conteudo)
    // cria a query de inserção no banco de dados
    $sql = "INSERT INTO disciplinas (idDisc, nome, carga) VALUES (:idDisc, :nome, :carga)";
    // prepara a query para ser executada
    $pdo = $pdo->prepare($sql);
    // substitui os parâmetros da query
    $pdo->bindParam(":idDisc", $idDisc);
    $pdo->bindParam(":nome", $nome);
    $pdo->bindParam(":carga", $carga);
    // executa a query
    $pdo->execute();
    // verifica se a query foi executada com sucesso
    if ($pdo->rowCount() == 1) {
        $mensagem = "Disciplina inserida com sucesso!";
    } else {
        $mensagem = "Erro ao inserir disciplina!";
    }
}

// troca o título da página
$titulo = "Adicionar Disciplina";
include_once __DIR__ . "/header_dash.php";
?>
<div class="container p-3">
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>Adicionar Disciplina</h3>
                <p>A página de adicionar disciplina é uma ferramenta que permite aos usuários criar e publicar disciplinas em um site. Nesta página, o usuário pode inserir o id, o nome e a carga horaria. A página de adicionar disciplina facilita a comunicação e a divulgação de informações relevantes para o público-alvo do site.</p>
                <?php
                // exibe a mensagem de sucesso ou erro usando o operador ternário
                echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
                ?>
            </div>
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="titulo" class="form-label w-100">
                            <!-- inclui o input de título -->
                            <input class="form-control" type="text" name="form_id" placeholder="ID da disciplina" id="idDisc">
                        </label>
                    </div>
                    <div>
                        <label for="texto" class="form-label w-100">
                            <!-- inclui o textarea de texto -->
                            <input class="form-control" type="text" name="form_nome" placeholder="Nome da disciplina" id="nome">
                        </label>
                    </div>
                    <div>
                        <label for="texto" class="form-label w-100">
                            <!-- inclui o textarea de texto -->
                            <input class="form-control" type="text" name="form_carga" placeholder="Carga horaria" id="carga">
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