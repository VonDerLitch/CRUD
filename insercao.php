<?php
include("bd.php");

#consulta o banco de dados
$consulta = "SELECT * FROM cadastro";
$con = $mysqli->query($consulta) or die ($mysqli->error);

if (isset($_POST['nome'])){
    $sql = $pdo->prepare("INSERT INTO cadastro VALUES (null,?,?,?)");
    $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone']));
    echo 'inserido com sucesso';

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
            <?php while ($dado = $con ->fetch_array()) { ?>
                <tr>
                    <td><?php echo $dado["id"]; ?></td>
                    <td><?php echo $dado["nome"]; ?></td>
                    <td><?php echo $dado["email"]; ?></td>
                    <td><?php echo $dado["telefone"]; ?></td>
                    <td>
                        <!-- Botões de editar e excluir -->
                        <button type="button" class="button green">Editar</button>
                        <button type="button" class="button red">Excluir</button>
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
                
                <form method="post" class="modal-form">
                    <!-- Tela de cadastro -->
                    <input name="nome" type="text" class="modal-field" placeholder="Nome Do Cliente">
                    <input name="email "type="text" class="modal-field" placeholder="E-mail Do Cliente">
                    <input name="telefone" type="text" class="modal-field" placeholder="Telefone Do Cliente">
                    <!-- mostrar erro php -->
                </form>
                <footer method="post" class="modal-footer">
                    <!-- Botões de salvar e cancelar -->
                    <button name="salvar"class="button green" type="submit">Salvar</button>
                    <button class="button blue">Cancelar</button>

                </footer>
            </div>
        </div>
    </main>
    <footer>
        <h3>Copyright; Andromeda Enterprise</h3>
    </footer>
</body>
</html>