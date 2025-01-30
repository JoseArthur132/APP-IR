<?php
include_once("./services/api_functions.php");

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $values = [
        "id" => $_GET["id"],
        "sala" => $_POST["sala"],
        "ip" => $_POST["ip"]
    ];

    $results = send_request("edit_controlador", "POST", $values);


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
    <title>Controlador</title>

    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/forms.css">
</head>

<body>
    <?php include("./partials/nav.php"); ?>
    <form action="" method="post">
        <div>
            <label for="isala">Sala:</label>
            <input type="text" name="sala" id="isala" class="text_field">
        </div>
        <div>
            <label for="iIp">IP:</label>
            <input type="text" name="ip" id="iIp" class="text_field">
        </div>

        <input type="submit" value="Salvar" class="button">
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


</body>

</html>