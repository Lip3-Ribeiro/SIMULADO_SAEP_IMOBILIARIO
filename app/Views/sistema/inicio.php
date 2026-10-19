<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Página Inicial</title>
    </head>
    <body>
        <h1>Página Inicial</h1>
        <h2>Oficina mecânica</h2>
        <h3>Bem vindo, <?= session()->get('usuario')['USU_NOME'] ?>!</h3>
        <a href="<?= base_url('PROPRIETARIO') ?>"><button>Gestão de PROPRIETARIOs</button></a>
        <a href="<?= base_url('IMOVEL') ?>"><button>Gestão de Imoveis</button></a>
        <a href="<?= base_url('agendamento') ?>"><button>Gestão de Agendamentos</button></a>
        <a href="<?= base_url('logout') ?>"><button>Logout</button></a>
    </body>
</html>