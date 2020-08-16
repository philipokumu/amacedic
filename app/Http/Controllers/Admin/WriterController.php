<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Writer;
use App\SubjectArea;
use App\Http\Requests\WriterRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the Writers
     *
     * @param  \App\Writer  $model
     * @return \Illuminate\View\View
     */
    public function index(Writer $model)
    {
        $owner = 'writer';
        return view('admin.profile.writer.index', ['profiles' => $model->paginate(15)],compact('owner'));
    }

    /**
     * Show the form for creating a new Writer
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.profile.writer.create');
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
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('admin.writer.index')->with('success','Writer successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Writer  $order
     * @return \Illuminate\Http\writer
     */
    public function show(Writer $writer)
    {
        $profile = $writer;

        $owner = 'writer';

        $subjects = SubjectArea::where(['account_id'=>$profile->id,'accountType'=>'writer'])->pluck('subjectArea');

        return view('admin.profile.writer.show', compact('profile','subjects','owner'));
    }

    /**
     * Show the form for editing the specified Writer
     *
     * @param  \App\Writer  $writer
     * @return \Illuminate\View\View
     */
    public function edit(Writer $writer)
    {
        
        $profile = $writer;
        $subjects = SubjectArea::where(['account_id'=>$profile->id,'accountType'=>'writer'])->pluck('subjectArea');

        $owner = 'writer';
        
        return view('admin.profile.writer.edit', compact('subjects','profile','owner'));
                    
    }

    /**
     * Update the specified Writer in storage
     *
     * @param  \App\Http\Requests\WriterRequest  $request
     * @param  \App\Writer  $writer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WriterRequest $request, Writer $writer)
    {
        if ($request->has('profilePhoto')) {

            $file = $request->profilePhoto;
    
            $fileExtension = $file->getClientOriginalExtension();
    
            $fileOldName = $writer->profilePhoto;
            $fileNewName = 'writer'.$writer->id.".".$fileExtension;
    
            if ($fileOldName!=NULL) {
    
                unlink(public_path("storage\\profilephotos")."\\".$fileOldName);
    
            }
    
                $file->storeAs('profilephotos', $fileNewName,'public');

                $writer->update([
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

            $writer->update([
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
     * Remove the specified Writer from storage
     *
     * @param  \App\Writer  $writer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();

        return redirect()->route('admin.writer.index')->with('success','Writer successfully deleted.');
    }

    public function password(PasswordRequest $request, Writer $writer)
    {
        $writer->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('success','Password successfully updated.');
    }

    public function education(Request $request, Writer $writer)
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

        $writer->update($request->all());

        $subjectAreas = $request->subjectArea;

        SubjectArea::where(['account_id'=>auth()->id(),'accountType'=>'writer'])->delete();

        foreach ($subjectAreas as $subject) {
            SubjectArea::create([
                'account_id'=>$writer->id,
                'accountType'=>'writer',
                'subjectArea'=>$subject,
            ]);
        }

        return redirect()->back()->with('success','Education successfully updated.')
                                ->withInput(['tab' => 'education']);;
    }

    public function payment(Request $request, Writer $writer)
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

        if ($request->accountType=='bank') {
            $writer->update([
                'accountType'=>$request->accountType,
                'bankName'=>$request->bankName,
                'accountName'=>$request->accountName,
                'accountNumber'=>$request->accountNumber, 
            ]);
        }
        else {
            $writer->update([
                'accountType'=>$request->accountType,
                'accountName'=>$request->accountName,
                'accountNumber'=>$request->accountNumber, 
            ]);
        }
        
        return redirect()->back()->with('success','Payment details successfully updated.')
                                ->withInput(['tab' => 'payment']);
    }
}
