<?php
// Inicia a sessão do usuário
session_start();
// Seta o usuário como nulo pois ainda não foi autenticado
$_SESSION['usuario'] = null;

// Inicia o processo de verificação de Login
// verifica se o formulário foi enviado com os inputs form_email e form_pass
if (isset($_POST['form_email']) && isset($_POST['form_pass'])) {

    // Inclui o arquivo de conexão com o banco de dados
    include_once __DIR__ . "/../config/connection.php";

    // Recebe as variáveis do formulário de login
    // para usar em variáveis locais e simples
    $email = $_POST['form_email'];
    $pass = $_POST['form_pass'];

    // cria o hash da senha
    $pass = md5($pass . $chave);

    // cria a query de consulta ao banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :pass";
    // prepara a query do banco de dados em PDO
    $pdo = $pdo->prepare($sql);
    // executa a query com os parâmetros
    $pdo->bindParam(":email", $email);
    $pdo->bindParam(":pass", $pass);
    // executa a query
    $pdo->execute();

    // verifica se o usuário foi encontrado
    if ($pdo->rowCount() == 1) {
        // se o usuário foi encontrado, inicia a sessão
        $resultado = $pdo->fetch(PDO::FETCH_ASSOC);
        print_r($resultado);
        if ($resultado['is_admin'] == 1) {
            $_SESSION['usuario'] = $resultado['email'];
            //  redireciona para a página de dashboard
            header("Location: dashboard.php"); // https://www.php.net/manual/function.header.php
        } else {
            $mensagem = "Você não tem permissão para acessar o painel de controle.";
        }
    } else {
        $mensagem = "Usuário ou senha inválidos.";
    }
} else {
    // $mensagem = "Preencha os campos de e-mail e senha.";
}

// inclui o header e o menu
$no_menu = true;
include_once __DIR__ . "/header_dash.php";
?>

<div class="container-fluid bg bg-gradient bg-primary py-5 d-flex justify-content-center align-items-center" style="min-height:100vh">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 text-light">
            <h1>Administrador</h1>
            <p>Seja bem vindo ao painel de controle do site.</p>
            <?php
            echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
            ?>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <!-- inclui o formulário de login -->
                <form action="" method="post">
                    <div>
                        <label for="email" class="form-label w-100">
                            <!-- inclui o input de e-mail -->
                            <input class="form-control " type="email" name="form_email" placeholder="digite seu e-mail" id="email">
                        </label>
                    </div>
                    <div>
                        <label for="password" class="form-label w-100">
                            <!-- inclui o input de senha -->
                            <input class="form-control" type="password" name="form_pass" placeholder="digite sua senha" id="password">
                        </label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- inclui o input de botão de envio do formulário -->
                        <input type="submit" class="btn btn-success" value="Entrar">
                    </div>
                    <div class="text-center">
                        <a href="cadastrousuario.php" class="d-block mt-3 fz-8 text-reset">Não possui uma conta?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . "/footer_dash.php";
?>