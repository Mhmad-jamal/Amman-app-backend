<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Profile extends Component
{
    public User $user;
    public $showSavedAlert = false;
    public $showDemoNotification = false;

    public function rules() {

        return [
            'user.first_name' => 'max:15',
            'user.last_name' => 'max:20',
            'user.email' => 'email',
            'user.gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'user.address' => 'max:40',
            'user.number' => 'numeric',
            'user.city' => 'max:20',
            'user.ZIP' => 'numeric',
        ];
    }

    public function mount() { $this->user = auth()->user(); }

    public function save()
    {
        if(env('IS_DEMO')) {
            $this->showDemoNotification = true;
        }
        else {
        $this->validate();

        $this->user->save();

        $this->showSavedAlert = true;
        }
    }
    
    public function render()
    {
        return view('livewire.profile');
    }
    
    public function editPassword(Request $request)
    {
        // Validate the input data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_password' => 'required|min:8',
        ]);
    
        // Get the user by their ID
        $user = User::findOrFail($request->input('user_id'));
    
        // Verify the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            Alert::error('Current password is incorrect')->persistent(true);
            return redirect()->back();
        }
    
        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    
        Alert::success('Password changed successfully')->persistent(true);
    
        return redirect()->back();
    }
   
    
}
