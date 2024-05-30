<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/finalizado.css">
    <title>Finalizado</title>
</head>
<body>
    <div class="w3-bar">
        <img src="img/Logo.png" class="logo">
    </div>

    <div class="w3-container w3-center">
        <p id="final">Impressão Finalizada!</p>

        <p id="volta">Voltando para a página inicial...</p>

        <div id="barracontainer">
            <div id="barra"></div>
        </div>

        <div class="w3-center">
            <button class="w3-button botao"><a href="index.html" style="text-decoration: none; color: black;">Voltar agora</a></button>
        </div>
    </div>
    <script>
        var loadingBar = document.getElementById('barra');
        loadingBar.style.width = '0';
        loadingBar.classList.remove('animate');

        setTimeout(function() {
            loadingBar.classList.add('animate');
            loadingBar.style.width = '100%';
        }, 100);

        setTimeout(function() {
            window.location.href = 'index.html';
        }, 15000);
    </script>
</body>
</html>