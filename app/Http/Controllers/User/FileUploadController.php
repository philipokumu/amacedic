<?php

namespace App\Http\Controllers\User;

use App\FileUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Auth;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Validator::make($request->all(), [
            'file.*'=> 'mimes:jpeg,bmp,png,jpg,doc,docx,pdf,ppt,xls,xlsx,csv,pptx,pptm,txt,zip,mp3,mp4,wma,mpg,flv|max:4000',
            ]);

        if($data->fails()) {
            return response()->json(['errors'=>$data->errors()],422);
        }
        $files = $request->file;
        // Creating a new time instance, we'll use it to name our file and declare the path
        $time = Carbon::now();
        // Requesting the file from the form
        // Getting the extension of the file 
        foreach ($files as $file) {

            $fileExtension = $file->getClientOriginalExtension();

            $fileOriginalName = $file->getClientOriginalName();

            $fileFirstName = pathinfo($fileOriginalName,PATHINFO_FILENAME);

            $fileSize = $file->getSize();

            // Creating the directory, for example, if the date = 18/10/2017, the directory will be 2017/10/
            // $directory = date_format($time, 'Y') . '/' . date_format($time, 'm');
            // $directory = public_path("fileuploads");
            // Creating the file name: random string followed by the day, random number and the hour
            // $filename = str_random(5).date_format($time,'d').rand(1,9).date_format($time,'h').".".$extension;
            $fileName =  $fileFirstName.date_format($time,'d').rand(1,9).date_format($time,'h').".".$fileExtension;
            // This is our upload main function, storing the image in the storage that named 'public'
            $upload_success = $file->storeAs('fileuploads',$fileName,'public');
            // $upload_success = $file->move('fileuploads',$fileName);
            // If the upload is successful, return the name of directory/filename of the upload.
            if ($upload_success) {
                if (!$request->has('order_id')) {
                    if ($request->fileUuid==0) {
                        // First uploaded file by user without order nor UUID

                        $fileUuid = Uuid::uuid4();

                        FileUpload::create([
                            'filename'=>$fileName,
                            'fileUuid'=> $fileUuid,
                            'uploader'=>'client',
                            ]);
                            
                        return response()->json([
                            'filename'=>$fileName,
                            'fileUuid'=>$fileUuid,
                            'filesize'=>$fileSize,

                        ], 200);
                    }
                    else {
                        // subsequent uploaded file(s) by user with UUID but without order

                        FileUpload::create([
                            'filename'=>$fileName,
                            'fileUuid'=>$request->fileUuid,
                            'uploader'=>'client',
                            ]);

                        return response()->json([
                            'filename'=>$fileName,
                            'fileUuid'=>$request->fileUuid,
                            'filesize'=>$fileSize,
                        ], 200);
                    }

                } else {
                        // if user is logged in and is uploading to an order

                    FileUpload::create([
                        'filename'=>$fileName,
                        'order_id'=>$request->order_id,
                        'uploader'=>'client',
                        ]);

                    return response()->json([
                        'filename'=>$fileName,
                        'filesize'=>$fileSize,
                        // 'filepath'=>asset('storage/fileuploads/'.$fileName),

                    ], 200);
                }

            }
            // Else, return error 400
            else {
                return response()->json(['error'=>'Could not upload file'], 422);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $filePath = public_path("storage\\fileuploads")."\\".$request->id;

        if (file_exists($filePath)) {

            unlink($filePath);
            
            FileUpload::where('filename',$request->id)->delete();
    
        }
        else
        
            return response()->json(['errors'=>'file doesnt exist'], 422);
    }
}
