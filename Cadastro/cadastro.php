<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação básica (você deve implementar validações mais robustas)
    if (empty($nome) || empty($email) || empty($senha)) {
        header("Location: cadastro.html?message=Todos os campos são obrigatórios.");
        exit();
    } else {
        try {
            // Conexão com o banco de dados
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=tcc', 'root', '');

            // Preparação da consulta SQL para inserção
            $sql = "INSERT INTO conta (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR); // Senha em texto simples

            // Executa a inserção
            if ($stmt->execute()) {
                // Registro bem-sucedido, redireciona o usuário para a página de login
                header("Location: ../home/pgInicial.html");
                exit();
            } else {
                header("Location: cadastro.html?message=Ocorreu um erro durante o registro. Por favor, tente novamente mais tarde.");
                exit();
            }
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
?>
