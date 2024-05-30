<?php
    $codEx = $_POST['checkbox'];
    $nRes = count($codEx);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/impressao.css">
    <title>Impressão</title>
</head>
<body>
    <?php
        $n = 0;
        for($i = 1; $i <= $nRes; $i++){
    ?>
    <script>
        function printPDF(codEx) {
            // URL of the server-side script that serves the PDF
            var pdfUrl = 'retrievePDF.php?cod_exame=' + codEx;

            // Create an iframe element to load the PDF
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.src = pdfUrl;
            document.body.appendChild(iframe);

            // When the iframe loads, trigger the print dialog
            iframe.onload = function() {
                iframe.contentWindow.print();
            };
        }

        // Automatically trigger printing when the page loads
        window.onload = printPDF(<?php echo $codEx[$n]; ?>);
    </script>
    <?php
            $n++;
        }
        echo '<script>
                    window.location.href = "finalizado.php";
              </script>';
    ?>

    <div class="w3-bar">
        <img src="img/Logo.png" class="logo">
    </div>

    <div class="w3-container w3-center">
        <p class="w3-xxxlarge frase">Os exames estão sendo impressos...</p>

        <div id="loading-circle"></div>

    </div>
</body>
</html>