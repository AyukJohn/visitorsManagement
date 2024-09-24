<?php
namespace App\Repositories;

use App\Resources\UserResource;
use App\Mail\AccountActivationRequest;
use App\Models\User;
use App\Models\Visa;
use App\Models\VisaDocuments;
use App\Requests\ActivateRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Cloudinary;
// use Cloudinary\Cloudinary as CloudinaryCloudinary;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class VisaRepository
{

    // public function __construct() {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    // public static function find($id)
    // {
    //     return VisaType::find($id);
    // }


    public function getVisa()
    {
        return Visa::all();
    }


    public function userVisa(){

        $user = Auth::user();

        if ($user) {
            $visaDocs = $user->documents();

            return response()->json([
                "message" => "Success",
                "data" => $visaDocs,
            ], 200);
        }

    }



    Public function createVisa($request){

        // dd($request);

        $user = Auth::user();
        
        $visa = $user->visas()->create($request);

        return response()->json([
            "message" => "Success",
            "data" => $visa,
        ], 201);

    }


    Public function createVisaDoc($request){


        $user = Auth::user();
        

        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust the allowed image types and max size as needed
        ]);

        $file = $request->file('file')->getRealPath();

        $uploadedImage = Cloudinary::upload($file, [
            'folder' => 'uploads', // Optionally, specify a folder in Cloudinary to store the files
            'resource_type' => 'auto', // Automatically detect the resource type (image, video, etc.)
        ]);

        $fileUrl = $uploadedImage->getSecurePath();
      

        $visaDoc = new VisaDocuments();
        $visaDoc['document'] = $fileUrl;

       $visa = $user->documents()->save($visaDoc);


        return response()->json([
            "message" => "Success",
            "data" => $visa,
        ], 201);

    }

    public function get_Visa($request, $id)
    {
        $user = Auth::user();

        if ($user) {
            $visaDocs = $user->documents()->findOrFail($id);

            return response()->json([
                "message" => "Success",
                "data" => $visaDocs,
            ], 200);
        }

        // $visaDocs = VisaDocuments::findOrFail($id);


        // return response()->json([
        //     "message" => "Success",
        //     "data" => $visaDocs,
        // ], 200);
        

    }




    // public function updateVisaDoc($request, $id){
    //     $user = Auth::user();

    //     dd($request['file']);

    //     // $request->validate([
    //     //     'file' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Adjust the allowed image types and max size as needed
    //     // ]);

    //     dd($request);


    //     $file = $request->file('file')->getRealPath();

    //     $uploadedImage = Cloudinary::upload($file, [
    //         'folder' => 'uploads', // Optionally, specify a folder in Cloudinary to store the files
    //         'resource_type' => 'auto', // Automatically detect the resource type (image, video, etc.)
    //     ]);

    //     $fileUrl = $uploadedImage->getSecurePath();


    //     $visaDoc = VisaDocuments::find($id);
    //     $visaDoc['document'] = $fileUrl;
    //     $visa = $user->documents()->save($visaDoc);

    // }




    public function upDateStatus($request, $id){
        $user = Auth::user();
     
        $data = VisaDocuments::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

        $data->update($request->all());

        return response()->json([
            'message'=>'upDated',
        ]);

    }



}