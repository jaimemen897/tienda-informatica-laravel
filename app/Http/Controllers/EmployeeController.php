<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::search($request->search)->orderBy('name', 'asc')->paginate(8);
        if ($employees) {
            return view('employees.index')->with('employees', $employees);
        } else {
            flash('No hay empleados registrados')->warning();
            return view('employees.index');
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return view('employees.show')->with('employee', $employee);
        } else {
            flash('Empleado no encontrado')->error();
            return redirect()->route('employee.index');
        }
    }

    public function store()
    {
        return view('employees.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'surname' => 'required|string|max:255|min:2',
            'phone' => 'required|string|max:9|min:9',
            'salary' => 'required|numeric',
            'position' => ['required', Rule::in(['Manager', 'Developer', 'Designer', 'Tester', 'Sales'])], 'email' => 'required|string|email|unique:employees,email',
            'password' => 'required|string|min:6|max:255',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->image = $employee::IMAGE_DEFAULT;
        $employee->password = bcrypt($request->password);
        $employee->save();
        flash('Empleado creado correctamente')->success();
        return redirect()->route('employee.index');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return view('employees.edit')->with('employee', $employee);
        } else {
            flash('Empleado no encontrado')->error();
            return redirect()->route('employee.index');
        }
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|min:2',
                'surname' => 'required|string|max:255|min:2',
                'phone' => 'required|string|max:9|min:9',
                'salary' => 'required|numeric',
                'position' => ['required', Rule::in(['Manager', 'Developer', 'Designer', 'Tester', 'Sales'])],
                'email' => ['required', 'string', 'email', Rule::unique('employees')->ignore($employee->id)],
            ], $this->messages());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $employee->name = $request->name;
            $employee->surname = $request->surname;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->position = $request->position;
            $employee->email = $request->email;
            $employee->save();
            flash('Empleado actualizado correctamente')->success();
            return redirect()->route('employee.index');
        } else {
            flash('Empleado no encontrado')->error();
        }
        return redirect()->route('employee.index');
    }

    public function editImage($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return view('employees.image')->with('employee', $employee);
        } else {
            flash('Empleado no encontrado')->error();
            return redirect()->route('employee.index');
        }
    }

    public function updateImage(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            flash('No se ha encontrado el empleado')->error();
            return redirect()->route('employee.index');
        }
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], $this->messages());

        $diskStorage = Storage::disk('public');
        $image = $request->file('image');
        $extension = $image->extension();
        $path = $diskStorage->putFileAs('employees', $image, "$id.$extension");
        if ($path) {
            $employee->image = $path;
            $employee->save();
        } else {
            flash('Error al subir la imagen')->error();
            return redirect()->route('employee.index');
        }
        flash('Imagen actualizada correctamente')->success();
        return redirect()->route('employee.index');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $imagePath = 'public/employees/' . $employee->image;
            if ($employee->image != $employee::IMAGE_DEFAULT && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $employee->delete();
            flash('Empleado eliminado correctamente')->success();
        } else {
            flash('Empleado no encontrado')->error();
        }
        return redirect()->route('employee.index');
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'surname.required' => 'El apellido es obligatorio',
            'surname.string' => 'El apellido debe ser un texto',
            'surname.max' => 'El apellido no puede superar los 255 caracteres',
            'surname.min' => 'El apellido debe tener al menos 2 caracteres',
            'phone.required' => 'El teléfono es obligatorio',
            'phone.string' => 'El teléfono debe ser un texto',
            'phone.max' => 'El teléfono no puede superar los 9 caracteres',
            'phone.min' => 'El teléfono debe tener 9 caracteres',
            'salary.required' => 'El salario es obligatorio',
            'salary.numeric' => 'El salario debe ser un número',
            'position.required' => 'La posición es obligatoria',
            'position.in' => 'La posición no es válida',
            'email.required' => 'El email es obligatorio',
            'email.string' => 'El email debe ser un texto',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser un texto',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.max' => 'La contraseña no puede superar los 255 caracteres',
            'image.required' => 'La imagen es obligatoria',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser una imagen de tipo: jpeg, png, jpg, gif, svg',
            'image.max' => 'El archivo no puede superar los 2048 kilobytes',
        ];
    }
}
