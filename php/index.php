<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoTranslate</title>
</head>
<body>
    <h1>Assistente de troca de palavras</h1>

    <form action="processaArquivo.php" method="POST">
        <label for="nomeArquivoInput">Nome do arquivo com extensão .php</label>
        <input type="text" name="nomeArquivo" id="nomeArquivoInput" placeholder="Nome do arquivo a editar">
        <button type="submit">Enviar</button>
    </form>

    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
</body>
</html>