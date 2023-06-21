<?php

namespace App\Http\Controllers;

use PDF;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Client;

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
    public function details($id)
    {
        $contract = Contract::join('clients', 'clients.id', '=', 'contracts.owner_id')
            ->select('contracts.*', 'clients.name as owner_name','clients.nationalty_number as owner_nationalty_number', 'clients.phone as owner_phone', 'clients.country_code as owner_country_code')
            ->where('contracts.id', $id)
            ->first();
    
        // Check if the contract exists
        if (!$contract) {
            Alert::errorr('Error', 'Contract Not defined!');
    
        }
        return view('contract.details')->with('contract', $contract);
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


public function ContractPdf($id)
{
  /*   $html = view('contract.contract_pdf')->render();

    $pdf = PDF::loadHTML($html);

    // (Optional) Configure the PDF output

    // Output the generated PDF to the browser
    return $pdf->stream('document.pdf'); */
    $contract = Contract::join('clients', 'clients.id', '=', 'contracts.owner_id')
    ->select('contracts.*', 'clients.name as owner_name', 'clients.nationalty_number as owner_nationalty_number', 'clients.phone as owner_phone', 'clients.country_code as owner_country_code', 'clients.email as owner_email')
    ->where('contracts.id', $id)
    ->first();

if ($contract) {
    $ownerNationalityNumber = $contract->user_national_number;

    $client = Client::where('nationalty_number', $ownerNationalityNumber)->first();
    // Use $clients for further processing or display
    return view('contract.contract_pdf')->with('contract', $contract)->with('client', $client);
} else {
    // Handle the case when the contract is not found
    // For example, return an error message or redirect
}





}

   
}
