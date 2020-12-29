<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorResource extends Controller
{
    private $dados = [
        ['id' => 1, 'nome' => 'Monitor'],
        ['id' => 2, 'nome' => 'CPU'],
        ['id' => 3, 'nome' => 'Mouse'],
        ['id' => 4, 'nome' => 'Teclado'],
        ['id' => 5, 'nome' => 'Cabos']
    ];

    public function __construct()
    {
        // Verifica se existe uma sessão chamada dados
        $dados = session('dados');

        if (empty($dados)) {
            session(['dados' => $this->dados]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = session('dados');
        $titulo = 'Exemplo CRUD';
        // O View já vai procurar os blades dentro da pasta views (resources\views)
        // Caso exista uma pasta dentro dela, deve ser utilizado o . para navegar
        // O compact é uma função do PHP que cria um array de outras variáveis e de valores.
        return view('viewControladorResource.index', compact('dados', 'titulo'));
        
        // Exemplos de como podem ser passados os parâmetros para o blade
        
        // return view('viewControladorResource.index', ['dados' => $dados, 'titulo' => $titulo]);

        // return view('viewControladorResource.index')
        //     ->with('dados', $dados)
        //     ->with('titulo', $titulo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('viewControladorResource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Pega a sessão de nome 'dados'
        $dados = session('dados');

        $id = end($dados)['id'] + 1;
        $nome = $request->nome;
        $dado = ['id' => $id, 'nome' => $nome];

        $dados[] = $dado;

        // Substitui a sessão 'dados'
        session(['dados' => $dados]);

        return redirect()->route('controladorResource.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados = session('dados');
        
        $index = $this->getIndex($id, $dados);
        $dado = $dados[$index];

        return view('viewControladorResource.info', compact('dado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = session('dados');
        
        $index = $this->getIndex($id, $dados);
        $dado = $dados[$index];

        return view('viewControladorResource.edit', compact('dado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = session('dados');
        $nome = $request->nome;

        $index = $this->getIndex($id, $dados);
        $dados[$index]['nome'] = $nome;

        session(['dados' => $dados]);
        
        return redirect()->route('controladorResource.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = session('dados');
        
        $index = $this->getIndex($id, $dados);
        array_splice($dados, $index, 1);

        session(['dados' => $dados]);

        return redirect()->route('controladorResource.index');
    }

    private function getIndex($id, $dados)
    {
        $ids = array_column($dados, 'id');
        $index = array_search($id, $ids);

        return $index;
    }
}
