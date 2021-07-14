<?php

if(!isset($_SESSION)){
    session_start();
}

$dir = (__DIR__ . "/../../applications/system/lang/portugues-brasil/");

$nomeArquivo = explode(".php", $_POST['nomeArquivo']);

if(file_put_contents( $dir . "pt-br_" . $nomeArquivo[0] . ".ini", FILE_APPEND) != false){
    $_SESSION['msg'] = "Arquivo .ini criado com sucesso!";
}else{
    $_SESSION['msg'] = "Erro ao criar arquivo .ini!";
}

header("Location: index.php");

?>