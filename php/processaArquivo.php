<?php

if (!isset($_SESSION)) {
    session_start();
}

$caminhoArquivoIni = (__DIR__ . "/../../applications/system/lang/portugues-brasil/");

$nomeArquivoComExtensao = $_POST['nomeArquivo'];
$nomeArquivo = explode(".php", $_POST['nomeArquivo']);

//verifica permissoes da pasta

if (is_writable($caminhoArquivoIni)) {
    $_SESSION['msg'] .= "<br><p class='p-green'>O diretório lang tem as permissões necessárias!</p>";
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>O diretório lang NÃO tem as permissões necessárias!</p>";
}

$pastaAdmin = __DIR__ . "/../../applications/system/admin/";

if (is_writable($pastaAdmin)) {
    $_SESSION['msg'] .= "<br><p class='p-green'>O diretório admin tem as permissões necessárias!</p>";
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>O diretório admin NÃO tem as permissões necessárias! Conceda as permissões.</p>";
}

//cria arquivo ini
$nomeArquivoIni = "pt-br_" . $nomeArquivo[0] . ".ini";

if(!file_exists($caminhoArquivoIni . $nomeArquivoIni)){
    if (file_put_contents($caminhoArquivoIni . $nomeArquivoIni, FILE_APPEND) != false) {
        $_SESSION['msg'] .= "<br><p class='p-green'>Arquivo " . $nomeArquivoIni . " criado com sucesso!</p>";
    } else {
        $_SESSION['msg'] .= "<br><p class='p-red'>Erro ao criar arquivo " . $nomeArquivoIni . "!</p>";
    }
}else{
    $_SESSION['msg'] .= "<br><p class='p-red'>Arquivo " . $nomeArquivoIni . " não foi criado pois já existe!</p>";
}

//substitui as palavras pelas label no arquivo destino

$caminhoArquivo =  __DIR__ . "/../../applications/system/admin/" . $nomeArquivoComExtensao;

if (($textoDoArquivo = file_get_contents($caminhoArquivo, FILE_TEXT)) != false) {
    $_SESSION['msg'] .= "<br><p class='p-blue'>Consegui ler o arquivo " . $nomeArquivoComExtensao . "</p>";
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>Erro ao ler o arquivo " . $nomeArquivoComExtensao . "</p>";
}

if (($oldStringsJson = file_get_contents("../baseStrings/oldStringsBase.json", FILE_TEXT)) != false) {
    $_SESSION['msg'] .= "<br><p class='p-blue'>Consegui ler o arquivo oldStringsBase.json!</p>";
    $oldStringsDecoded = json_decode($oldStringsJson, FALSE);
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>Erro ao ler o arquivo oldStringsBase.json!</p>";
}

if (($newStringsJson = file_get_contents("../baseStrings/newStringsBase.json", FILE_TEXT)) != false) {
    $_SESSION['msg'] .= "<br><p class='p-blue'>Consegui ler o arquivo newStringsBase.json!</p>";
    $newStringsDecoded = json_decode($newStringsJson, FALSE);
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>Erro ao ler o arquivo newStringsBase.json!</p>";
}

$contSubstituidas = 0;

//substitui as simpleLabels
foreach ($oldStringsDecoded->simpleLabel as $nomePropriedadeOld => $palavraOld) {
    $nomePropriedadeOld = explode("old_", $nomePropriedadeOld);

    foreach ($newStringsDecoded->simpleLabel as $nomePropriedadeNew => $palavraNew) {
        $nomePropriedadeNew = explode("new_", $nomePropriedadeNew);

        if ($nomePropriedadeNew == $nomePropriedadeOld) {
            $textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo, $count);

            if ($count > 0) {
                $contSubstituidas++;
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
            $textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo, $count);

            if ($count > 0) {
                $contSubstituidas++;
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
            $textoDoArquivo = str_replace($palavraOld, $palavraNew, $textoDoArquivo, $count);

            if ($count > 0) {
                $contSubstituidas++;
            }
        }
    }
}

if (file_put_contents($caminhoArquivo, $textoDoArquivo) != false) {
    $_SESSION['msg'] .= "<br><p class='p-green'>Arquivo " . $nomeArquivoComExtensao . " finalizado com sucesso! <p class='p-blue'>" . $contSubstituidas . " expressões</p> foram substituídas automaticamente.</p>";
} else {
    $_SESSION['msg'] .= "<br><p class='p-red'>Erro ao escrever no arquivo " . $nomeArquivoComExtensao . "! Verifique as permissões da pasta destino</p>";
}

header("Location: index.php");
