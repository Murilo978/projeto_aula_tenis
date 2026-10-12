<?php

require_once "conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "") {
    die("ID não informado.");
}

$sql = "DELETE FROM contatos WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

echo "Contato excluído com sucesso!<br>";
echo '<a href="painel_contatos.php">Voltar ao painel</a>';

?>