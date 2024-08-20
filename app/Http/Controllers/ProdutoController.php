<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Produto;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'valor' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        // Manipula o upload do arquivo
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/fotos');
        } else {
            $fotoPath = null;
        }

        // Cria o novo produto
        Produto::create([
            'nome' => $request->nome,
            'foto' => $fotoPath,
            'valor' => $request->valor,
            'categoria_id' => $request->categoria_id,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all(); // Obtém todas as categorias para o campo de seleção
        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        // Valida os dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'valor' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        // Atualiza o caminho da foto se um novo arquivo for enviado
        if ($request->hasFile('foto')) {
            // Remove o arquivo antigo se existir
            if ($produto->foto) {
                Storage::delete($produto->foto);
            }
            $fotoPath = $request->file('foto')->store('public/fotos');
            $produto->foto = $fotoPath;
        }

        // Atualiza o produto com os novos dados
        $produto->nome = $request->nome;
        $produto->valor = $request->valor;
        $produto->categoria_id = $request->categoria_id;
        $produto->quantidade = $request->quantidade;
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        // Remove o arquivo da foto se existir
        if ($produto->foto) {
            Storage::delete($produto->foto);
        }

        // Exclui o produto
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }

}

