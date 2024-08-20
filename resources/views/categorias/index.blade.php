@extends('layouts.app')

@section('title', 'Lista de Categorias')

@section('content')
    <h1>Lista de Categorias</h1>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Nova Categoria</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Código</th>
                <th>Ícone</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->codigo }}</td>
                    <td>
                        @if ($categoria->icone)
                            <img src="{{ Storage::url($categoria->icone) }}" alt="Ícone da categoria" width="50">
                        @else
                            Nenhum ícone
                        @endif
                    </td>
                    <td>{{ $categoria->descricao }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma categoria registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
