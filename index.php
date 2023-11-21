<?php
include('Database.php');
include('User.php');

$database = new Database();
$user = new User($database->pdo);

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($user->create($nome, $email, $senha)){
        header('Location: index.php');
        exit();
    }
}

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];

    if($user->delete($id)){
        header('Location: index.php');
        exit();
    }
}

$usuarios = $user->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuário</title>
</head>
<body>
    <h1>CRUD de Usuário</h1>

    <!-- Formulário de cadastro -->
    <h2>Cadastrar Usuário</h2>
    <form method="post" action="index.php">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <!-- Lista de Usuários -->
    <h2>Lista de Usuários</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        <thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nome']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    <a href="index.php?excluir=<?php echo $usuario['id']; ?>">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>