<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Agendamento</title>
    </head>
    <body>
        <h1>Editar Agendamento</h1>

        <form action="<?= base_url('agendamento/atualizar/'.$agendamento['AGE_ID']) ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['AGE_DATA_HORA'])) ?>" required>
            <br><br>

            <label>Motivo:</label><br>
            <input type="text" id="motivo" name="motivo" value="<?= $agendamento['AGE_MOTIVO'] ?>" required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" value="<?= $agendamento['AGE_STATUS'] ?>" required>
            <br><br>

            <label>IMOVEL:</label><br>
            <select id="IMOVEL" name="IMOVEL" required>
                <?php foreach($IMOVEL as $imo): ?>
                    <option value="<?= $imo['IMO_ID'] ?>"
                        <?= $imo['IMO_ID'] == $agendamento['FK_IMO_ID'] ? 'selected' : '' ?>>
                        <?= $imo['IMO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>PROPRIETARIO:</label><br>
            <select id="PROPRIETARIO" name="PROPRIETARIO" required>
                <?php foreach($PROPRIETARIO as $pro): ?>
                    <option value="<?= $pro['PRO_ID'] ?>"
                        <?= $pro['PRO_ID'] == $agendamento['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $pro['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_agendamento" name="editar_agendamento" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('agendamento') ?>"><button>Voltar</button></a>
    </body>
</html>