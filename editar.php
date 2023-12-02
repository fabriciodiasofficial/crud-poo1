<?php
include('Database.php');
include('User.php');

$database = new Database();
$user = new User($database);

if(isset($_GET['id'])){
    $id = $_GET['id'];

    //Verificar se o formulário foi enviado
    if(isset($_POST['atualizar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        //Chamar o método de atualização
        if($user->update($id, $nome, $email)){
            header('Location: index.php');
            exit();
        }else{
            //Redirecionar se o Id não estiver presente
            header('Location: index.php');
        }
    }

    //Obter dados do usuário para preencher o formulário
    $usuario = $user->getOne($id);
}else{
    //Redirecionar se o ID não estiver presente
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>

    <!-- Formulário de edição -->
    <form method="post" action="editar.php?id=<?php echo $id; ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?php echo $usuario['nome']; ?>" required>
        <input type="email" name="email" placeholder="E-mail" value="<?php echo $usuario['email']; ?>" required>
        <button type="submit" name="atualizar">Atualizar</button>
    </form>
</body>
</html>















