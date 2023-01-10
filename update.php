<?php
#Pega o Banco e inicia
session_start();
require 'bd.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta html-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="'vieport" content="width-device-width, initialize">
    <link rel="stylesheet" href="style.css">
    <title>CRUD</title>
</head>

    <header>
        <!-- Cabeçario -->
        <h1 class="header-title">Cadastro De Clientes</h1>
    </header>
    <body>
        <div>
            <div class="modal-content">
                <header class="model-header">
                    <h2>Editar Cliente</h2>                
                </header>
                <?php
                #Pega as informações
                if(isset($_GET['id'])){
                    $user_id = mysqli_real_escape_string($con, $_GET['id']);
                    $query= "SELECT * FROM cadastro WHERE id='$user_id'";
                    $query_run = mysqli_query($con, $query);

                    if(mysqli_num_rows($query_run) > 0){
                        $user_id = mysqli_fetch_array($query_run);
                        
                    }else {
                        echo"<h4> ID Não encontrado</h4>";
                    }
                }
                ?>
                <form action="index.php" method="POST" class="modal-form" >
                    <input type="hidden" name="user_id" value="<?=$user_id['id']; ?>">
                    <!-- Tela de Edição -->
                    <input value="<?= $user_id['nome'];?>" name="nome" type="text" class="modal-field" placeholder="Nome Do Cliente">
                    <input value="<?= $user_id['email'];?>" name="email"type="text" class="modal-field" placeholder="E-mail Do Cliente">
                    <input value="<?= $user_id['telefone'];?>" name="telefone" type="text" class="modal-field" placeholder="Telefone Do Cliente">
                    <button name="edit"class="button green" type="submit">Editar</button>
                    <button class="button blue">Cancelar</button>
                </form>
            </div>
        </div>
        <footer>
        <h3>Copyright; Andromeda Enterprise</h3>
        </footer>
    </body>
</html>