<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de IMOVELs</title>
    </head>
    <body>
        <h1>Lista de IMOVELs</h1>

        <form method="POST" action="<?= base_url('IMOVEL') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Ano</th>
                <th>PROPRIETARIO</th>
                <th>Endereço</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($IMOVEL as $imo): ?>
                <tr>
                    <td><?= $imo['IMO_NOME'] ?></td>
                    <td><?= $imo['IMO_VALOR'] ?></td>
                    <td><?= $imo['PRO_NOME'] ?></td>
                    <td><?= $imo['IMO_ENDERECO'] ?></td>
                    <td><a href="<?= base_url('IMOVEL/editar/'.$imo['IMO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('IMOVEL/excluir/'.$imo['IMO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('IMOVEL/novo') ?>"><button>Cadastrar IMOVEL</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>