<?php
include __DIR__ . "/header.php";
?>

<main>
    <div class="container-fluid bg-gradient bg-primary py-5">
        <h1 class="text-center text-light">Professores</h1>
    </div>
    <div class="container py-5">
        <div class="row">
            <?php

            include_once __DIR__ . "/config/connection.php";


            $sql = "SELECT * FROM professores";
            $resultado = $pdo->query($sql);

            if ($resultado->rowCount() > 0) {

                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo 'ID: '; ?>
                                    <?php echo $row['idProf']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo 'Nome: '; ?>
                                    <?php echo $row['nome'] ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php
                }


            } else {
                echo "Não encontramos professores, que tristeza";
            }



            ?>
        </div>
    </div>
</main>

<?php
include __DIR__ . "/footer.php";
?>