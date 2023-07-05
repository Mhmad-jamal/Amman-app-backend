<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
class SubsicriptionController extends Controller
{
    public function view()
    {
        $clients = Client::where('customer_type', 'owner')->get();

        return view('subsicription.view', ['clients' => $clients]);
    }
  

   
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payment_amount' => 'required|numeric',
        ], [
            'client_id.required' => 'حقل اسم العميل مطلوب.',
            'client_id.exists' => 'العميل المحدد غير موجود.',
            'start_date.required' => 'حقل تاريخ البداية مطلوب.',
            'start_date.date' => 'تاريخ البداية يجب أن يكون تاريخ صالح.',
            'end_date.required' => 'حقل تاريخ النهاية مطلوب.',
            'end_date.date' => 'تاريخ النهاية يجب أن يكون تاريخ صالح.',
            'payment_amount.required' => 'حقل مبلغ الدفع مطلوب.',
            'payment_amount.numeric' => 'مبلغ الدفع يجب أن يكون قيمة رقمية.',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            Alert::error('خطأ', implode('<br>', $errors))->persistent(true)->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $subscription = Subscription::create($request->all());
    
        // Update the client's status to 1
        $clientId = $request->input('client_id');
        $client = Client::find($clientId);
        if ($client) {
            $client->active = 1;
            $client->save();
        }
    
        Alert::success('تم', 'تم اضافة الأشتراك بنجاح')->persistent(true)->autoClose(3000);
    
        return redirect()->back();
    }
    public function details($id){
        $client = Client::where('clients.id', $id)->first();
        $subscriptions = Subscription::where('client_id', $id)->get();

        return view('subsicription.details')->with('user',$client)->with('subscriptions',$subscriptions);

    }
    public function edit($id){
        $client = Client::where('clients.id', $id)->first();
        $subscriptions = Subscription::where('client_id', $id)->get();

        return view('subsicription.edit')->with('user',$client)->with('subscriptions',$subscriptions);

    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $subscription = Subscription::find($id);
    
        if (!$subscription) {
            return response()->json(['message' => 'عذرا هذا الأشتراك غير موجود'], 404);
        }
    
        $subscription->delete();
    
        // Show SweetAlert confirmation
        Alert::success('تم الحذف', 'تم حذف الاشتراك بنجاح')->persistent(true)->autoClose(3000);
    
        // Redirect back to the previous page
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $id=$request->input('id');
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payment_amount' => 'required|numeric',
        ], [
            'start_date.required' => 'حقل تاريخ البداية مطلوب.',
            'start_date.date' => 'تاريخ البداية يجب أن يكون تاريخ صالح.',
            'end_date.required' => 'حقل تاريخ النهاية مطلوب.',
            'end_date.date' => 'تاريخ النهاية يجب أن يكون تاريخ صالح.',
            'payment_amount.required' => 'حقل مبلغ الدفع مطلوب.',
            'payment_amount.numeric' => 'مبلغ الدفع يجب أن يكون قيمة رقمية.',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            Alert::error('خطأ', implode('<br>', $errors))->persistent(true)->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $subscription = Subscription::find($id);
        if (!$subscription) {
            Alert::error('خطأ', 'الأشتراك المحدد غير موجود.')->persistent(true)->autoClose(5000);
            return redirect()->back();
        }
    
        $subscription->update($request->all());
    
        // Update the client's status to 1
        $clientId = $request->input('client_id');
        $client = Client::find($clientId);
        if ($client) {
            $client->active = 1;
            $client->save();
        }
    
        Alert::success('تم', 'تم تحديث الأشتراك بنجاح')->persistent(true)->autoClose(3000);
    
        return redirect()->back();
    }
    public function getsubsicription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer', // Validate 'id' parameter as a required integer
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 201,
            ], 400);
        }
    
        $id = $request->input('id');
        $subscriptions = Subscription::where('client_id', $id)->get();
    
        return response()->json([
            'message' => 'Subscriptions retrieved successfully',
            'data' => $subscriptions,
            'status' => 200,
        ]);
    }
    
    
    
}
