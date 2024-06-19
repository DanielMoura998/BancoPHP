<?php
// Verifica se o formulario foi submetido
session_start();

 ($_SERVER["REQUEST_METHOD"] == "POST");
    // Obtem os dados do formulario
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
 
    // Conecta ao banco de dados e é necessário colocar o login e senha do workbench local
    $conn = new PDO("mysql:host=localhost;dbname=TelaLogin", "root", "etec");

   // Consulta o banco de dados para verificar se o e-mail e a senha correspondem a um usuario valido
    $stmt = $conn->prepare("SELECT * FROM DadosClientes WHERE email = :email AND senha = :senha");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    $stmt->execute();

     if($stmt->rowCount() > 0)
     {

        // Define as informaçoes do usuario na sessão
        $_SESSION['email'] = $email;
        setcookie("email", $email, time() + 86400, '/');
        // Redireciona para a tela de conteudo
        header("Location: Conteudo.php");
        exit();
     }
        
     else {
        // Exibe uma mensagem de erro na tela de login
        echo "E-mail ou senha inválidos. Por favor, tente novamente.";
        // Se o metodo de requisiçao nao for POST, redireciona de volta para a pagina de login
        header("Location: TelaLogin.html");
    exit();
    }

    

?>
