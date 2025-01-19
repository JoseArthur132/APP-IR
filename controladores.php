<?php
require_once(dirname(__FILE__) . "../services/api_functions.php");
require_once(dirname(__FILE__) . "../services/config.php");

$results = send_request("get_all_controladores", "GET");

$controladores = $results["data"]["results"];

if (isset($_POST["id"])) {
    $id = ["id" => $_POST["id"]];
    $results = send_request("delete_controlador", "POST", $id);

    // echo "<pre>";
    // print_r($results);
    // die(1);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controladores</title>
    <link rel="stylesheet" href="./css/nav.css">
</head>

<body>
    <?php include("./partials/nav.php"); ?>

    <div>
        <section>
            <h1>Controladores</h1>
        </section>
        <section>
            <a href="./novo_controlador.php"><button>Adicionar Controlador</button></a>
        </section>
    </div>

    <hr>

    <ul>
        <?php
        if (count($controladores) == 0):
        ?>
            <p>Não há controladores registrados</p>
        <?php else: ?>
            <?php foreach ($controladores as $controlador): ?>
                <li>
                    <ul>
                        <li>
                            Sala:<?= $controlador["sala"] ?>
                        </li>
                        <li>
                            IP: <?= $controlador["ip"] ?>
                        </li>
                        <form action="" method="post">
                            <input type="hidden" name="id" value=<?= $controlador["id"] ?>>
                            <input type="submit" value="Deletar">
                        </form>
                    </ul>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>

</html>