<?php
require_once(dirname(__FILE__) . "../services/api_functions.php");
require_once(dirname(__FILE__) . "../services/config.php");

$id = $_GET["id"];
$results = send_request("get_dispositivo", "GET", ["id" => $id]);
$dispositivo = $results["data"]["results"][0];

// echo "<pre>";
// print_r($results);

if (isset($_GET["confirm"]) && $_GET["confirm"] == "true") {
    $results = send_request("delete_dispositivo", "GET", ["id" => $id]);

    header("location: dispositivos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
</head>

<body>
    <div>
        <div>
            <h3>Tem certeza que deseja excluir este <b><?= $dispositivo["tipo"] ?></b></h3>
        </div>
        <div>
            <a href="./dispositivos.php"><button>Não</button></a>
            <a href="./delete_dispositivo.php?id=<?= $id ?>&confirm=true"><button>Sim</button></a>
        </div>
    </div>

</body>

</html>