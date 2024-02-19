<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::search($request->search)->orderBy('name', 'asc')->paginate(6);
        if ($suppliers) {
            return view('suppliers.index')->with('suppliers', $suppliers);
        } else {
            flash('No hay proveedores registrados')->warning();
            return view('suppliers.index');
        }
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return view('suppliers.show')->with('supplier', $supplier);
        } else {
            flash('Proveedor no encontrado')->error();
            return redirect()->route('supplier.index');
        }
    }

    public function store(Request $request)
    {
        return view('suppliers.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'contact' => 'required|integer',
            'address' => 'required|string|max:255|min:2',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->contact = $request->contact;
        $supplier->address = $request->address;
        $supplier->save();
        flash('Proveedor creado correctamente')->success();
        return redirect()->route('supplier.index');
    }


    public function edit($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return view('suppliers.edit')->with('supplier', $supplier);
        } else {
            flash('Proveedor no encontrado')->error();
            return redirect()->route('supplier.index');
        }
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:2',
                'contact' => 'required|integer',
                'address' => 'required|string|max:255|min:2',
            ], $this->messages());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $supplier->name = $request->name;
            $supplier->contact = $request->contact;
            $supplier->address = $request->address;
            $supplier->save();
            flash('Proveedor actualizado correctamente')->success();
            return redirect()->route('supplier.index');
        } else {
            flash('Proveedor no encontrado')->error();
        }
        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->delete();
            flash('Proveedor eliminado correctamente')->success();
        } else {
            flash('Proveedor no encontrado')->error();
        }
        return redirect()->route('supplier.index');
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre no puede tener más de 255 caracteres',
            'name.min' => 'El nombre no puede tener menos de 2 caracteres',
            'contact.required' => 'El contacto es obligatorio',
            'contact.integer' => 'El contacto debe ser un número',
            'address.required' => 'La dirección es obligatoria',
            'address.string' => 'La dirección debe ser un texto',
            'address.max' => 'La dirección no puede tener más de 255 caracteres',
            'address.min' => 'La dirección no puede tener menos de 2 caracteres',
        ];
    }
}
