<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::search($request->search)->orderBy('name', 'asc')->paginate(5);
        if ($clients){
            return view('clients.index')->with('clients', $clients);
        } else {
            flash('No hay clientes registrados')->warning();
            return view('clients.index');
        }
    }

    public function show($id)
    {
        $client = Client::find($id);
        if ($client) {
            return view('clients.show')->with('client', $client);
        } else {
            flash('Cliente no encontrado')->error();
            return redirect()->route('clients.index');
        }
    }

    public function store()
    {
        return view('clients.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|unique:clients,email',
            'password' => 'required|string|min:6|max:255',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->image = $client::$IMAGE_DEFAULT;
        $client->password = bcrypt($request->password);
        $client->save();
        flash('Cliente creado correctamente')->success();
        return redirect()->route('clients.index');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        if ($client) {
            return view('clients.edit')->with('client', $client);
        } else {
            flash('Cliente no encontrado')->error();
            return redirect()->route('clients.index');
        }
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if ($client){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:2',
                'email' => 'required|string|email|unique:clients,email,'.$id,
                'password' => 'required|string|min:6|max:255',
            ], $this->messages());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $client->name = $request->name;
            $client->email = $request->email;
            $client->password = bcrypt($request->password);
            $client->save();
            flash('Cliente actualizado correctamente')->success();
        } else {
            flash('Cliente no encontrado')->error();
        }
        return redirect()->route('clients.index');
    }

    public function editImage($id)
    {
        $client = Client::find($id);
        if ($client) {
            return view('clients.edit-image')->with('client', $client);
        } else {
            flash('Cliente no encontrado')->error();
            return redirect()->route('clients.index');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $client = Client::find($id);
        if ($client){
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $imagePath = 'public/clients/' . $client->image;
            if ($client->image != $client::$IMAGE_DEFAULT && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $fileToSave = time() . $fileName;
            $image->storeAs('public/clients', $fileToSave);
            $client->image = $fileToSave;
            $client->save();
            flash('Imagen actualizada correctamente')->success();
        } else {
            flash('Cliente no encontrado')->error();
        }
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if ($client) {
            $imagePath = 'public/clients/' . $client->image;
            if ($client->image != $client::$IMAGE_DEFAULT && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $client->delete();
            flash('Cliente eliminado correctamente')->success();
        } else {
            flash('Cliente no encontrado')->error();
        }
        return redirect()->route('clients.index');
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'name.min' => 'El nombre debe tener mínimo 2 caracteres',
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email debe ser un email válido',
            'email.unique' => 'El email ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'password.max' => 'La contraseña debe tener máximo 255 caracteres',
        ];
    }
}
