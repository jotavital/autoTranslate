<?php

if (!isset($_SESSION)) {
    session_start();
}

$dir = (__DIR__ . "/../../applications/system/lang/portugues-brasil/");

$nomeArquivoComExtensao = $_POST['nomeArquivo'];
$nomeArquivo = explode(".php", $_POST['nomeArquivo']);

//verifica permissoes da pasta

if(is_writable($dir)){
    $_SESSION['msg'] = "O diretório tem as permissões necessárias!";
}else{
    $_SESSION['msg'] = "O diretório NÃO tem as permissões necessárias!";
}

//cria arquivo ini

if (file_put_contents($dir . "pt-br_" . $nomeArquivo[0] . ".ini", FILE_APPEND) != false) {
    $_SESSION['msg'] .= "Arquivo .ini criado com sucesso!";
} else {
    $_SESSION['msg'] .= "Erro ao criar arquivo .ini!";
}

//substitui as palavras pelas label no arquivo destino

$caminhoArquivo =  __DIR__ . "/../../applications/system/admin/" . $nomeArquivoComExtensao;

if(($textoDoArquivo = file_get_contents($caminhoArquivo, FILE_TEXT)) != false){
    $_SESSION['msg'] .= "<br>Consegui ler o arquivo " . $nomeArquivoComExtensao;
}else{
    $_SESSION['msg'] .= "<br>Erro ao ler o arquivo " . $nomeArquivoComExtensao;
}

if(($oldStringsJson = file_get_contents("../baseStrings/oldStringsBase.json", FILE_TEXT)) != false){
    $_SESSION['msg'] .= "<br>Consegui ler o arquivo oldStringsBase.json";
    $oldStringsDecoded = json_decode($oldStringsJson, FALSE);
}else{
    $_SESSION['msg'] .= "<br>Erro ao ler o arquivo oldStringsBase.json";
}

if(($newStringsJson = file_get_contents("../baseStrings/newStringsBase.json", FILE_TEXT)) != false){
    $_SESSION['msg'] .= "<br>Consegui ler o arquivo newStringsBase.json";
    $newStringsDecoded = json_decode($newStringsJson, FALSE);
}else{
    $_SESSION['msg'] .= "<br>Erro ao ler o arquivo newStringsBase.json";
}

//substitui as simpleLabels
foreach ($oldStringsDecoded->simpleLabel as $nomePropriedadeOld => $palavraOld) {
    $nomePropriedadeOld = explode("old_", $nomePropriedadeOld);

    foreach ($newStringsDecoded->simpleLabel as $nomePropriedadeNew => $palavraNew) {
        $nomePropriedadeNew = explode("new_", $nomePropriedadeNew);

        if ($nomePropriedadeNew == $nomePropriedadeOld) {
            if(($textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo)) != null){
                $_SESSION['msg'] .= "<br>Consegui substituir a expressão " . $palavraOld;
            }else{
                $_SESSION['msg'] .= "<br>Erro ao substituir a expressão " . $palavraOld;
            }
        }
    }
}

//substitui as doubleQuoted inHTML

foreach ($oldStringsDecoded->doubleQuoted->inHTML as $nomePropriedadeOld => $palavraOld) {
    $nomePropriedadeOld = explode("old_", $nomePropriedadeOld);

    foreach ($newStringsDecoded->doubleQuoted->inHTML as $nomePropriedadeNew => $palavraNew) {
        $nomePropriedadeNew = explode("new_", $nomePropriedadeNew);

        if ($nomePropriedadeNew == $nomePropriedadeOld) {
            if(($textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo)) != null){
                $_SESSION['msg'] .= "<br>Consegui substituir a expressão " . $palavraOld;
            }else{
                $_SESSION['msg'] .= "<br>Erro ao substituir a expressão " . $palavraOld;
            }
        }
    }
}

//substitui as doubleQuoted inPHP

foreach ($oldStringsDecoded->doubleQuoted->inPHP as $nomePropriedadeOld => $palavraOld) {
    $nomePropriedadeOld = explode("old_", $nomePropriedadeOld);

    foreach ($newStringsDecoded->doubleQuoted->inPHP as $nomePropriedadeNew => $palavraNew) {
        $nomePropriedadeNew = explode("new_", $nomePropriedadeNew);

        if ($nomePropriedadeNew == $nomePropriedadeOld) {
            if(($textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo)) != null){
                $_SESSION['msg'] .= "<br>Consegui substituir a expressão " . $palavraOld;
            }else{
                $_SESSION['msg'] .= "<br>Erro ao substituir a expressão " . $palavraOld;
            }
        }
    }
}

file_put_contents($caminhoArquivo, $textoDoArquivo);

header("Location: index.php");
