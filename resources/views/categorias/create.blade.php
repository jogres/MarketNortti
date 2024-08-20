@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
    <h1>Criar Categoria</h1>

    <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}" required>
            @error('codigo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="icone">Ícone:</label>
            <input type="file" name="icone" id="icone" class="form-control">
            @error('icone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control">{{ old('descricao') }}</textarea>
            @error('descricao')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
