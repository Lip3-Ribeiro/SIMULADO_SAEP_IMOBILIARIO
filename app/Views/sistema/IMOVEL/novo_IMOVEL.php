<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo IMOVEL</title>
    </head>
    <body>
        <h1>Novo IMOVEL</h1>
        <form action="<?= base_url('IMOVEL/inserir') ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" placeholder="Nome..." required>

            <br><br>
           
            <label>Endereço:</label><br>
            <input type="text" id="endereco" name="endereco" placeholder="Honda..." required>

            <br><br>

            <label>Valor:</label><br>
            <input type="number" id="valor" name="valor" placeholder="150000" required>
            <br><br>
            <label> PROPRIETARIO </label> <br>
                <select id="PROPRIETARIO" name="PROPRIETARIO" required>
                    <option value=""> Selecione um PROPRIETARIO</option>
                    <?php foreach($PROPRIETARIO as $pro): ?>
                        <option value="<?= $pro['PRO_ID'] ?>"> 
                                <?= $pro['PRO_NOME'] ?> 
                        </option>
                    <?php endforeach ?>
                </select>
            
            <br><br>

            <input type="submit" id="cadastrar_PROPRIETARIO" name="cadastrar_PROPRIETARIO" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('IMOVEL') ?>"><button>Voltar</button></a>
    </body>
</html>