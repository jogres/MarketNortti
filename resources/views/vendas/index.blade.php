@extends('layouts.app')

@section('title', 'Lista de Vendas')

@section('content')
    <h1>Lista de Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Nova Venda</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor Total</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->produto->nome }}</td>
                    <td>{{ $venda->quantidade }}</td>
                    <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhuma venda registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
