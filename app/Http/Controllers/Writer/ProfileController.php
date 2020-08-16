<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Writer;
use App\SubjectArea;
use App\Http\Requests\WriterProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:writer');
    }
    /**
     * Display a listing of the Writers
     *
     * @param  \App\Writer  $model
     * @return \Illuminate\View\View
     */
    public function index(Writer $model)
    {
        //
    }

    /**
     * Show the form for creating a new Writer
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Writer in storage
     *
     * @param  \App\Http\Requests\WriterRequest  $request
     * @param  \App\Writer  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Writer $model)
    {
        //
    }

    /**
     * Show the form for editing the specified Writer
     *
     * @param  \App\Writer  $writer
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $subjects = SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'writer'])->pluck('subjectArea');

        $owner = 'writer';
        
        return view('writer.profile.edit', compact('subjects', 'owner'));
    }

    /**
     * Update the specified Writer in storage
     *
     * @param  \App\Http\Requests\WriterRequest  $request
     * @param  \App\Writer  $writer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WriterProfileRequest $request, Writer $writer)
    {
        $file = $request->profilePhoto;

        $fileExtension = $file->getClientOriginalExtension();

        $fileOldName = auth()->user()->profilePhoto;
        $fileNewName = 'writer'.auth()->id().".".$fileExtension;

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

        return redirect()->back()->with('success','Your infomation is successfully updated.');
    }

    /**
     * Remove the specified Writer from storage
     *
     * @param  \App\Writer  $writer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Writer  $writer)
    {
        $writer->delete();

        return redirect()->route('Writer.index')->with('success','Writer successfully deleted.');
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

        SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'writer'])->delete();

        foreach ($subjectAreas as $subject) {
            SubjectArea::create([
                'account_id'=>auth()->id(),
                'accountType'=>'writer',
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
        return redirect()->route('writer.profile.edit')->withInput(['tab' => 'payment']);
    }
}
