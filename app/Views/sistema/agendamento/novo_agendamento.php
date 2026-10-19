<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Agendamento</title>
    </head>
    <body>
        <h1>Novo Agendamento</h1>

        <form action="<?= base_url('agendamento/inserir') ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" required>
            <br><br>

            <label>Motivo:</label><br>
            <input type="text" id="motivo" name="motivo" placeholder="Serviço..." required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" placeholder="Status..." required>
            <br><br>

            <label>IMOVEL:</label><br>
            <select id="IMOVEL" name="IMOVEL" required>
                <option value="">Selecione um IMOVEL</option>
                <?php foreach($IMOVEL as $imo): ?>
                    <option value="<?= $imo['IMO_ID'] ?>">
                        <?= $imo['IMO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>PROPRIETARIO:</label><br>
            <select id="PROPRIETARIO" name="PROPRIETARIO" required>
                <option value="">Selecione um Imovel</option>
                <?php foreach($PROPRIETARIO as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>">
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_agendamento" name="cadastrar_agendamento" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('agendamento') ?>"><button>Voltar</button></a>
    </body>
</html>