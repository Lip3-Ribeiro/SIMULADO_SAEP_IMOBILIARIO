<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietarioModel;

class ProprietarioController extends BaseController
{
    // Exibe a listagem de PROPRIETARIO
    public function index()
    {
        // Instancia o Model responsável pela tabela PROPRIETARIO
        $model = new ProprietarioModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca responsaveis que possuem o termo informado
            // no nome ou data de nascimento
            $dados['PROPRIETARIO'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_DATA_NASCIMENTO', $pesquisar)
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os responsaveis cadastrados
            $dados['PROPRIETARIO'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os responsáveis encontrados
        return view('sistema/PROPRIETARIO/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo PROPRIETARIO
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/PROPRIETARIO/novo_PROPRIETARIO');
    }


    // Insere um novo PROPRIETARIO no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Insere o novo PROPRIETARIO no banco
        $model->insert($dados);

        // Redireciona para a listagem de PROPRIETARIO
        return redirect()
            ->to(base_url('PROPRIETARIO'))
            ->with('success', 'PROPRIETARIO cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um PROPRIETARIO
    public function editar($id)
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Busca o PROPRIETARIO pelo ID recebido na URL
        $dados['PROPRIETARIO'] = $model->find($id);

        // Carrega a View de edição enviando os dados do PROPRIETARIO
        return view('sistema/PROPRIETARIO/editar_proprietario', $dados);
    }


    // Atualiza os dados de um PROPRIETARIO
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ProprietarioModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento')
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('PROPRIETARIO'))
            ->with('success', 'PROPRIETARIO atualizado com sucesso!');
    }


    // Exclui um PROPRIETARIO
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ClieteModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('PROPRIETARIO'))
            ->with('success', 'PROPRIETARIO excluído com sucesso!');
    }
}