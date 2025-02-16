<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Frontend/FrontendPages/cssModalSenha/modal.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    include_once("../../rotas.php"); // Inclui o arquivo de rotas
    include_once($connRoute); // Inclui o arquivo de conexao
    

    // Verifica se o usuário logado é adm
    if ($_SESSION['tipo'] == "Adm") {
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        // começo da tela
        echo '
        <form action="' .$procCadFunRoute. '" method="POST">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" autofocus required><br><br>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br><br>

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" required><br><br>

            <label for="login">Login:</label>
            <input type="text" name="login" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{8,}$">
            <!-- Botão de informação -->
            <div id="mod">

                <p>?</p>
                <p>Digite uma senha com: no mínimo 8 caracteres, 1 letra maiúscula, 1 letra minúscula, 1 numero e 1 símbolo</p>

            </div>

            <label for="senha">Digite novamente a senha:</label>
            <input type="password" name="confsenha" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\s]).{8,}$"><br><br>

            <input type="submit" id="enviar" value="Enviar" disabled>
            <a href=' . $listaRoute . ' ?>VOLTAR</a>

        </form>
        
        <script src='. $confSenhaRoute.'></script>
        <script src='. $modalInfRoute.'></script>
        ';
        // fim da tela
    } else {

        header("Location: " . $listaRoute);

    }
    ?>

</body>

</html>
