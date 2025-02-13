<?php
require_once(dirname(__FILE__) . "../services/api_functions.php");
require_once(dirname(__FILE__) . "../services/config.php");

$results = send_request("get_all_controladores", "GET");

$controladores = $results["data"]["results"];



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
                    Sala: <b><?= $controlador["sala"] ?></b>
                </li>
                <li>
                    IP: <b><?= $controlador["ip"] ?></b>
                </li>

                <a href="./edit_controladores.php?id=<?= $controlador["id_controlador"] ?>"><button>Editar</button></ a>
                    <a
                        href="./delete_controlador.php?id=<?= $controlador["id_controlador"] ?>"><button>Apagar</button></a>
                    <a href="./enviar_comandos.php?id=<?= $controlador["id_controlador"] ?>"><button>Enviar
                            comando</button></a>

            </ul>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>

</html>