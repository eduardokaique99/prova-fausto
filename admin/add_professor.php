<?php
// inicia sessão do usuário
@session_start();
// verifica se o usuário está logado
(!isset($_SESSION['usuario'])) ? (header("Location: index.php") && exit())  : "";

// verifica se os campos foram preenchidos e se o formulário foi enviado
if (isset($_POST['form_titulo']) && isset($_POST['form_texto'])) {

    // inclui o arquivo de conexão com o banco de dados
    include_once __DIR__ . "/../config/connection.php";

    // recebe os valores do formulário em variáveis locais
    $titulo = $_POST['form_titulo'];
    $texto = $_POST['form_texto'];
    $data_hoje = date("Y-m-d H:i:s");

    // Gabarito da tabela (id, titulo, data, conteudo)
    // cria a query de inserção no banco de dados
    $sql = "INSERT INTO noticias (titulo, data, conteudo) VALUES (:titulo, :data, :conteudo)";
    // prepara a query para ser executada
    $pdo = $pdo->prepare($sql);
    // substitui os parâmetros da query
    $pdo->bindParam(":titulo", $titulo);
    $pdo->bindParam(":data", $data_hoje);
    $pdo->bindParam(":conteudo", $texto);
    // executa a query
    $pdo->execute();
    // verifica se a query foi executada com sucesso
    if ($pdo->rowCount() == 1) {
        $mensagem = "Professor inserida com sucesso!";
    } else {
        $mensagem = "Erro ao inserir professor!";
    }
}

// troca o título da página
$titulo = "Adicionar Professor";
include_once __DIR__ . "/header_dash.php";
?>
<div class="container p-3">
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>Adicionar Professor</h3>
                <p>A página de adicionar notícia é uma ferramenta que permite aos usuários criar e publicar notícias em um site. Nesta página, o usuário pode inserir o título, o conteúdo da notícia. O usuário também pode visualizar a notícia antes de publicá-la ou salvá-la como rascunho. A página de adicionar notícia facilita a comunicação e a divulgação de informações relevantes para o público-alvo do site.</p>
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
                            <input class="form-control" type="text" name="form_titulo" placeholder="Título da notícia" id="titulo">
                        </label>
                    </div>
                    <div>
                        <label for="texto" class="form-label w-100">
                            <!-- inclui o textarea de texto -->
                            <textarea class="form-control" name="form_texto" id="texto" cols="30" rows="10" placeholder="Texto da notícia"></textarea>
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