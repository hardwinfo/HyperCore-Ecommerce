<?php

session_start();

require_once("../config/database.php");

/*
|--------------------------------------------------------------------------
| VALIDAR ID
|--------------------------------------------------------------------------
*/

if(!isset($_GET['id']))
{
    header("Location: index.php");

    exit;
}

$id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| BUSCAR PRODUTO
|--------------------------------------------------------------------------
*/

$sql =
    "SELECT * FROM produtos WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$produto =
    $stmt->fetch(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| PRODUTO NÃO EXISTE
|--------------------------------------------------------------------------
*/

if(!$produto)
{
    echo "Produto não encontrado.";

    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>

        <?= $produto['nome'] ?>

    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <a
        href="index.php"
        class="btn btn-outline-info mb-4"
    >
        Voltar
    </a>

    <div class="card bg-dark text-white p-5 border border-secondary">

        <?php if(!empty($produto['imagem'])): ?>

            <img
                src="images/<?= $produto['imagem'] ?>"
                class="img-fluid rounded mb-4"
                style="
                    max-height:400px;
                    object-fit:contain;
                "
            >

        <?php endif; ?>

        <h1 class="text-info mb-4">

            <?= $produto['nome'] ?>

        </h1>

        <h3 class="mb-4">

            R$ <?= number_format(
                $produto['preco'],
                2,
                ',',
                '.'
            ) ?>

        </h3>

        <p class="mb-4">

            <?= $produto['descricao'] ?>

        </p>

        <p>

            <strong>
                Estoque:
            </strong>

            <?= $produto['estoque'] ?>

        </p>

        <!-- BOTÃO CARRINHO -->

        <a
            href="add_cart.php?id=<?= $produto['id'] ?>"
            class="btn btn-info mt-4"
        >
            Adicionar ao Carrinho
        </a>

        <!-- AVALIAÇÕES -->

        <div class="card bg-dark text-white p-4 mt-4 border border-secondary">

            <h3 class="text-info mb-4">
                Avaliações
            </h3>

            <?php if(isset($_SESSION['cliente'])): ?>

                <form method="POST" action="save_review.php">

                    <input
                        type="hidden"
                        name="produto_id"
                        value="<?= $produto['id'] ?>"
                    >

                    <div class="mb-3">

                        <label class="form-label">
                            Nota
                        </label>

                        <select
                            name="nota"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione
                            </option>

                            <option value="5">
                                5 - Excelente
                            </option>

                            <option value="4">
                                4 - Muito Bom
                            </option>

                            <option value="3">
                                3 - Bom
                            </option>

                            <option value="2">
                                2 - Regular
                            </option>

                            <option value="1">
                                1 - Ruim
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Comentário
                        </label>

                        <textarea
                            name="comentario"
                            class="form-control"
                            rows="4"
                        ></textarea>

                    </div>

                    <button class="btn btn-info">

                        Enviar Avaliação

                    </button>

                </form>

            <?php else: ?>

                <div class="alert alert-warning">

                    Faça login para avaliar este produto.

                </div>

            <?php endif; ?>
            <hr class="my-4">

<h4 class="text-info mb-4">
    Comentários dos Clientes
</h4>

<?php

$sql = "
SELECT
    avaliacoes.*,
    clientes.nome
FROM avaliacoes
INNER JOIN clientes
    ON avaliacoes.cliente_id = clientes.id
WHERE produto_id = ?
AND aprovado = 1
ORDER BY avaliacoes.id DESC
";

$stmt = $pdo->prepare($sql);

$stmt->execute([$produto['id']]);

$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if(empty($avaliacoes)): ?>

    <div class="alert alert-secondary">

        Nenhuma avaliação encontrada.

    </div>

<?php else: ?>

    <?php foreach($avaliacoes as $avaliacao): ?>

        <div class="border border-secondary rounded p-3 mb-3">

            <h5 class="text-warning">

                <?php
                    echo str_repeat(
                        "⭐",
                        $avaliacao['nota']
                    );
                ?>

            </h5>

            <p class="mb-2">

                <?= $avaliacao['comentario'] ?>

            </p>

            <small class="text-secondary">

                <?= $avaliacao['nome'] ?>

            </small>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

        </div>

    </div>

</div>

</body>
</html>