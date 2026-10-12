<?php

require_once "conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "") {
    die("ID não informado.");
}

$sql = "SELECT * FROM contatos WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$contato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contato) {
    die("Contato não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar contato</title>
</head>

<body>

    <h1>Editar contato</h1>

    <form action="atualizar_contato.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars($contato["id"]) ?>"
        >

        <label for="nome">Nome</label>
        <br>

        <input
            type="text"
            id="nome"
            name="nome"
            value="<?= htmlspecialchars($contato["nome"]) ?>"
            required
        >

        <br><br>

        <label for="email">E-mail</label>
        <br>

        <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($contato["email"]) ?>"
            required
        >

        <br><br>

        <label for="assunto">Assunto</label>
        <br>

        <input
            type="text"
            id="assunto"
            name="assunto"
            value="<?= htmlspecialchars($contato["assunto"]) ?>"
            required
        >

        <br><br>

        <label for="mensagem">Mensagem</label>
        <br>

        <textarea
            id="mensagem"
            name="mensagem"
            rows="6"
            required
        ><?= htmlspecialchars($contato["mensagem"]) ?></textarea>

        <br><br>

        <button type="submit">
            Atualizar contato
        </button>

    </form>

    <p>
        <a href="painel_contatos.php">Voltar ao painel</a>
    </p>

</body>

</html>