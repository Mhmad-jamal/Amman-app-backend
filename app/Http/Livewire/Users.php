<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Models\PropertyModel;
use Illuminate\Support\Facades\Validator;


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
        $properties = PropertyModel::where('owner_id', $id)
        ->where('status', '!=', '2')
        ->get();
        $orders = Order::where('client_id',$id)->get();  
        return view('view-user')->with('user', $user)->with('properties', $properties)->with('orders',$orders);
    }
    public function edit($id){
        $user = Client::find($id);
        $properties = PropertyModel::where('owner_id', $id)
        ->where('status', '!=', '2')
        ->get();   
        $orders = Order::where('client_id',$id)->get();  

        return view('edit-user')->with('user', $user)->with('properties', $properties)->with('orders',$orders);
    }
        

       
    
    public function editUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:clients,id',
        'name' => 'required',
        'country_code' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'nationalty_number' => 'required|min:6|max:10|unique:clients,nationalty_number,' . $request->input('id'),
        'customer_type' => 'required',
        'status' => 'required|in:0,1',
        ], [
        'id.required' => 'حقل الهوية مطلوب.',
        'id.exists' => 'العميل المحدد غير موجود.',
        'name.required' => 'حقل الاسم مطلوب.',
        'country_code.required' => 'حقل رمز الدولة مطلوب.',
        'phone.required' => 'حقل الهاتف مطلوب.',
        'email.required' => 'حقل البريد الإلكتروني مطلوب.',
        'nationalty_number.required' => 'حقل الرقم الوطني مطلوب.',
        'nationalty_number.min' => 'يجب أن يحتوي حقل الرقم الوطني على الحد الأدنى من :min أحرف.',
        'nationalty_number.max' => 'يجب أن يحتوي حقل الرقم الوطني على الحد الأقصى من :max أحرف.',
        'nationalty_number.unique' => 'الرقم الوطني مُستخدم بالفعل.',
        'customer_type.required' => 'حقل نوع العميل مطلوب.',
        'status.required' => 'حقل الحالة مطلوب.',
        'status.in' => 'قيمة حقل الحالة يجب أن تكون مالك أو مستخدم فقط.',
        ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $id = $request->input('id');
    $client = Client::find($id);

    if (!$client) {
        return redirect()->back()->with('خطــأ', 'العميل غير موجود');
    }

    $client->name = $request->input('name');
    $client->email = $request->input('email');
    $client->country_code = $request->input('country_code');
    $client->phone = $request->input('phone');
    $client->nationalty_number = $request->input('nationalty_number');
    $client->customer_type = $request->input('customer_type');
    $client->active = $request->input('status');

    $client->save();
    Alert::success('نجاح', 'تم تحديث بيانات العميل بنجاح!');


    return redirect()->route('edit_user', ['id' => $id]);
}

    public function delete($id){
       
        $user = Client::find($id);

        if ($user) {
            $user->delete();
            Alert::success('نجاح', 'تم حذف العميل بنجاح!');
            } else {
            Alert::error('خطأ', 'المستخدم غير موجود!');
            }

    return Redirect::back();
        
        
    }
    
}
