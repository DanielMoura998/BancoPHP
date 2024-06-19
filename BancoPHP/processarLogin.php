<?php
// Verifica se o formulario foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os dados do formulario
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conecta ao banco de dados e é necessário colocar o login e senha do workbench local
    $conn = new PDO("mysql:host=localhost;dbname=TelaLogin", "root", "etec");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta o banco de dados para verificar se o e-mail e a senha correspondem a um usuario valido
    $stmt = $conn->prepare("SELECT * FROM DadosClientes WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuario foi encontrado e se a senha esta correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Inicia a sessao
        session_start();

        // Define as informaçoes do usuario na sessão
        $_SESSION['nome'] = $usuario['nome'];
        
        // Redireciona para a tela de conteudo
        header("Location: Conteudo.php");
        exit();
    } else {
        // Exibe uma mensagem de erro na tela de login
        echo "E-mail ou senha inválidos. Por favor, tente novamente.";
    }
} else {
    // Se o metodo de requisiçao nao for POST, redireciona de volta para a pagina de login
    header("Location: TelaLogin.html");
    exit();
}
?>