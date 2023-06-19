<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class ContractController extends Controller
{
    //
    public function view()
    {
        $contracts = Contract::join('clients', 'clients.id', '=', 'contracts.owner_id')
            ->select('contracts.*', 'clients.name as owner_name', 'clients.phone as owner_phone', 'clients.country_code as owner_country_code')
            ->get();
 
        return view('contract.view')->with('contracts', $contracts);
    }
    public function edit($id)
{
    $contract = Contract::join('clients', 'clients.id', '=', 'contracts.owner_id')
        ->select('contracts.*', 'clients.name as owner_name','clients.nationalty_number as owner_nationalty_number', 'clients.phone as owner_phone', 'clients.country_code as owner_country_code')
        ->where('contracts.id', $id)
        ->first();

    // Check if the contract exists
    if (!$contract) {
        Alert::errorr('Error', 'Contract Not defined!');

    }
    return view('contract.edit')->with('contract', $contract);
}

   
}
