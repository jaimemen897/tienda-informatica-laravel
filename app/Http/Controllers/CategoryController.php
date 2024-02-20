<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withTrashed()->search($request->input('search'))->orderBy('id')->paginate(10);
        return view('category.index')
            ->with('categories', $categories);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ], $this->messages());

        Category::create($data);

        flash('La categoría ha sido creada')->success();

        return redirect()->route('category.index');
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }
        return view('category.show')
            ->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ], $this->messages());


        $category = Category::find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }

        $category->update($data);
        flash('La categoría ha sido actualizada')->success();

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }
        return view('category.edit')
            ->with('category', $category);
    }


    public function deactivate($id)
    {
        $category = Category::find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }
        if ($category->trashed()) {
            flash('La categoría ya está desactivada')->error();
            return redirect()->route('category.index');
        }
        $category->delete();
        flash('La categoría ha sido desactivada')->success();
        return redirect()->route('category.index');
    }

    public function activate($id)
    {
        $category = Category::withTrashed()->find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }
        if (!$category->trashed()) {
            flash('La categoría ya está activada')->error();
            return redirect()->route('category.index');
        }
        $category->restore();
        flash('La categoría ha sido activada')->success();
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            flash('La categoría no existe')->error();
            return redirect()->route('category.index');
        }
        if ($category->products->count() > 0) {
            flash('La categoría no puede ser eliminada porque tiene productos asociados')->error();
            return redirect()->route('category.index');
        }
        $category->forceDelete();
        flash('La categoría ha sido eliminada')->success();
        return redirect()->route('category.index');
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'El nombre ya existe',
        ];
    }
}
