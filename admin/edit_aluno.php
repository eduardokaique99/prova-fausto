<?php
@session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$titulo = "Editar Aluno";
include_once __DIR__ . "/header_dash.php";
include_once __DIR__ . "/../config/connection.php";

// verifica se o id da notícia foi enviado
if (isset($_GET['idAluno'])) {
    // recebe o id da notícia
    $idNot = $_GET['idAluno'];
} else {
    // se não foi enviado, redireciona para a página de listagem
    header("Location: aluno.php");
    exit();
}
// recebe o id da notícia
$idNot = $_GET['idAluno'];

/* Atualização da notícia */
// verifica se os dados foram enviados
if (isset($_POST['form_titulo']) && isset($_POST['form_texto']) && isset($_POST['id'])) {
    // recebe os dados do formulário
    $id = $_POST['id'];
    $titulo = $_POST['form_titulo'];
    $texto = $_POST['form_texto'];
    // cria a query de atualização
    $sql = "UPDATE noticias SET titulo = '$titulo', conteudo = '$texto' WHERE id = $id";
    // executa a query
    $pdo->query($sql);
    // prepara a mensagem de sucesso
    $mensagem = "Aluno atualizada com sucesso!";
}

// cria a query de consulta da notícia
$sql = "SELECT * FROM alunos WHERE id = $idAluno";
// executa a query
$resultado = $pdo->query($sql);
// transforma o resultado em um array associativo
$resultado = $resultado->fetch(PDO::FETCH_ASSOC);

?>
<div class="container p-3">
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>Editar Aluno</h3>
                <p>A página de adicionar notícia é uma ferramenta que permite aos usuários criar e publicar notícias em um site. Nesta página, o usuário pode inserir o título, o conteúdo da notícia. O usuário também pode visualizar a notícia antes de publicá-la ou salvá-la como rascunho. A página de adicionar notícia facilita a comunicação e a divulgação de informações relevantes para o público-alvo do site.</p>
                <?php
                // exibe a mensagem de sucesso usando o operador ternário
                echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
                ?>
            </div>
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <!-- cria um input oculto com o id da notícia -->
                        <input type="hidden" name="id" value="<?php echo (isset($resultado['id'])) ? $resultado['id'] : "" ?>">
                        <label for="titulo" class="form-label w-100">
                            <!-- exibe o input do título da notícia -->
                            <input class="form-control" type="text" name="form_titulo" placeholder="Título da notícia" id="titulo" value="<?php echo $resultado['titulo']; ?>">
                        </label>
                    </div>
                    <div>
                        <label for="texto" class="form-label w-100">
                            <!-- exibe o textarea do conteúdo da notícia  -->
                            <textarea class="form-control" name="form_texto" id="texto" cols="30" rows="10" placeholder="Texto da notícia"><?php echo $resultado['conteudo']; ?></textarea>
                        </label>
                    </div>
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