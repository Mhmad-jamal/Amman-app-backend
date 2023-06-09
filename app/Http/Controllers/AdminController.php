<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserRole;


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
    ->select('users.*', 'user_role.Permission')
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
        'email' => [
            'sometimes',
            'required',
            'email',
            function ($attribute, $value, $fail) use ($request) {
                $userId = $request->input('id');
                $user = Admin::find($userId);
    
                if ($user && $user->email === $value) {
                    return; // Skip validation if the email remains the same
                }
    
                $count = Admin::where('email', $value)->count();
                if ($count > 0) {
                    $fail('تم استخدام البريد الإلكتروني بالفعل.');
                }
            },
        ],
        'gender' => 'required',
        'address' => 'required',
        'number' => 'required',
        'city' => 'required',
        'ZIP' => 'required',
    ], [
        'first_name.required' => 'حقل الاسم الأول مطلوب.',
        'last_name.required' => 'حقل اسم العائلة مطلوب.',
        'email.required' => 'حقل البريد الإلكتروني مطلوب.',
        'email.email' => 'يجب أن يكون حقل البريد الإلكتروني صالحًا.',
        'email.unique' => 'تم استخدام البريد الإلكتروني بالفعل.',
        'gender.required' => 'حقل الجنس مطلوب.',
        'address.required' => 'حقل العنوان مطلوب.',
        'number.required' => 'حقل الرقم مطلوب.',
        'city.required' => 'حقل المدينة مطلوب.',
        'ZIP.required' => 'حقل الرمز البريدي مطلوب.',
    ]);
    

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $errorMessage = implode('<br>', $errors);

        Alert::error('خطأ في التحقق', $errorMessage)->html()->autoClose(5000);

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

    Alert::success('تم بنجاح', 'تم تحديث المستخدم بنجاح')->autoClose(3000);

    return redirect()->back();
}

public function delete($id){
    $user = Admin::findOrFail($id);
    $user->delete();
    Alert::success('تم بنجاح', 'تم حذف المسؤول بنجاح.');

    // Redirect back
    return redirect()->back();
}
public function add(Request $request)
{
    // Validate the form data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'passwordConfirmation' => 'required|same:password',
    ], [
        'email.required' => 'حقل البريد الإلكتروني مطلوب.',
        'email.email' => 'يجب أن يكون حقل البريد الإلكتروني صالحًا.',
        'email.unique' => 'تم استخدام البريد الإلكتروني بالفعل.',
        'password.required' => 'حقل كلمة المرور مطلوب.',
        'password.min' => 'يجب أن تتكون كلمة المرور من الحد الأدنى للأحرف المسموح بها.',
        'passwordConfirmation.required' => 'حقل تأكيد كلمة المرور مطلوب.',
        'passwordConfirmation.same' => 'حقل تأكيد كلمة المرور يجب أن يتطابق مع حقل كلمة المرور.',
    ]);
    

    if ($validator->fails()) {
        $errors = $validator->errors()->all();
        $errorMessage = implode( $errors);

        Alert::error('خطأ في التحقق', $errorMessage)->html()->autoClose(5000);

        return redirect()->back()->withInput();
    }

    // Create a new Admin model instance
    $admin = new Admin;
    $admin->email = $request->input('email');
    $admin->password = Hash::make($request->input('password'));
    // Set any other properties as needed

    // Save the new admin
    $admin->save();

    // Create a new user_role record
    $userRole = new UserRole;
    $userRole->user_id = $admin->id;
    $userRole->role = 'admin';
    $userRole->Permission = json_encode([
        [
            "page" => "Dashboard",
            "pageId" => "dashboard",
            "action" => [
                "Show" => 1
            ]
        ],
        [
            "page" => "Client Page",
            "pageId" => "client_page",
            "action" => [
                "Show" => 1,
                "view_client" => 1,
                "edit_client" => 1,
                "delete_client" => 1
            ]
        ],
        [
            "page" => "subsicription Page",
            "pageId" => "subsicription",
            "action" => [
                "Show" => 1,
                "view_subsicription" => 1,
                "edit_subsicription" => 1,
                "delete_subsicription" => 1
            ]
        ],
        [
            "page" => "Properties",
            "pageId" => "properties",
            "action" => [
                "Show" => 1,
                "view_property" => 1,
                "edit_property" => 1,
                "delete_property" => 1
            ]
        ],
        [
            "page" => "Banner",
            "pageId" => "banner_Page",
            "action" => [
                "Show" => 1,
                "add_banner" => 1,

                "view_banner" => 1,
                "edit_banner" => 1,
                "delete_banner" => 1
            ]
        ],
        [
            "page" => "Contract",
            "pageId" => "contract_page",
            "action" => [
                "Show" => 1,
                "view_all_contract" => 1,
                "view_check_request" => 1
            ]
        ],
        [
            "page" => "All Contract",
            "pageId" => "all_contract_page",
            "action" => [
                "view_contract" => 1,
                "edit_contract" => 1,
                "delete_contract" => 1
            ]
        ],
        [
            "page" => "Check Request",
            "pageId" => "Check_request",
            "action" => [
                "Approve" => 1,
                "Reject" => 1
            ]
        ],
        [
            "page" => "Order Page",
            "pageId" => "order_page",
            "action" => [
                "Show" => 1,
                "view_maintenance_order" => 1,
                "view_general_order" => 1
            ]
        ],
        [
            "page" => " Orders",
            "pageId" => "orders",
            "action" => [
                "View" => 1,
                "Approve" => 1,
                "Reject" => 1
            ]
        ],
   
        [
            "page" => "Admin Page",
            "pageId" => "admin_page",
            "action" => [
                "Show" => 1,
                "view" => 1,
                "edit" => 1,
                "delete" => 1
            ]
        ]
    ]);
        // Set any other properties as needed

    // Save the new user_role record
    $userRole->save();

    Alert::success('تم الإنشاء', 'تم إنشاء المسؤول بنجاح.');
    return redirect()->back();
}
public function updatePermission(Request $request)
{
    $id = $request->input('id');
    $permission = $request->input('permission');
    
    UserRole::where('user_id', $id)->update([
        'Permission' => $permission,
    ]); 
    
    return response()->json([
        'status' => 200,
        'message' => 'تم تحديث الصلاحيات بنجاح.',
        'permission' => $permission
    ]);
}

}




