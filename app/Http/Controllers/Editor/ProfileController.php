<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Editor;
use App\SubjectArea;
use App\Http\Requests\EditorProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:editor');
    }
    /**
     * Display a listing of the Editors
     *
     * @param  \App\Editor  $model
     * @return \Illuminate\View\View
     */
    public function index(Editor $model)
    {
        //
    }

    /**
     * Show the form for creating a new Editor
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Editor in storage
     *
     * @param  \App\Http\Requests\EditorRequest  $request
     * @param  \App\Editor  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Editor $model)
    {
        //
    }

    /**
     * Show the form for editing the specified Editor
     *
     * @param  \App\Editor  $editor
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $subjects = SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'editor'])->pluck('subjectArea');

        $owner = 'editor';
        
        return view('editor.profile.edit', compact('subjects','owner'));
    }

    /**
     * Update the specified Editor in storage
     *
     * @param  \App\Http\Requests\EditorRequest  $request
     * @param  \App\Editor  $editor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditorProfileRequest $request, Editor $editor)
    {
        if ($request->has('profilePhoto')) {
            
            $file = $request->profilePhoto;
    
            $fileExtension = $file->getClientOriginalExtension();
    
            $fileOldName = auth()->user()->profilePhoto;
            $fileNewName = 'Editor'.auth()->id().".".$fileExtension;
    
            if ($fileOldName!=NULL) {
    
                unlink(public_path("storage\\profilephotos")."\\".$fileOldName);
    
            }
    
                $file->storeAs('profilephotos', $fileNewName,'public');
    
                auth()->user()->update([
                    'profilePhoto'=>$fileNewName,
                    'name'=>$request->name,
                    'nickname'=>$request->nickname,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'phone'=>$request->phone,
        
                ]);
        }

        else {
            auth()->user()->update([
                'name'=>$request->name,
                'nickname'=>$request->nickname,
                'email'=>$request->email,
                'country'=>$request->country,
                'phone'=>$request->phone,
            ]);
        }

        return redirect()->back()->with('success','Your infomation is successfully updated.');
    }

    /**
     * Remove the specified Editor from storage
     *
     * @param  \App\Editor  $editor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Editor  $editor)
    {
        $editor->delete();

        return redirect()->route('Editor.index')->with('success','Editor successfully deleted.');
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success','Password successfully updated.');
    }

    public function education(Request $request)
    {
        $education = Validator::make($request->all(), [
            'educationLevel'=>'required',
            'bio'=>'required|min:3',
            'subjectArea'=>'required',
        ]);

        if ($education->fails()) {
            return back() ->withErrors($education)
                          ->withInput(['tab' => 'education']);
        }

        auth()->user()->update($request->all());

        $subjectAreas = $request->subjectArea;

        SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'editor'])->delete();

        foreach ($subjectAreas as $subject) {
            SubjectArea::create([
                'account_id'=>auth()->id(),
                'accountType'=>'editor',
                'subjectArea'=>$subject,
            ]);
        }

        return redirect()->back()->with('success','Education successfully updated.')
                                ->withInput(['tab' => 'education']);
    }

    public function payment(Request $request)
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

        auth()->user()->update([
            'accountType'=>$request->accountType,
            'bankName'=>$request->bankName,
            'accountName'=>$request->accountName,
            'accountNumber'=>$request->accountNumber, 
        ]);
        
        return redirect()->back()->with('success','Payment details successfully updated.')
                                ->withInput(['tab' => 'payment']);
    }
    public function editpayment()
    {
        return redirect()->route('editor.profile.edit')->withInput(['tab' => 'payment']);
    }
}
