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
$titulo = "Painel de Controle - Listar Usários";
include_once __DIR__ . "/header_dash.php";
// inclui o arquivo de conexão com o banco de dados
include_once __DIR__ . "/../config/connection.php";


if (isset($_POST['senha1'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    if ($_POST['senha1'] != $_POST['senha2']) {
        $mensagem = "As senhas não conferem";
    }
    if (isset($_POST['is_admin'])) {
        $isAdmin = $_POST['is_admin'][0];
    }
    if (isset($_POST['idUsu'])) {
        $idUsu = $_POST['idUsu'];
        if ($_POST['senha1'] != "") {
            $senha = md5($_POST['senha1'] . $chave);
            
            $sql = "UPDATE usuarios SET senha = '$senha', is_admin = '$isAdmin' WHERE idUsu = '$idUsu'";
        } else {
            $sql = "UPDATE usuarios SET is_admin = '$isAdmin' WHERE idUsu = '$idUsu'";
        }
        $resultado = $pdo->query($sql);
        if ($resultado) {
            $mensagem = "Usuário atualizado com sucesso";
        } else {
            $mensagem = "Erro ao atualizar o usuário";
        }
    }
}


?>

<div class="container p-3">
    <div class="row">
        <div class="col-md-6">
            <h3>Listar usuário</h3>
            <p>Explicação sobre a listagem de usuários</p>
            <?php
            // condicional ternário
            echo (isset($mensagem)) ? "<p class='alert alert-secondary'>$mensagem</p>" : "";
            ?>
        </div>
        <div class="col-md-6">

            <ul class="list-group">
                <!-- Começo a listagem -->
                <?php
                // cria a query de consulta ao banco de dados
                $sql = "SELECT * FROM usuarios";
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
                    foreach ($resultado as $usuario) :
                ?>
                        <!-- inicio do looping -->
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <!-- Título do item -->
                            <div class="ms-2 me-auto">
                                <div><?php echo $usuario['email']; ?></div>
                                <div>
                                    <?php
                                    if ($usuario['is_admin']) {
                                        echo 'Administrador';
                                    } else {
                                        echo 'Usuário comum';
                                    }

                                    ?>
                                </div>
                            </div>
                            <!-- sistema de botões -->
                            <ul class="list-inline m-0">
                                <!-- Editar -->
                                <li class="list-inline-item">
                                    <a href="edit_noticia.php?idNot=<?php echo $usuario['idUsu']; ?>" class="btn btn-success btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#modal_admin" data-placement="top" title="Edit" data-id-do-usuario="<?php echo $usuario['idUsu']; ?>" data-email-do-usuario="<?php echo $usuario['email']; ?>" data-is-admin="<?php echo (($usuario['is_admin']) == 1) ? 1 : 0; ?>"><i class="bi bi-pencil"></i></a>
                                </li>
                                <!-- Excluir -->
                                <li class="list-inline-item">
                                    <a href="delete_usuario.php?idUsu=<?php echo $usuario['idUsu']; ?>" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></a>
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


        <!-- Modal -->
        <div class="modal fade" id="modal_admin" tabindex="-1" aria-labelledby="modal_admin" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_admin_title">Modal title</h5>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form_editar_usuario">
                            <div class="">
                                <input type="hidden" name="idUsu" id="idUsu">

                                <div>
                                    <input type="radio" name="is_admin[]" id="is_admin" value="1">
                                    <label for="is_admin">Administrador</label>
                                    <input type="radio" name="is_admin[]" id="is_not_admin" value="0">
                                    <label for="is_admin">Usuário comum</label>
                                </div>

                                <label class="form-label" for="senha1">Digite uma nova senha</label>
                                <input class="form-control" type="password" name="senha1" placeholder="Digite sua senha" id="senha1">
                                <label class="form-label" for="senha1">Repita sua senha</label>
                                <input class="form-control" type="password" name="senha2" placeholder="Repita sua senha" id="senha2">
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="botao_salvar" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var modal = document.getElementById('modal_admin');
            var botaoSalvar = document.getElementById('botao_salvar');
            var formEditarUsuario = document.getElementById('form_editar_usuario');

            botaoSalvar.addEventListener("click", function(e) {
                e.preventDefault();
                var senha1 = document.getElementById('senha1');
                var senha2 = document.getElementById('senha2');
                if (senha1.value != senha2.value) {
                    alert("As senhas não conferem");
                    return false;
                }
                var formIsAdmin = document.getElementById('is_admin');

                formEditarUsuario.submit();

            })


            modal.addEventListener("show.bs.modal", function(e) {
                console.log(e);
                var quemMeChamou = e.relatedTarget;
                console.log("quem te chamou foi:", quemMeChamou);
                // possui um data-bs-idusuario
                var titulo = document.getElementById('modal_admin_title');
                var idUsuario = quemMeChamou.dataset.idDoUsuario;
                // email-do-usuario
                var emailDoUsuario = quemMeChamou.dataset.emailDoUsuario;
                var isAdmin = quemMeChamou.dataset.isAdmin;
                titulo.innerText = "Editar Usuário " + emailDoUsuario;
                var inputIsAdmin = document.getElementById('is_admin');
                var inputIdUsuario = document.getElementById('idUsu');
                inputIdUsuario.value = idUsuario;

                var check_is_admin = document.getElementById('is_admin');
                var check_is_not_admin = document.getElementById('is_not_admin');
                if (isAdmin == 1) {
                    check_is_admin.checked = true;
                } else {
                    check_is_not_admin.checked = true;
                }

            })
        </script>

    </div>
    <?php
    include __DIR__ . "/footer_dash.php";
