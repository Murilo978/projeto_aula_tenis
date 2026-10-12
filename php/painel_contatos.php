<?php

require_once "conexao.php";

$sql = "SELECT * FROM contatos ORDER BY id DESC";

$stmt = $pdo->query($sql);

$contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Painel de Contatos</title>
</head>

<body>

    <h1>Contatos cadastrados</h1>

    <p>
        <a href="../pages/contato.html">Voltar ao formulário</a>
    </p>

    <?php if (count($contatos) === 0): ?>

        <p>Nenhum contato cadastrado.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($contatos as $contato): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($contato["id"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($contato["nome"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($contato["email"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($contato["assunto"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($contato["mensagem"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($contato["data_envio"]) ?>
                        </td>

                        <td>
                            <a href="editar_contato.php?id=<?= $contato["id"] ?>">
                                Editar
                            </a>

                            |

                            <a
                                href="excluir_contato.php?id=<?= $contato["id"] ?>"
                                onclick="return confirm('Deseja realmente excluir este contato?');"
                            >
                                Excluir
                            </a>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>