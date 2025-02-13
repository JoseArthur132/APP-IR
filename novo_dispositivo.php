<?php
include_once("./services/api_functions.php");

$results = send_request("get_all_controladores", "GET");

$error_message = "";
$success_message = "";

$controladores = $results["data"]["results"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $marca = $_POST["marca"];
    $sala = $_POST["sala"];

    $values = [
        "tipo" => $tipo,
        "marca" => $marca,
        "sala" => $sala
    ];

    $results = send_request("create_new_dispositivo", "POST", $values);

    if ($results["data"]["status"] == "ERROR") {
        $error_message = $results["data"]["message"];
    } else if ($results["data"]["status"] == "SUCCESS") {
        $success_message = $results["data"]["message"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivo</title>

    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
    <?php include("./partials/nav.php"); ?>
    <form action="" method="POST">
        <div>
            <label for="itipo">Tipo:</label>
            <select name="tipo" id="itipo">
                <option value="Projetor">Projetor</option>
                <option value="Ar-condicionado">Ar Condicionado</option>
            </select>

        </div>
        <div>
            <label for="imarca">Marca:</label>
            <select name="marca" id="imarca">
                <option value="EPSON">EPSON</option>
                <option value="HUTLER">HUTLER</option>
                <option value="Elgin">Elgin</option>
            </select>
        </div>
        <div>
            <label for="isala">Sala:</label>
            <select name="sala" id="isala">
                <?php foreach ($controladores as $controlador): ?>
                    <option value=<?= $controlador["id_controlador"] ?>><?= $controlador["sala"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <input type="submit" value="Salvar">

        <?php if ($error_message): ?>
            <div class="error_message">
                <?= $error_message ?>
            </div>
        <?php elseif ($success_message): ?>
            <div class="success_message">
                <?= $success_message ?>
            </div>
        <?php endif; ?>

    </form>

    <script>
        const TIPO = document.querySelector("#itipo");
        const MARCA = document.querySelector("#imarca");

        function handle_tipo() {
            if (TIPO.value == "Projetor") {
                MARCA.innerHTML = "<option value='EPSON'>EPSON</option>"
            } else if (TIPO.value == "Ar-condicionado") {
                MARCA.innerHTML = "<option value='Elgin'>Elgin</option>"
                MARCA.innerHTML += "<option value='HUTLER'>HUTLER</option>"
            }
        }

        handle_tipo()

        TIPO.addEventListener("click", handle_tipo)
    </script>
</body>

</html>