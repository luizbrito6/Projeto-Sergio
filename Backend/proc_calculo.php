<?php
session_start();
include_once("../rotas.php"); // Inclui o arquivo de rotas
include_once($connRoute); // Inclui o arquivo de conexao
date_default_timezone_set('America/Sao_Paulo'); // Define o timezone para São Paulo

// Pega o valor do id que vem da lista
$id = $_GET['id'];

// Puxa os dados do registro, de acordo com o id
$comando = "select * from registros where PK_registro = '$id'";
$resultado = mysqli_query($conn, $comando);

$array = mysqli_fetch_assoc($resultado);
$_SESSION['array'] = $array;
// retorna Array ( [PK_Registro] => 4 [FK_Usuario] => 1 [Nome] => michael [Telefone] => 11978969547 [Placa] => acs2134 [Data] => 2023-03-24 [Horario_ent] => 15:01:21 [Horario_saida] => [Recarregou_Carro] => 0 ou 1 [Valor_Vaga] => [Valor_eletrico] => [Valor_pago] => )

// Pega a hora atual
$hhh = date('H:i:s');
$hora = date('H:i:s');

// Converte a string hora e a string Horario_ent em um DateTime object
$hh = new DateTime($hora);
$horario1 = new DateTime($array['Horario_ent']);

// Verifica a diferença de horário
$diferenca = $horario1->diff($hh);

// Converte a diferença em horas e minutos em inteiro, separando em duas variáveis
$gethora = intval($diferenca->format('%H'));
$getminuto = intval($diferenca->format('%I'));

// Verifica se a hora é igual a zero
if ($gethora == 0) {

    // se for igual a zero e os minutos menor que 16
    if ($getminuto < 16) {
        // o estacionamento será de graça
        $precovaga = 0;
    } elseif ($getminuto >= 16) {
        // se não for menor que 16, será 27 reais o valor
        $precovaga = 27;
    }

} elseif ($gethora == 1) { // verifica se a hora é igual a 1

    // se for e os minutos forem 0
    if ($getminuto == 0) {
        // será cobrado 27 reais
        $precovaga = 27;
    } elseif ($getminuto >= 1) {
        // se for mais que 0 minutos será cobrado 32 reais
        $precovaga = 32;
    }

} elseif ($gethora == 2 && $getminuto == 0) { // se for 2 horas e 0 minutos
    // será cobrado 32 reais
    $precovaga = 32;

} elseif ($gethora >= 2 && $getminuto > 0) {
    // se for igual ou maior a 2 horas e mais de 0 minutos
    if ($getminuto > 0){
        $gethora += 1;
    }
    // será cobrado 32 + 9 * horas a mais de 2 horas
    $precovaga = 32 + ($gethora - 2) * 9;
}


/*
    tabela depreços por energia elétrica:
        1 minuto => R$0,25
        1 hora   => R$15

*/

if ($array['Recarregou_Carro'] == 1){
    $precorecarga = ($gethora * 15) + ($getminuto * 0.25);
} else {
    $precorecarga = 0;
}

$valortotal = $precovaga + $precorecarga;


$_SESSION['precovaga'] = $precovaga;
$_SESSION['precorecarga'] = $precorecarga;
$_SESSION['total'] = $valortotal;

header("Location: " . $detalhesRoute);
