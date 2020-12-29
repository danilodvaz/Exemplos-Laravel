<h3>Create</h3>

<form action="{{ route('controladorResource.store') }}" method="POST">
    {{-- @csrf cria um input escondido com o token para fazer a verificação --}}
    @csrf
    <input type="text" name="nome">
    <input type="submit" name="salvar">
</form>