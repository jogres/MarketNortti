@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
    <h1>Editar Categoria</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $categoria->codigo) }}" required>
            @error('codigo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="icone">Ícone:</label>
            <input type="file" name="icone" id="icone" class="form-control">
            @if ($categoria->icone)
                <img src="{{ Storage::url($categoria->icone) }}" alt="Ícone da categoria" width="50">
            @endif
            @error('icone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao', $categoria->descricao) }}</textarea>
            @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
@endsection
