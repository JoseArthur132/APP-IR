<?php
require_once(dirname(__FILE__) . "../services/api_functions.php");
require_once(dirname(__FILE__) . "../services/config.php");

$id = $_GET["id"];
$results = send_request("get_controlador", "GET", ["id" => $id]);

$controlador = $results["data"]["results"][0];

if (isset($_GET["confirm"]) && $_GET["confirm"] == "true") {
    $results = send_request("delete_controlador", "GET", ["id" => $id]);

    header("location: controladores.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlador</title>
</head>

<body>
    <div>
        <div>
            <h3>Tem certeza que deseja excluir o controlador da sala <b><?= $controlador["sala"] ?></b></h3>
            <p>Caso exclua este controlador todos os dispositivos associados também serão apagados</p>
        </div>
        <div>
            <a href="./controladores.php"><button>Não</button></a>
            <a href="./delete_controlador.php?id=<?= $id ?>&confirm=true"><button>Sim</button></a>
        </div>
    </div>

</body>

</html>