<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::todas_las_categorias();
        // dd($categries);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'Category_name' =>  $request->Category_name,
        ]);

        // return to_route('categories.index');
        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('categories.show')
            ->with('category', Category::categoria_por_id($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('categories.edit')
            ->with('category', Category::categoria_por_id($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::categoria_por_id($id);

        $category->update([
            'Category_name' =>  $request->Category_name,
        ]);

        return redirect()->route('categories.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::categoria_por_id($id);

        // $note->delete();
        $category->update([
            'active'     =>  false,
        ]);

        return redirect()->route('categories.index');
    }
}
