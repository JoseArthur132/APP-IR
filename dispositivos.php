<?php
require_once(dirname(__FILE__) . "../services/api_functions.php");
require_once(dirname(__FILE__) . "../services/config.php");

$results = send_request("get_all_dispositivos", "GET");

$dispositivos = $results["data"]["results"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
    <link rel="stylesheet" href="./css/nav.css">
</head>

<body>
    <?php include("./partials/nav.php"); ?>

    <div>
        <section>
            <h1>Dispositivos</h1>
        </section>
        <section>
            <a href="./novo_dispositivo.php"><button>Adicionar Dispositivos</button></a>
        </section>
    </div>

    <hr>

    <ul>
        <?php
        if (count($dispositivos) == 0):
        ?>
            <p>Não há dispositivos registradas</p>
        <?php else: ?>
            <?php foreach ($dispositivos as $dispositivos): ?>
                <li>
                    <ul>
                        <li>
                            Marca: <?= $dispositivos["marca"] ?>
                        </li>
                        <li>
                            Tipo: <?= $dispositivos["tipo"] ?>
                        </li>
                        <a href="#"><button>Deletar</button></a>
                    </ul>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>

</html>