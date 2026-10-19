<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de PROPRIETARIOs</title>
    </head>
    <body>
        <h1>Lista de PROPRIETARIOs</h1>

        <form method="POST" action="<?= base_url('PROPRIETARIO') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($PROPRIETARIO as $pro): ?>
                <tr>
                    <td><?= $pro['PRO_NOME'] ?></td>
                    <td><?= $pro['PRO_DATA_NASCIMENTO'] ?></td>
                    <td><a href="<?= base_url('PROPRIETARIO/editar/'.$pro['PRO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('PROPRIETARIO/excluir/'.$pro['PRO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('PROPRIETARIO/novo') ?>"><button>Cadastrar PROPRIETARIO</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>