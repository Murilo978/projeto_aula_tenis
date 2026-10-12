<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Acesso inválido.");
}

$id = $_POST["id"] ?? "";
$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$assunto = $_POST["assunto"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";

if (
    $id === "" ||
    trim($nome) === "" ||
    trim($email) === "" ||
    trim($assunto) === "" ||
    trim($mensagem) === ""
) {
    die("Preencha todos os campos.");
}

$sql = "UPDATE contatos
        SET nome = :nome,
            email = :email,
            assunto = :assunto,
            mensagem = :mensagem
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":nome" => $nome,
    ":email" => $email,
    ":assunto" => $assunto,
    ":mensagem" => $mensagem,
    ":id" => $id
]);

echo "Contato atualizado com sucesso!<br>";
echo '<a href="painel_contatos.php">Voltar ao painel</a>';

?>