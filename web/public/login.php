<?php

session_start();

require_once("../config/database.php");
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $sql = "SELECT * FROM clientes WHERE email = ? AND senha = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$email, $senha]);

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if($cliente) {

        $_SESSION['cliente'] = $cliente;

        header("Location: index.php");

        exit;

    } else {

        $erro = "E-mail ou senha inválidos.";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        Login - HyperCore
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card bg-dark text-white p-4">

                <h1 class="text-info mb-4">
                    Login
                </h1>
<?php if(isset($erro)): ?>

    <div class="alert alert-danger">

        <?= $erro ?>

    </div>

<?php endif; ?>
                <form method="POST">

                    <div class="mb-3">

                        <label>
                            E-mail
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label>
                            Senha
                        </label>

                        <input
                            type="password"
                            name="senha"
                            class="form-control"
                            required
                        >

                    </div>

                    <button class="btn btn-info w-100">
                        Entrar
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>