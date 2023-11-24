<?php
include __DIR__ . "/header.php";
?>


<?php

if (isset($_POST["nome"]) && $_POST['nome'] != "") {
    $nome = $_POST["nome"];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];


}


?>
<main>
    <div class="container-fluid py-5 bg-primary bg-gradient">
        <h1 class="text-center text-light">Fale conosco</h1>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <form action="" method="post">
                    <div>
                        <label for="form_nome" class="form-label">Digite o seu nome</label>
                        <input id="form_nome" type="text" placeholder="Nome completo" name="nome" class="form-control"
                            required>
                    </div>
                    <div class="mt-3">
                        <label for="form_email" class="form-label">Digite o seu e-mail</label>
                        <input id="form_email" type="email" placeholder="eu@examepl.com" name="email"
                            class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="form_telefone" class="form-label">Digite o seu telefone</label>
                        <input id="form_telefone" type="text" placeholder="DDD + Completo" name="telefone"
                            class="form-control" required>
                    </div>
                    <div class="mt-3">
                        <label for="form_mensagem" class="form-label">Mensagem</label>
                        <textarea id="form_telefone" name="mensagem" class="form-control"></textarea>
                    </div>
                    <div class="">
                        <input type="submit" class="btn btn-primary mt-3" value="Enviar contato">
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <ul>
                    <li>e-mail: contato@maravilhoso.com.br</li>
                    <li>telefone: 47 30 30 30 30 </li>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php
include __DIR__ . "/footer.php";
?>