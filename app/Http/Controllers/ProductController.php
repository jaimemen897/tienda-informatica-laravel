<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $products = Product::orderBy('id')->search($search)->paginate(9);
        return view('products.index')
            ->with('products', $products)
            ->with('search', $search);
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create')
            ->with('categories', $categories)
            ->with('suppliers', $suppliers);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required'],
        ], $this->messages());

        Product::create($data);

        flash('Producto creado correctamente')->success();

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }
        return view('products.show')
            ->with('product', $product);
    }

    public function editImage($id)
    {
        $product = Product::find($id);
        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }
        return view('products.image')
            ->with('product', $product);
    }


    public function updateImage(Request $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], $this->messages());

        $diskStorage = Storage::disk('public');
        $image = $request->file('image');
        $extension = $image->extension();
        $path = $diskStorage->putFileAs('products', $image, "$id.$extension");
        if ($path) {
            $product->image = $path;
            $product->save();
        } else {
            flash('Error al subir la imagen')->error();
            return redirect()->route('product.index');
        }
        flash('Imagen actualizada correctamente')->success();
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('suppliers', $suppliers);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'stock' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'supplier_id' => ['required'],
        ]);

        $product = Product::find($id);

        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }

        $product->update($data);
        flash('Producto actualizado correctamente')->success();
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->route('product.index');
        }
        $product->delete();
        flash('Producto eliminado correctamente')->success();
        return redirect()->route('product.index');
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un número',
            'price.min' => 'El precio debe ser mayor a 0',
            'stock.required' => 'El stock es requerido',
            'image.required' => 'La imagen es requerida',
            'description.required' => 'La descripción es requerida',
            'category_id.required' => 'La categoría es requerida',
            'supplier_id.required' => 'El proveedor es requerido',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen de tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'El archivo debe pesar menos de 2048 KB',
        ];
    }
}
