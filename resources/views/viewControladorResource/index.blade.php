<h3>{{ $titulo }}</h3>

{{-- Utilizando a classe 'route', é possível acessar as rotas pelos nomes --}}
<a href="{{ route('controladorResource.create') }}">Create</a>

<ul>
    @foreach ($dados as $dado)
        <li>
            {{ $dado['id'] }} | 
            {{ $dado['nome'] }} | 
            {{-- Utilizando a classe 'route', chamando a rota pelo nome e passando os parâmetros para ela --}}
            <a href="{{ route('controladorResource.edit', $dado['id']) }}">Edit</a> |
            <a href="{{ route('controladorResource.show', $dado['id']) }}">Show</a>

            <form action="{{ route('controladorResource.destroy', $dado['id']) }}" method="POST">
                {{-- @csrf cria um input escondido com o token para fazer a verificação --}}
                @csrf
                {{-- Não é possível enviar requisição do tipo DELETE de um formulário HTML
                    Para isso, é possível utilizar o '@method' disponibilizado pelo Laravel,
                    que possibilita escolher qual método será utilizado na requisição.
                    Vai chegar um POST, mas o Laravel vai reconhecer como DELETE. --}}
                @method('DELETE')
                <input type="submit" value="Destroy">
            </form>
        </li>
    @endforeach
</ul>