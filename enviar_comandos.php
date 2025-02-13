<?php
include_once("./services/api_functions.php");
include_once("./services/functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $results = send_request("get_dispositivo", "GET", ["id" => $_POST["id_dispositivo"]]);

    $dispositivo = $results["data"]["results"][0];

    if ($dispositivo["marca"] === "EPSON" || $dispositivo["marca"] === "Elgin") {
        $marca = "01";
    } else if ($dispositivo["marca"] === "HUTLER") {
        $marca = "02";
    }

    if ($dispositivo["tipo"] === "Projetor") {
        $tipo = "02";
    } else if ($dispositivo["tipo"] === "Ar-condicionado") {
        $tipo = "01";
    }

    if ($_POST["comando"] === "Ligar") {
        $comando = "01";
    } else if ($_POST["comando"]  === "Desligar") {
        $comando = "02";
    } else if ($_POST["comando"]  === "20") {
        $comando = "20";
    } else if ($_POST["comando"]  === "22") {
        $comando = "22";
    } else if ($_POST["comando"]  === "25") {
        $comando = "25";
    }

    $data = "?" . $marca . "_" . $tipo . "_" . $comando . "!";

    send_command($dispositivo["ip"], $data);

    header("location: enviar_comandos.php?id=" . $dispositivo["controlador_responsavel"] . "&command_send=true");
    exit;
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $results = send_request("get_controlador", "GET", ["id" => $id]);

    $controlador = $results["data"]["results"][0];

    $results = send_request("get_dispositivos_in_controlador", "GET", ["id" => $id]);

    $dispositivos = $results["data"]["results"];
}
// echo "<pre>";
// print_r($controlador);
// die(1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlador</title>
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/enviar_comando.css">
</head>

<body>

    <?php include("./partials/nav.php"); ?>
    <?php if (isset($_GET["command_send"]) && $_GET["command_send"] == "true"): ?>
        <div class="success_message">Comando enviado!</div>
    <?php endif; ?>

    <?php if (count($dispositivos) > 0): ?>
        <ul>
            <?php foreach ($dispositivos as $dispositivo): ?>

                <li>
                    <div class="dispositivo">
                        <div class="info">
                            <h3><?= $dispositivo["tipo"] ?></h3>
                            <h3><?= $dispositivo["marca"] ?></h3>
                        </div>
                        <form action="" method="POST">

                            <input type="hidden" name="id_dispositivo" value=<?= $dispositivo["id_dispositivo"] ?>>
                            <?php if ($dispositivo["tipo"] === "Projetor"): ?>
                                <button value="Ligar" name="comando">Ligar</button>
                                <button value="Desligar" name="comando">Desligar</button>
                            <?php elseif ($dispositivo["tipo"] === "Ar-condicionado"): ?>
                                <button value="Ligar" name="comando">Ligar</button>
                                <button value="Desligar" name="comando">Desligar</button>
                                <button value="22" name="comando">Temperatura 22</button>
                                <button value="20" name="comando">Temperatura 20</button>
                                <button value="25" name="comando">Temperatura 25</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div>Este controlador não é responsável por nenhum dispositivo</div>
    <?php endif; ?>
</body>

</html>