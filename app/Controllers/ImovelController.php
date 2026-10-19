<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietarioModel;
use App\Models\ImovelModel;

// Vincula o Imovels com seu respectivo PROPRIETARIO (FK_PRO_ID)
class ImovelController extends BaseController
{
    // Exibe a listagem de IMOVELs
    public function index()
    {
        // Instancia o Model de IMOVEL
        $model = new ImovelModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os IMOVELs juntamente com o nome do PROPRIETARIO
            // responsável por cada IMOVEL
            $dados['IMOVEL'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')

                // Relaciona PROPRIETARIO com PROPRIETARIO pela chave estrangeira
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pelo nome
                    ->like('IMO_NOME', $pesquisar)

                    // Pesquisa pela data de nascimento
                    ->orLike('IMO_VALOR', $pesquisar)

                    // Também permite pesquisar pelo nome do PROPRIETARIO
                    ->orLike('PROPRIETARIO.PRO_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os
            // juntamente com o nome dos respectivos responsaveis
            $dados['IMOVEL'] = $model
                ->select('IMOVEL.*, PROPRIETARIO.PRO_NOME')
                ->join(
                    'PROPRIETARIO',
                    'PROPRIETARIO.PRO_ID = IMOVEL.FK_PRO_ID'
                )
                ->findAll();
        }

        // Carrega a View de IMOVEL
        return view('sistema/IMOVEL/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo IMOVEL
    public function novo()
    {
        // Instancia o Model de PROPRIETARIO
        $ProprietarioModel = new ProprietarioModel();

        // Busca todos os PROPRIETARIO cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['PROPRIETARIO'] = $ProprietarioModel->findAll();

        // Carrega o formulário de cadastro do Imovel
        return view('sistema/IMOVEL/novo_IMOVEL', $dados);
    }


    // Insere um novo IMOVEL
    public function inserir()
    {
        // Instancia o Model de IMOVEL
        $model = new ImovelModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'IMO_NOME' => $this->request->getPost('nome'),
            'IMO_VALOR' => $this->request->getPost('valor'),
            'IMO_ENDERECO' => $this->request->getPost('endereco'),
            // Guarda o ID do PROPRIETARIO escolhido no formulário
            // como chave estrangeira do IMOVEL
            'FK_PRO_ID' => $this->request->getPost('PROPRIETARIO')
        ];

        // Insere o IMOVEL no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('IMOVEL'))
            ->with('success', 'IMOVEL cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de IMOVEL
        $ImovelModel = new ImovelModel();

        // Instancia o Model de PROPRIETARIO
        $ProprietarioModel = new ProprietarioModel();

        // Busca o IMOVEL que será editado
        $dados['IMOVEL'] = $ImovelModel->find($id);

        // Busca todos os responsáveis para preencher o SELECT
        $dados['PROPRIETARIO'] = $ProprietarioModel->findAll();

        // Carrega a View de edição
        return view('sistema/IMOVEL/editar_IMOVEL', $dados);
    }


    // Atualiza um IMOVEL
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ImovelModel();

        // Recupera os novos dados do formulário
        $dados = [
            'IMO_NOME' => $this->request->getPost('nome'),
            'VEI_DATA_NASCIMENTO' => $this->request->getPost('data_nascimento'),
            'IMO_ENDERECO' => $this->request->getPost('marca'),
            // Guarda o ID do PROPRIETARIO escolhido no formulário
            // como chave estrangeira do IMOVEL
            'FK_PRO_ID' => $this->request->getPost('PROPRIETARIO')
        ];

        // Atualiza o IMOVEL pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('IMOVEL'))
            ->with('success', 'IMOVEL atualizado com sucesso!');
    }


    // Exclui um IMOVEL
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ImovelModel();

        // Exclui o Imovel pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('IMOVEL'))
            ->with('success', 'Imovel excluído com sucesso!');
    }
}