<?php
$host = "localhost:3307";
$user = "root";
$pass = '';
// $user = "teste";
// $pass = 'P4$sword';
$dbname = "estacionamento";

// Criar a conexao com o Banco de Dados
try {
    $conn = mysqli_connect($host, $user, $pass, $dbname);
} catch (Exception $e) {
    // Handle exception
    echo 'Caught exception: ', $e->getMessage(), "<br>";
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
