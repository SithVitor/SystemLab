<?php
    include "dbcon.php";

    $cpf = $_POST['cpf'];

    $sql = 'SELECT nome, data_n FROM pacientes WHERE cpf = ' .  $cpf . ';';
    $result = pg_query($conn, $sql);

    $row = pg_fetch_assoc($result);
    $name = $row['nome'];
    $dataN = $row['data_n'];

    if (!$result) {
        echo "Query failed: " . pg_last_error();
        exit;
    }

    $sql = 'SELECT cod, data_r, tipo FROM exames WHERE fk_cpf_paciente = ' .  $cpf . ';';
    $result = pg_query($conn, $sql);

    for ($i = 0; $i < pg_num_rows($result); $i++) {
        $row = pg_fetch_assoc($result);
        $codEx[$i] = $row['cod'];
        $dataR[$i] = $row['data_r'];
        $tipo[$i] = $row['tipo'];
    }

    if (!$result) {
        echo "Query failed: " . pg_last_error();
        exit;
    }

    

    $DataN = new DateTime($dataN);
    $DataA = new DateTime();
    $InterIdade = $DataA->diff($DataN);
    $idade = $InterIdade->y;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/lista.css">
    <title>Lista de Exames</title>
</head>
<body>
    <div class="w3-container cabeca">
        <img src="img/Logo.png" class="logo">

        <div class="w3-row dados">
            <p class="nome">Nome: <u><?php echo $name;?></u> &emsp;&emsp; Idade: <u><?php echo $idade;?></u></p>
        </div>
    </div>
    <div class="w3-container w3-center table">
        <form method="post" action="impressao.php" class="w3-table w3-centered w3-hoverable w3-cell-middle w3-xxxlarge">
            <table class="w3-responsive" style="margin-left: auto; margin-right: auto;">
                <tr class="verdeclaro">
                    <th></th>
                    <th style="padding-left: 200px; padding-right: 200px;">CPF</th>
                    <th style="padding-left: 100px; padding-right: 100px;">Tipo de Exame</th>
                    <th style="padding-left: 100px; padding-right: 100px;">Data de Realização</th>
                </tr>

                <?php
                    for ($i = 0; $i < pg_num_rows($result); $i++){ ?>
                        <tr>
                            <td class="w3-cell-top"><input class="w3-check check" type="checkbox" name="checkbox[]" value="<?php echo $codEx[$i];?>"></td>
                            <td><?php echo $cpf;?></td>
                            <td><?php echo $tipo[$i];?></td>
                            <td><?php $dateR = new DateTime($dataR[$i]); echo $dateR->format('d/m/Y');?></td>
                        </tr>
                    <?php
                    }
                ?>
            </table>

            <input class="w3-button verdeclaro botao" type="submit" value="Imprimir">
        </form>
    </div>
    <button onclick="document.getElementById('help').style.display='block'" class="w3-btn verdeclaro" id="helpbtn">?</button>

    <div id="help" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-display-middle caixa">
          <header class="w3-container verdeclaro"> 
            <span onclick="document.getElementById('help').style.display='none'" class="w3-button w3-display-topright x">&times;</span>
            <h2 style="font-weight: bold; font-size: 60px;">Ajuda</h2>
          </header>
          <div class="w3-container">
            <p style="font-size: 34px; font-weight: lighter;">Assinale a caixinha representante do(s) exame(s) que deseja imprimir. </br></br>Quando terminar de assinalar, clique no botão "Imprimir" para iniciar a impressão.</p>
          </div>
        </div>
    </div>
</body>

<?php
    pg_free_result($result);
    pg_close($conn);
?>
</html>