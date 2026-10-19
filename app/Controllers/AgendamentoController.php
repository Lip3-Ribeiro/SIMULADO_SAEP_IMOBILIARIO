<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentoModel;
use App\Models\ImovelModel;
use App\Models\ProprietarioModel;

// Vincula o Agendamento ao IMOVEL (FK_IMO_ID) com seu respectivo Responsável (FK_PRO_ID)
class AgendamentoController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamento
        $model = new AgendamentoModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do IMOVEL e do responsável
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    IMOVEL.IMO_NOME,
                    PROPRIETARIO.PRO_NOME'
                )

                // Relaciona o agendamento ao IMOVEL
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Relaciona o agendamento ao responsável
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do IMOVEL
                    ->like('IMOVEL.IMO_NOME', $pesquisar)

                    // Pesquisa pelo nome do responsável
                    ->orLike('PROPRIETARIO.PRO_NOME', $pesquisar)

                    // Pesquisa pelo motivo
                    ->orLike('AGE_MOTIVO', $pesquisar)

                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTO.*,
                    IMOVEL.IMO_NOME,
                    PROPRIETARIO.PRO_NOME'
                )

                // Relaciona o IMOVEL ao agendamento
                ->join(
                    'IMOVEL',
                    'IMOVEL.IMO_ID = AGENDAMENTO.FK_IMO_ID'
                )

                // Relaciona o responsável ao agendamento
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = AGENDAMENTO.FK_PRO_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamento/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de IMOVEL
        $ImovelModel = new ImovelModel();

        // Instancia o Model de responsável
        $ProprietarioModel = new ProprietarioModel();

        // Busca todos os IMOVELs para preencher o SELECT
        $dados['IMOVEL'] = $ImovelModel->findAll();

        // Busca todos os responsáveis para preencher o SELECT
        $dados['PROPRIETARIO'] = $ProprietarioModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamento/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // IMOVEL escolhido no formulário
            'FK_IMO_ID' => $this->request->getPost('IMOVEL'),

            // Responsável escolhido no formulário
            'FK_PRO_ID' => $this->request->getPost('PROPRIETARIO')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentoModel = new AgendamentoModel();
        $ImovelModel = new ImovelModel();
        $ProprietarioModel = new ProprietarioModel();

        // Busca o agendamento pelo ID
        $dados['agendamento'] = $agendamentoModel->find($id);

        // Busca os IMOVELs para preencher o SELECT
        $dados['IMOVEL'] = $ImovelModel->findAll();

        // Busca os responsáveis para preencher o SELECT
        $dados['PROPRIETARIO'] = $ProprietarioModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamento/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_IMO_ID' => $this->request->getPost('IMOVEL'),
            'FK_PRO_ID' => $this->request->getPost('PROPRIETARIO')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentoModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamento'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}