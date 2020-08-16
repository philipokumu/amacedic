<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Http\Requests\AdminProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the Admins
     *
     * @param  \App\Admin  $model
     * @return \Illuminate\View\View
     */
    public function index(Admin $model)
    {
        $owner = 'admin';
        return view('admin.profile.admin.otherprofiles.index', ['profiles' => $model->paginate(15)], compact('owner'));
    }

    /**
     * Show the form for creating a new Admin
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.profile.admin.otherprofiles.create');
    }

    /**
     * Store a newly created Admin in storage
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Admin  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Admin $model)
    {
        $this->authorize('create', Admin::class);

        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admin.admin.index')->with('success','Admin successfully created.');
    }

    /**
     * Show the form for editing the specified Admin
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\View\View
     */
    public function edit(Admin $admin)
    {
        $owner = 'admin';

        $profile = $admin;

        return view('admin.profile.admin.otherprofiles.edit', compact('profile','owner'));
    }

    public function show(Admin $admin)
    {

        $profile = $admin;

        $owner = 'admin';

        return view('admin.profile.admin.otherprofiles.show', compact('profile', 'owner'));
    }

    /**
     * Update the specified Admin in storage
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminProfileRequest $request, Admin $admin)
    {
        if ($request->has('profilePhoto')) {

            $file = $request->profilePhoto;
    
            $fileExtension = $file->getClientOriginalExtension();
    
            $fileOldName = $admin->profilePhoto;
            $fileNewName = 'admin'.$admin->id.".".$fileExtension;
    
            if ($fileOldName!=NULL) {
    
                unlink(public_path("storage\\profilephotos")."\\".$fileOldName);
    
            }
    
                $file->storeAs('profilephotos', $fileNewName,'public');
    
                $admin->update([
                    'profilePhoto'=>$fileNewName,
                    'name'=>$request->name,
                    'status'=>$request->status,
                    'nickname'=>$request->nickname,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
        
                ]);
        }
        else {
            $admin->update([
                'name'=>$request->name,
                'status'=>$request->status,
                'nickname'=>$request->nickname,
                'email'=>$request->email,
                'country'=>$request->country,
                'phone'=>$request->phone,
            ]);
        }

        return redirect()->back()->with('success','Your infomation is successfully updated.');
    }

    /**
     * Remove the specified Admin from storage
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        if ($admin->id == 1) {

            return back()->with('info', 'You cannot delete the super admin!!');

        } else {

            $admin->delete();

            return redirect()->route('admin.admin.index')->with('success','Admin successfully deleted.');
        }


    }

    public function password(PasswordRequest $request,Admin $admin)
    {
        $admin->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success','Password successfully updated.');
    }

    public function payment(Request $request, Admin $admin)
    {
        $paymentDetails = Validator::make($request->all(), [
            'accountType'=>'required',
            'bankName'=>'bail|required_if:accountType,bank',
            'accountName'=>'required|min:3',
            'accountNumber'=>'required|min:10',
        ]);

        if ($paymentDetails->fails()) {
            return back() ->withErrors($paymentDetails)
                          ->withInput(['tab' => 'payment']);
        }

        $admin->update([
            'accountType'=>$request->accountType,
            'bankName'=>$request->bankName,
            'accountName'=>$request->accountName,
            'accountNumber'=>$request->accountNumber, 
        ]);
        
        return redirect()->back()->with('success','Payment details successfully updated.')
                                ->withInput(['tab' => 'payment']);
    }
}
