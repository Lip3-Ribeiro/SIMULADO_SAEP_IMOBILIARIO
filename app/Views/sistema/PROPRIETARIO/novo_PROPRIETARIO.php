<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo PROPRIETARIO</title>
    </head>
    <body>
        <h1>Novo PROPRIETARIO</h1>
        <form action="<?= base_url('PROPRIETARIO/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
           
            <label>data nascimento:</label><br>
            <input type="date" id="data_nascimento" name="data_nascimento" placeholder="13/13/13" required>

            <br><br>

            <input type="submit" id="cadastrar_PROPRIETARIO" name="cadastrar_PROPRIETARIO" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('PROPRIETARIO') ?>"><button>Voltar</button></a>
    </body>
</html>