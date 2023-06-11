<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
class Users extends Component
{
    public $clients; // Define a public property to store the clients data

    public function mount()
    {
        $this->clients = Client::all(); // Retrieve all clients from the Client model
    }

    public function render()
    {
        return view('livewire.users', [
            'clients' => $this->clients, // Pass the clients data to the view
        ]);
    }
    public function View($id){
      $user = Client::find($id);

        dd( $user);
    }
    public function edit($id){
        $user= Client::find($id);
        return view('edit-user')->with('user', $user);

       
    }
    public function delete($id){
       
        $user = Client::find($id);

    if ($user) {
        $user->delete();
        Alert::success('Success', 'User deleted successfully!');
    } else {
        Alert::error('Error', 'User not found!');
    }

    return Redirect::back();
        
        
    }
    
}
