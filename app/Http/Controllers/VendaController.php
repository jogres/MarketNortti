<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Venda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {

        $vendas = Venda::all();
        return view('vendas.index', compact('vendas'));
    }
    public function create()
    {
        $produtos = Produto::where('quantidade', '>', 0)->get(); // Obtém produtos com estoque disponível
        return view('vendas.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        // Validação para garantir que todos os campos sejam preenchidos e que 'quantidade' seja um inteiro
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',  // Garante que a quantidade seja um inteiro e no mínimo 1
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($produto->quantidade < $request->quantidade) {
            return redirect()->back()->withErrors('Quantidade em estoque insuficiente.');
        }

        $valor_total = $produto->valor * $request->quantidade;

        Venda::create([
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'valor_total' => $valor_total,
        ]);
    
        $produto->decrement('quantidade', $request->quantidade);

        return redirect()->route('vendas.create');
    }
}
