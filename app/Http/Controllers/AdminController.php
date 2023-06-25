<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function view()
{
    $users = Admin::join('user_role', 'users.id', '=', 'user_role.user_id')
                 ->select('users.*', 'user_role.role')
                 ->get();
    return view('admin.view')->with('users', $users);
}
public function details($id){
    $users = Admin::join('user_role', 'users.id', '=', 'user_role.user_id')
    ->select('users.*', 'user_role.role')
    ->where('users.id', $id)
    ->first();
    return view('admin.details')->with('user',$users);
    
}
public function edit($id){
    $users = Admin::join('user_role', 'users.id', '=', 'user_role.user_id')
    ->select('users.*', 'user_role.role')
    ->where('users.id', $id)
    ->first();
    return view('admin.edit')->with('user',$users);
    
}

public function editPassowrd(Request $request ){
    
        // Validate the input data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:8',
        ]);
    
        // Get the user by their ID
        $user = Admin::findOrFail($request->input('user_id'));
    
        // Verify the current password
       
    
        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    
        Alert::success('Password changed successfully')->persistent(true);
    
        return redirect()->back();
    
}



public function update(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $request->input('id'),
        'gender' => 'required',
        'address' => 'required',
        'number' => 'required',
        'city' => 'required',
        'ZIP' => 'required',
    ]);

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $errorMessage = implode('<br>', $errors);

        Alert::error('Validation Error', $errorMessage)->html()->autoClose(5000);

        return redirect()->back()->withInput();
    }

    $id = $request->input('id');
    $user = Admin::find($id);
    $user->email = $request->input('email');

    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->gender = $request->input('gender');
    $user->address = $request->input('address');
    $user->number = $request->input('number');
    $user->city = $request->input('city');
    $user->ZIP = $request->input('ZIP');
    $user->save();

    Alert::success('Success', 'User updated successfully')->autoClose(3000);

    return redirect()->back();
}
public function delete($id){
    $user = Admin::findOrFail($id);
    $user->delete();
    Alert::success('Success', 'Resource deleted successfully.');

    // Redirect back
    return redirect()->back();
}


}
