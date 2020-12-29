{{-- O componente pode receber o conteúdo de onde está sendo chamado através da variável $slot --}}
<div>
    <p>Componentezim maroto do {{ $nome }}</p>
    {{ $slot }}
</div>