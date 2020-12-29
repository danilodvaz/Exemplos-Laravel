{{-- Extende um blade com algum layout base. 
    Nesse template existirá os @yield, que receberam os valores da @section --}}
@extends('layouts.principal')

{{-- É possível utilizar o section para passar valores mais simples --}}
@section('titulo', 'Exemplos Template')

{{-- Cria um bloco de código --}}
@section('conteudo')

    <h3>Exemplos</h3>

    {{-- Verifica se o nome da rota informado é a rota ativa.
        Aparentemente só funciona utilizando o nome da rota. --}}
    <p>Rota ativa {{request()->routeIs('nomeExemplosTemplate')}}</p>


    <h4>if-else</h4>
    @if (request()->routeIs('nomeExemplosTemplate'))
        Entrou no if
    @else
        Entrou no else
    @endif


    <h4>empty</h4>
    {{-- Verifica se a variável está vazia --}}
    @empty('')
        Variável vazia
    @endempty


    <h4>Estrutura de repetição</h4>
    <strong>for</strong>
    @for ($i = 0; $i < 3; $i++)
        <p>Valor de $i é {{ $i }}</p>
    @endfor

    <br/>

    <strong>foreach</strong>
    {{-- Ao utilizar o foreach, o Laravel cria um objeto chamado $loop, com informações sobre o array --}}
    @foreach ([1, 2, 3] as $i)
        <p>
            Valor de $i {{ $i }} |
            Indice: {{ $loop->index }} |
            Iteração: {{ $loop->iteration }} |
            Total: {{ $loop->count }} 
            
            @if ($loop->first)
                | Primeiro elemento
            @endif

            @if ($loop->last)
                | Último elemento
            @endif
        </p>
    @endforeach


    <h4>switch case</h4>
    {{-- Estrutura do switch --}}
    @switch(3)
        @case(1)
            Caso 1
            @break
        @case(2)
            Caso 2
            @break
        @default
            Default
    @endswitch


    {{-- É possível criar blocos de código separados em outros arquivos e chamar eles utilizando o component.
        O que estiver dentro do component, pode ser acessando no componente através da variável $slot.
        Também é possível passar valores para o componente, através de um array associativo, inclusive formatações. --}}
    <h4>Componente</h4>
    @component('componente.componenteExemplo', ['nome' => 'Jack Tequila'])
        <p>Slot que será passado para o componente</p>
        <p>Ele pega tudo que tiver dentro da tag componente</p>
    @endcomponent

    {{-- O Laravel permite registrar um component no arquivo "app\Providers\AppServiceProvider.php", criando uma nova tag --}}
    @componenteRegistrado(['nome' => 'Jack Tequila Registrado'])
    @endcomponenteRegistrado

@endsection