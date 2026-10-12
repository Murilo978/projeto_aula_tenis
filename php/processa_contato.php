<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}

$nome = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$assunto = $_POST["subject"] ?? "";
$mensagem = $_POST["message"] ?? "";

if (
    trim($nome) === "" ||
    trim($email) === "" ||
    trim($assunto) === "" ||
    trim($mensagem) === ""
) {
    die("Preencha todos os campos.");
}

$sql = "INSERT INTO contatos
        (nome, email, assunto, mensagem)
        VALUES
        (:nome, :email, :assunto, :mensagem)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nome" => $nome,
    ":email" => $email,
    ":assunto" => $assunto,
    ":mensagem" => $mensagem
]);

echo "Contato cadastrado com sucesso!<br>";
echo '<a href="../pages/contato.html">Voltar ao formulário</a><br>';
echo '<a href="painel_contatos.php">Ver contatos cadastrados</a>';

?>