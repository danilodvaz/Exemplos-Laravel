<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

// Passando parâmetros nas rotas.
// Pode ser passado um ou mais parâmetros
Route::get('rotaComParametro/{param1}/{param2}', function ($param1, $param2) {
    echo "Teste rotas com parâmetros. Param1: $param1 e Param2: $param2";
});

// Parâmetros opcionais
// Deve ser colocado o '?' após o nome do parâmetro e inicializado a variável
// que a função recebe
Route::get('rotaComParametroOpcional/{id?}', function ($id = null) {
    echo "Rota com parâmetro opcional. Param: $id";
});

// É possível validar os parâmetros enviados pela rota utilizando o método
// 'where' e regex
Route::get('rotaComRegraParam/{id}/{nome}', function ($id, $nome) {
    echo "Rota com regras nos parâmetros";
})->where('id', '[0-9]+')
    ->where('nome', '[A-Za-z]+');


// Também é possível agrupar as rotas utilizando o método prefix
Route::prefix('/agrupador')->group(function () {
    Route::get('/', function () {
        echo "Principal";
    });

    Route::get('/outraRota', function () {
        echo "Uma outra rota dentro do agrupador";
    });

    Route::get('/maisUmaRota', function () {
        echo "Mais uma rota";
    });
});

// Nomeando rotas
// Ao nomear as rotas é possível realizar o acesso dentro do blade pelo nome
// utilizando a função helper com a sintaxe: {{route('nomeDaRota')}}
Route::get('rotaNomeada', function () {
    echo "Rota nomeada";
})->name('nomeDaRota');

// Redirecionamento de rotas
// Utilizando o redirect, ao acessar a rota1, ele irá direcionar para a nomeDaRota
Route::redirect('rota1', 'rotaNomeada', 301);

// Uma outra forma de realizar o redirecionamento
// Nesse caso, como é utilizado o a função route, é possível e indicado utilizar o 
// nome da rota para fazer o redirecionamento
Route::get('rota2', function () {
    return redirect()->route('nomeDaRota');
});

// Requisições do tipo post
// Para requisições que não utilizam o método GET, o Laravel utiliza autenticação da requisição
// através de um token.
// Para excluir essas rotas da verificação, pode ser adicionado no arquivo 
// app\Http\Middleware\VerifyCsrfToken.php uma excessão
Route::post('requisicaoPost', function (Request $request) {
    return 'Hello post';
});



// CONTROLLERS

// Para apontar a rota para um controlador, basta colocar 'NomeDaClasse@nomeDoMetodo'
Route::get('controlador', 'MeuControlador@algumMetodo');

Route::get('multiplicar/{n1}/{n2}', 'MeuControlador@multiplica')
    ->where('n1', '[0-9]+')
    ->where('n2', '[0-9]+');

Route::get('exemplosTemplate', function () {
    return view('viewMeuControlador.exemplos');
})->name('nomeExemplosTemplate');

// Utilizando o método resource para vincular a rota ao controlador, o Laravel vai procurar dentro
// do controlador por métodos chaves (index, create, store, show) e criar as rotas de forma automática
// para cada método chave. O Laravel já cria o nome da rota tbm.
// Funciona bem quando o controlador é criado com a propriedade --resource
Route::resource('controladorResource', 'ControladorResource');
