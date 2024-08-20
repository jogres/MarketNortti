@extends('layouts.app')

@section('content')
    <h1>Nova Venda</h1>

    <!-- Formulário para criar uma nova venda -->
    <form action="{{ route('vendas.store') }}" method="POST" id="venda-form">
        @csrf

        <div class="form-group">
            <label for="produto_id">Produto:</label>
            <select name="produto_id" id="produto_id" class="form-control" required>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}">
                        {{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('produto_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required>
            @error('quantidade')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registrar Venda</button>
    </form>

    <!-- Mensagem de erro caso a quantidade em estoque seja insuficiente -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
