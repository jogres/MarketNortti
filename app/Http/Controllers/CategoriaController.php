<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

     // Método para armazenar uma nova categoria
     public function store(Request $request)
     {
         $request->validate([
             'nome' => 'required|string|max:255',
             'codigo' => 'required|string|max:255',
             'icone' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validação para aceitar imagens
             'descricao' => 'nullable|string',
         ]);

         $data = $request->all();

         // Verifica se há um arquivo de ícone e faz o upload
         if ($request->hasFile('icone')) {
             $data['icone'] = $request->file('icone')->store('icons', 'public');
         }

         Categoria::create($data);

         return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
     }

    // Método para exibir o formulário de edição
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    // Método para atualizar uma categoria
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'icone' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validação para aceitar imagens
            'descricao' => 'nullable|string',
        ]);

        $data = $request->all();

        // Verifica se há um novo arquivo de ícone e faz o upload
        if ($request->hasFile('icone')) {
            // Remove o arquivo antigo se existir
            if ($categoria->icone) {
                Storage::disk('public')->delete($categoria->icone);
            }
            $data['icone'] = $request->file('icone')->store('icons', 'public');
        }

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Método para excluir a categoria
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}

