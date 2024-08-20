@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
    <h1>Lista de Produtos</h1>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">Adicionar Novo Produto</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>
                        @if ($produto->foto)
                            <img src="{{ Storage::url($produto->foto) }}" alt="Foto do produto" width="100">
                        @endif
                    </td>
                    <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                    <td>{{ $produto->categoria->nome }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Nenhum produto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
