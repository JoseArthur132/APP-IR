<?php
include_once("./services/api_functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $values = [
        "nome" => $_POST["sala"],
        "ip" => $_POST["ip"]
    ];

    $results = send_request("create_new_controlador", "POST", $values);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlador</title>

    <link rel="stylesheet" href="./css/nav.css">
</head>

<body>
    <?php include("./partials/nav.php"); ?>
    <form action="" method="post">
        <div>
            <label for="isala">sala:</label>
            <input type="text" name="sala" id="isala">
        </div>
        <div>
            <label for="iIp">IP:</label>
            <input type="text" name="ip" id="iIp">
        </div>

        <input type="submit" value="Salvar">

    </form>


</body>

</html>