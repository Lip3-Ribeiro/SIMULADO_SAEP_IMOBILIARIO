<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar IMOVEL</title>
    </head>
    <body>
        <h1>Editar IMOVEL</h1>

        <form action="<?= base_url('IMOVEL/atualizar/'.$IMOVEL['IMO_ID']) ?>" method="POST">
            <label>Nome:</label><br>
            <input type="text" id="nome" name="nome" value="<?= $IMOVEL['IMO_NOME'] ?>" required>
            <br><br>
            <label>Ano:</label><br>
            <input type="number" id="ano" name="ano" value="<?= $IMOVEL['IMO_VALOR'] ?>" required>
            <br><br>
            <label>Marca:</label><br>
            <input type="text" id="marca" name="marca" value="<?= $IMOVEL['IMO_ENDERECO'] ?>" required>
            <br><br>
            <label> PROPRIETARIO </label> <br>
                <select id="PROPRIETARIO" name="PROPRIETARIO" required>
                <?php foreach($PROPRIETARIO as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $IMOVEL['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <input type="submit" id="editar_IMOVEL" name="editar_IMOVEL" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('IMOVEL') ?>"><button>Voltar</button></a>
    </body>
</html>
