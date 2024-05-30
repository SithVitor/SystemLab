<?php
include "dbcon.php";

// Path to the PDF file
$file_path = 'docs/Laudo-ELETROENCEFALOGRAMAEMSONOEVIGILIA18303.pdf';
$file_name = basename($file_path);

// Read the PDF file content
$file_data = file_get_contents($file_path);

if ($file_data === FALSE) {
    die("Failed to read the PDF file.");
}

// Escape the binary data
$escaped_file_data = pg_escape_bytea($file_data);

// Insert the PDF file into the database
$query = 'INSERT INTO examesPDF (filename, filedata, cod_exame) VALUES ($1, $2, $3);';
$result = pg_query_params($conn, $query, array($file_name, $escaped_file_data, '11'));

if ($result) {
    echo "PDF file successfully stored in the database.";
} else {
    echo "Error storing PDF file: " . pg_last_error($conn);
}

// Close the database connection
pg_close($conn);
?>