<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALiIfmXGrqn/z83N/9PS0v/W1tb/19fX/9jY2P/OycaZAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC5cWXguFxM/8y3tP/V09P/2NfX/9nZ2f/b29v/29vb/wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADMf38KtlVD/7ZVQ/+5YU//0MG//9nY2P/Z2dn/29vb/9zc3P/sgkaV8ohI//KISP/yiEj/8ohH//KIR//yh0b/8ohH//SJSP/0iEf/9IhH/9y5o//Y19f/ycbB/9nZ2f/c3Nz/84pK//WLS//1i0v/9YtL//SKSv/0ikr/9IpJ//SKSf/0iUn/9IlI//CJSv/Kv7r/v7qx/6Kah//b2tr/3Nzc//OKS//1i0z/9YtM//WLTP/1i0z/9YtL//WLS//0ikr/9IpJ//SJSf/il2n/loh0/6GXhP/Y2Nj/3d3d/97e3v/zi0z/9YxN//WMTP/1jEz/9YxM//WLTP/1i0z/9YtL//SKSv/0ikn/0qaP/5qOe/+gloT/29vb/9/f3//i4uL/84xN//WNTv/1m2T/8NjJ//Dn4P/x2cv/9Jlh//WLTP/1i0v/84xO/7all//NycT/tK6i/8O/tv/k5OT/4uLi//OMTv/1jU//8NnL//Otgv/1jU7/866E//HSv//1jEz/9YtM/9qMW/+jmIj/ppyM/6Wcif+aj3f/rqaU/+Li4v/zjU7/9Y5P/+/n4f/1jk//87eT//Dh2P/w3tT/9YxN//WMTP/csJj/1dLS/4p/ZP/l5eX/5eXl/+Xl5f/i4uL/845Q//WOUP/w2cv/86yB//WOT//1llz/9Y1O//WMTf/0jU//0sXA/9vZ2P/l5eX/5ubm/+bm5v/l5eX/4+Pj//OOUf/1j1L/9Zxn//DZyv/w5N7/8NXF//WPUv/1jU7/6pxu/9fT0v/l5OT/5+fn/+bm5v/m5ub/5eXl/+Pj4//zj1H/9ZBS//WPUv/1j1L/9Y9R//WOUP/1jk//9Y1P/9+sktjb2Niz39/fsePj47Dj4OCw4N3dsODg4K/c1tZY849S//WQU//1kFL/9Y9S//WPUf/1jlD/9Y5P/+6LTvvUf38GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPOPU//1kFT/9ZBT//WQUv/1j1L/9Y9R//WOUP/qhk+hAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADwjlac85BU//OPU//zj1H/845R//OOUP/zjU//4YlXPQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/4AAAP8AAAD/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAD/AAAA/wAAAf8AAA==" rel="icon" type="image/x-icon" />
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