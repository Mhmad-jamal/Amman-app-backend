<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubsicriptionController extends Controller
{
    public function view()
    {
        $clients = Client::where('customer_type', 'owner')->get();

        return view('subsicription.view', ['clients' => $clients]);
    }
}
