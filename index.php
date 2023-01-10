<?php
include("bd.php");

#consulta o banco de dados
$consulta = "SELECT * FROM cadastro";
$connect = $con->query($consulta) or die ($con->$error);

#inserir no banco;
if(isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql="INSERT INTO `cadastro` (nome,email,telefone)
    VALUES ('$nome','$email','$telefone')";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "Cadastrado com sucesso";
        header("Location: index.php");
    }else {
        die(mysqli_error($con));
    }
}

#excluir
if(isset($_POST['delete_user'])){
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM cadastro WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        echo "Deletado";
        header("Location: index.php");
    }else{
        echo "erro";
    }
}

#Editar
if(isset($_POST['edit'])){
    
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);

    $query = "UPDATE cadastro SET nome='$nome', email='$email', telefone='$telefone' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        echo "Editado";
        header("Location: index.php");
    }else{
        echo "erro";
        header("Location: index.php");
    }

}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta html-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="'vieport" content="width-device-width, initialize">
    <link rel="stylesheet" href="style.css">
    <title>CRUD</title>
    <script src="main.js" defer></script>
</head>

<body>
    <header>
        <!-- Cabeçario -->
        <h1 class="header-title">Cadastro De Clientes</h1>
    </header>
    <main>
        <!-- Botão de cadastrar, com acionamento em JS -->
        <button type="button" class="button blue" id="cadastrarCliente">Cadastrar Cliente</button>
        <table class="records">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <!-- começo da busca de dados -->
            <?php while ($dado = $connect ->fetch_array()) { ?>
                <tr>
                    <td><?php echo $dado["id"]; ?></td>
                    <td><?php echo $dado["nome"]; ?></td>
                    <td><?php echo $dado["email"]; ?></td>
                    <td><?php echo $dado["telefone"]; ?></td>
                    <td>
                        <form action="index.php" method="POST">
                            <!-- Botões de editar e excluir, pega o id com o metodo e joga para a função -->
                            <button type="button" class="button green"><a href="update.php?id=<?=$dado['id'];?>">Editar</a></button>
                            <button value="<?=$dado['id'];?>" name="delete_user" type="submit" class="button red">Deletar</button>
                        </form>                   
                        </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- Cabeçario de tela de cadastro -->
        <div class="modal" id="modal">
            <div class="modal-content">
                <header class="model-header">
                    <h2>Novo Cliente</h2>
                    <span class="modal-close" id="modalClose">X</span>
                  
                </header>
                
                <form action="index.php" method="post" class="modal-form" >
                    <!-- Tela de cadastro -->
                    <input name="nome" type="text" class="modal-field" placeholder="Nome Do Cliente">
                    <input name="email"type="text" class="modal-field" placeholder="E-mail Do Cliente">
                    <input name="telefone" type="text" class="modal-field" placeholder="Telefone Do Cliente">
                    <button name="salvar"class="button green" type="submit">Salvar</button>
                    <button class="button blue">Cancelar</button>
                    <!-- mostrar erro php -->
                </form>
            </div>
        </div>
    </main>
    <footer>
        <h3>Copyright; Andromeda Enterprise</h3>
    </footer>
</body>
</html>