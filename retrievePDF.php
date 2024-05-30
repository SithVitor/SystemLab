<?php
    include "dbcon.php";

    $codEx = $_GET['cod_exame']; // Assuming the ID of the PDF is passed as a query parameter
    $sql = "SELECT filename, filedata FROM examespdf WHERE cod_exame = " .  $codEx;
    $result = pg_query($conn, $sql);
    if (!$result) {
        die("Error in SQL query: " . pg_last_error());
    }
    
    $row = pg_fetch_assoc($result);
    $pdf_name = $row['filename'];
    $pdf_data = $row['filedata'];
    
    pg_close($conn);
    
    // Serve the PDF as a file download
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $pdf_name . '"');
    echo pg_unescape_bytea($pdf_data);
