<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeNumber;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('employeeNumber:id,number,user_id')->get();
        // dd($users);
        return view('users.index',compact('users'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'employee_number_id' => 'required|unique:employee_number,number',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        $employeeNumber = new EmployeeNumber();
        $employeeNumber->number = $validatedData['employee_number_id'];
        $employeeNumber->user_id = $user->id;

        $employeeNumber->save();

        return redirect()->back()->with('success', 'Se creó el usuario correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('users.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $updateData = $request->only(['name', 'email', 'employee_number_id', 'password']);
        if (!empty($updateData)) {
            if ($user->employeeNumber->number != $updateData['employee_number_id']) {
                // 
                    $employee = EmployeeNumber::where('user_id',$user->id)->first();
                    $employee->number = $updateData['employee_number_id'];
                    $employee->save();

            }

            $user->fill($updateData);

            if (isset($updateData['password'])) {
                $request->validate([
                    'password' => 'required|string|min:8',
                ]);
                $user->password = bcrypt($updateData['password']);
            }

            $user->save();
        }

        return response()->json(['message' => 'Usuario actualizado', 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
}
