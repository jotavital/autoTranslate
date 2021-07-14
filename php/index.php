<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main.css">
    <title>AutoTranslate</title>
</head>

<style>
    body {
        background-color: aliceblue;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .p-red {
        color: red;
    }

    .p-blue {
        color: blue;
    }

    .p-green {
        color: green;
    }
</style>

<body>
    <h1>Assistente de troca de palavras</h1>

    <form action="processaArquivo.php" method="POST">
        <label for="nomeArquivoInput">Nome do arquivo com extensão .php</label>
        <input type="text" name="nomeArquivo" id="nomeArquivoInput" placeholder="Nome do arquivo a editar">
        <button type="submit">Enviar</button>
    </form>

    <div style="margin-top: 10px;">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>
</body>

</html>