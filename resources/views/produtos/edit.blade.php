@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <h1>Editar Produto</h1>

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto" class="form-control-file">
            @if ($produto->foto)
                <img src="{{ Storage::url($produto->foto) }}" alt="Foto do produto" width="100">
            @endif
            @error('foto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" class="form-control" step="0.01" value="{{ old('valor', $produto->valor) }}" required>
            @error('valor')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == old('categoria_id', $produto->categoria_id) ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ old('quantidade', $produto->quantidade) }}" required>
                @error('quantidade')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    @endsection
