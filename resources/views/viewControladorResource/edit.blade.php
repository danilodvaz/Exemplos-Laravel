<h3>Create</h3>

<form action="{{ route('controladorResource.update', $dado['id']) }}" method="POST">
    {{-- @csrf cria um input escondido com o token para fazer a verificação --}}
    @csrf
    {{-- Não é possível enviar requisição do tipo PUT de um formulário HTML
        Para isso, é possível utilizar o '@method' disponibilizado pelo Laravel,
        que possibilita escolher qual método será utilizado na requisição.
        Vai chegar um POST, mas o Laravel vai reconhecer como PUT. --}}
    @method('PUT')
    <input type="text" name="id" value="{{ $dado['id'] }}" readonly>
    <input type="text" name="nome" value="{{ $dado['nome'] }}">
    <input type="submit" name="salvar">
</form>