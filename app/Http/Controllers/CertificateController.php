<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenericCertificate;
use App\Models\Application;
class CertificateController extends Controller
{

//     public function store2(Request $request)
// {
//     $user = new User;

//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $user->password = Hash::make($request->input('password'));

//     $user->save();

//     return response()->json(['message' => 'User created', 'user' => $user], 201);
// }
 public function store(Request $request){
        $validatedData = $request->validate([
        'name' => 'required',
        'fatherName' => 'nullable',
        'motherName' => 'nullable',
        'SpouseName' => 'nullable',
        'nid' => 'nullable',
        'passport' => 'nullable',
        'bid' => 'nullable',
        'mobile' => 'nullable',
        'email' => 'nullable',
        'birthdate' => 'nullable',
        'resident' => 'nullable',
        'service' => 'nullable',
        'bn' => 'nullable',
        'presentHoldingNumber' => 'nullable',
        'presentVillage' => 'nullable',
        'presentPostOffice' => 'nullable',
        'presentPoliceStation' => 'nullable',
        'presentDistrict' => 'nullable',
        'permanentHoldingNumber' => 'nullable',
        'permanentVillage' => 'nullable',
        'permanentPostOffice' => 'nullable',
        'permanentPoliceStation' => 'nullable',
        'permanentDistrict' => 'nullable',
        'userImage' => 'nullable',
        'idVerificationImage' => 'nullable',
        'homeVerificationimage' => 'nullable',
        'deathVerificationimage' => 'nullable',
        
        // Add validation rules for other fields
    ]);
    $cert = new GenericCertificate;
    $cert->name = $request->filled('name') ? $validatedData['name'] : null;
    $cert->FatherName = $request->filled('fatherName') ? $validatedData['fatherName'] : null;
    $cert->MotherName = $request->filled('motherName') ? $validatedData['motherName'] : null;
    $cert->SpouseName = $request->filled('SpouseName') ? $validatedData['SpouseName'] : null;
    $cert->nid = $request->filled('nid') ? $validatedData['nid'] : null;
    $cert->passport = $request->filled('passport') ? $validatedData['passport'] : null;
    $cert->bid = $request->filled('bid') ? $validatedData['bid'] : null;
    $cert->mobile = $request->filled('mobile') ? $validatedData['mobile'] : null;
    $cert->email = $request->filled('email') ? $validatedData['email'] : null;
    $cert->resident = $request->filled('resident') ? $validatedData['resident'] : null;
    $cert->service = $request->filled('service') ? $validatedData['service'] : null;
    $cert->bn = $request->filled('bn') ? $validatedData['bn'] : true;
    $cert->birthdate = $request->filled('birthdate') ? $validatedData['birthdate'] : null;
    $cert->presentHoldingNumber = $request->filled('presentHoldingNumber') ? $validatedData['presentHoldingNumber'] : null;
    $cert->presentVillage = $request->filled('presentVillage') ? $validatedData['presentVillage'] : null;
    $cert->presentPostOffice = $request->filled('presentPostOffice') ? $validatedData['presentPostOffice'] : null;
    $cert->presentPoliceStation = $request->filled('presentPoliceStation') ? $validatedData['presentPoliceStation'] : null;
    $cert->presentDistrict = $request->filled('presentDistrict') ? $validatedData['presentDistrict'] : null;
    $cert->permanentHoldingNumber = $request->filled('permanentHoldingNumber') ? $validatedData['permanentHoldingNumber'] : null;
    $cert->permanentVillage = $request->filled('permanentVillage') ? $validatedData['permanentVillage'] : null;
    $cert->permanentPostOffice = $request->filled('permanentPostOffice') ? $validatedData['permanentPostOffice'] : null;
    $cert->permanentPoliceStation = $request->filled('permanentPoliceStation') ? $validatedData['permanentPoliceStation'] : null;
    $cert->permanentDistrict = $request->filled('permanentDistrict') ? $validatedData['permanentDistrict'] : null;

    if ($request->hasFile('userImage')) {
        $userImageName = uniqid().'.'.$request->userImage->extension();  
        $request->userImage->move(public_path('images'), $userImageName);
        $userImagePath = 'images/' . $userImageName;
        } else {
        $userImagePath = null;
        }
        if ($request->hasFile('idVerificationImage')) {
        $idVerificationImageName = uniqid().'.'.$request->idVerificationImage->extension();
        $request->idVerificationImage->move(public_path('images'), $idVerificationImageName);
        $idVerificationImageNamePath = 'images/' . $idVerificationImageName;
        } else {
        $idVerificationImageNamePath = null;
        }
        if ($request->hasFile('homeVerificationimage')) {
        $homeVerificationimageName = uniqid().'.'.$request->homeVerificationimage->extension();
        $request->homeVerificationimage->move(public_path('images'), $homeVerificationimageName);
        $homeVerificationimageNamePath = 'images/' . $homeVerificationimageName;
        } else {
        $homeVerificationimageNamePath = null;
        }
        if ($request->hasFile('deathVerificationimage')) {
        $deathVerificationimageName = uniqid().'.'.$request->deathVerificationimage->extension();
        $request->deathVerificationimage->move(public_path('images'), $deathVerificationimageName);
        $deathVerificationimageNamePath = 'images/' . $deathVerificationimageName;
        } else {
        $deathVerificationimageNamePath = null;
        }

        $cert->userImage = $userImagePath;
        $cert->idVerificationImage = $idVerificationImageNamePath;
        $cert->homeVerificationimage = $homeVerificationimageNamePath;
        $cert->deathVerificationimage = $deathVerificationimageNamePath;
        $cert->save();
        $certificate = GenericCertificate::find($cert->id);
        $year = date('Y');
        $month = date('m');
        $serial = str_pad($cert->id, 11, '0', STR_PAD_LEFT);
        $uid = $year . $month . $serial;
        $certificate->certificateId = $uid;
        $certificate->save();
    return response()->json([
            'message' => 'Certificate created successfully ',
        //      'data'=> $cert,
             'data'=> $certificate,
            
        ], 201);
}
public function get(){
    $cert = GenericCertificate::all();
    return response()->json([
            'message' => 'Certificate created successfully ',
             'data'=> $cert,
            
        ], 201);
}

public function getById($id){
    $cert = GenericCertificate::find($id);
    return response()->json([
            'message' => 'Certificate created successfully ',
             'data'=> $cert,
            
        ], 201);
}
public function getByService($service){
    $cert = GenericCertificate::where('service',$service)->get();
    return response()->json([
            'message' => 'Certificate created successfully ',
             'data'=> $cert,
            
        ], 201);
}

public function imageUpload(Request $request){
//     $imageName = time().'.'.$request->userImage->extension();  
//     $request->userImage->move(public_path('images'), $imageName);
    //get path
        $year = date('Y');
        $month = date('m');
        $serial = str_pad(2, 11, '0', STR_PAD_LEFT);
        $uid = $year . $month . $serial;
//        $imagePath = 'images/' . $imageName;
    return response()->json([
            'message' => 'Certificate created successfully ',
        //      'data'=> $imageName,
        //      'path'=> $imagePath,
             'uid' => $uid,
        ], 201);
}

public function storeApplication(Request $request){
    $validatedData = $request->validate([
        'name' => 'required',
        'ApplicantName' => 'nullable',
        'fatherName' => 'nullable',
        'motherName' => 'nullable',
        'SpouseName'=> 'nullable',
        'nid' => 'nullable',
        'passport' => 'nullable',
        'bid' => 'nullable',
        'mobile' => 'nullable',
        'email' => 'nullable',
        'birthdate' => 'nullable',
        'resident' => 'nullable',
        'service' => 'nullable',
        'bn'=>'nullable',
        'presentHoldingNumber' => 'nullable',
        'presentVillage' => 'nullable',
        'presentPostOffice' => 'nullable',
        'presentPoliceStation' => 'nullable',
        'presentDistrict' => 'nullable',
        'permanentHoldingNumber' => 'nullable',
        'permanentVillage' => 'nullable',
        'permanentPostOffice' => 'nullable',
        'permanentPoliceStation' => 'nullable',
        'permanentDistrict' => 'nullable',
        'userImage' => 'nullable',
        'idVerificationImage' => 'nullable',
        'homeVerificationimage' => 'nullable',
        'deathVerificationimage' => 'nullable',
        'nomineeName' => 'nullable',
        'nomineeVid'=> 'nullable',
        'nomineeRelation' => 'nullable',
        'nomineeDob' => 'nullable',
        
        // Add validation rules for other fields
    ]);
     $eightDigitUuid = '';
    for ($i = 0; $i < 8; $i++) {
    $eightDigitUuid .= mt_rand(0, 9);
}
    $cert = new Application;
    $cert->name = $request->filled('name') ? $validatedData['name'] : null;
    $cert->applicationId = $eightDigitUuid;
    $cert->ApplicantName = $request->filled('ApplicantName') ? $validatedData['ApplicantName'] : null;
    $cert->FatherName = $request->filled('fatherName') ? $validatedData['fatherName'] : null;
    $cert->MotherName = $request->filled('motherName') ? $validatedData['motherName'] : null;
    $cert->SpouseName = $request->filled('SpouseName') ? $validatedData['SpouseName'] : null;
    $cert->nid = $request->filled('nid') ? $validatedData['nid'] : null;
    $cert->passport = $request->filled('passport') ? $validatedData['passport'] : null;
    $cert->bid = $request->filled('bid') ? $validatedData['bid'] : null;
    $cert->mobile = $request->filled('mobile') ? $validatedData['mobile'] : null;
    $cert->email = $request->filled('email') ? $validatedData['email'] : null;
    $cert->resident = $request->filled('resident') ? $validatedData['resident'] : null;
    $cert->service = $request->filled('service') ? $validatedData['service'] : null;
    $cert->bn = $request->filled('bn') ? $validatedData['bn'] : true;
    $cert->birthdate = $request->filled('birthdate') ? $validatedData['birthdate'] : null;
    $cert->presentHoldingNumber = $request->filled('presentHoldingNumber') ? $validatedData['presentHoldingNumber'] : null;
    $cert->presentVillage = $request->filled('presentVillage') ? $validatedData['presentVillage'] : null;
    $cert->presentPostOffice = $request->filled('presentPostOffice') ? $validatedData['presentPostOffice'] : null;
    $cert->presentPoliceStation = $request->filled('presentPoliceStation') ? $validatedData['presentPoliceStation'] : null;
    $cert->presentDistrict = $request->filled('presentDistrict') ? $validatedData['presentDistrict'] : null;
    $cert->permanentHoldingNumber = $request->filled('permanentHoldingNumber') ? $validatedData['permanentHoldingNumber'] : null;
    $cert->permanentVillage = $request->filled('permanentVillage') ? $validatedData['permanentVillage'] : null;
    $cert->permanentPostOffice = $request->filled('permanentPostOffice') ? $validatedData['permanentPostOffice'] : null;
    $cert->permanentPoliceStation = $request->filled('permanentPoliceStation') ? $validatedData['permanentPoliceStation'] : null;
    $cert->permanentDistrict = $request->filled('permanentDistrict') ? $validatedData['permanentDistrict'] : null;
    $data = $request->input('nomineeDetails');
    $cert->nominee = json_encode($data);
        // if ($request->hasFile('userImage')) {
        // $userImageName = uniqid().'.'.$request->userImage->extension();  
        // $request->userImage->move(public_path('images'), $userImageName);
        // $userImagePath = 'images/' . $userImageName;
        // } else {
        // $userImagePath = null;
        // }
        // if ($request->hasFile('idVerificationImage')) {
        // $idVerificationImageName = uniqid().'.'.$request->idVerificationImage->extension();
        // $request->idVerificationImage->move(public_path('images'), $idVerificationImageName);
        // $idVerificationImageNamePath = 'images/' . $idVerificationImageName;
        // } else {
        // $idVerificationImageNamePath = null;
        // }
        // if ($request->hasFile('homeVerificationimage')) {
        // $homeVerificationimageName = uniqid().'.'.$request->homeVerificationimage->extension();
        // $request->homeVerificationimage->move(public_path('images'), $homeVerificationimageName);
        // $homeVerificationimageNamePath = 'images/' . $homeVerificationimageName;
        // } else {
        // $homeVerificationimageNamePath = null;
        // }
        // if ($request->hasFile('deathVerificationimage')) {
        // $deathVerificationimageName = uniqid().'.'.$request->deathVerificationimage->extension();
        // $request->deathVerificationimage->move(public_path('images'), $deathVerificationimageName);
        // $deathVerificationimageNamePath = 'images/' . $deathVerificationimageName;
        // } else {
        // $deathVerificationimageNamePath = null;
        // }

        $cert->userImage = $request->filled('userImage') ? $validatedData['userImage'] : null;
        $cert->idVerificationImage = $request->filled('idVerificationImage') ? $validatedData['idVerificationImage'] : null;
        $cert->homeVerificationimage = $request->filled('homeVerificationimage') ? $validatedData['homeVerificationimage'] : null;
        $cert->deathVerificationimage = $request->filled('deathVerificationimage') ? $validatedData['deathVerificationimage'] : null;
        $cert->save();
    return response()->json([
            'message' => 'Application created successfully ',
        //      'data'=> $cert,
             'data'=> $cert,
            
        ], 201);
}
public function getApplications(){
    $applications = Application::all();
    return response()->json([
            'message' => 'All Applications ',
        //      'data'=> $cert,
             'data'=> $applications,
            
        ], 201);
    }
public function getApplicationById($id){
    $application = Application::find($id);
    return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'data'=> $application,
            
        ], 201);
    }
public function getApplicationByService($service){
    $application = Application::where('service', $service)->get();
    return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'data'=> $application,
            
        ], 201);
    }
public function getApplicationByApplicationId($applicationId){
    $application = Application::where('applicationId', $applicationId)->get();
    return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'data'=> $application,
            
        ], 201);
    }
public function getApplicationByStatus($status){
    $application = Application::where('status', $status)->get();
    return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'data'=> $application,
            
        ], 201);
    }
    public function getByCertificateId($certificateId){
        $Certificate = GenericCertificate::where('certificateId', $certificateId)->get();
        return response()->json([
                'message' => 'Certificate by Certificate id ',
            //      'data'=> $cert,
                 'data'=> $Certificate,
                
            ], 201);
        }
    public function getByCertificateIdAndDob(Request $request){
        
        $certificateId = $request->input('certificateId');
        $dob = $request->input('dob');
        $Certificate = GenericCertificate::where('certificateId', $certificateId)->where('birthDate', $dob)->get();
        return response()->json([
                'message' => 'Certificate by Certificate id and dob ',
            //      'data'=> $cert,
                 'data'=> $Certificate
                
            ], 201);
        }
    public function updateApplication(Request $request, $id){
        $validatedData = $request->validate([
        'name' => 'required',
        'ApplicantName' => 'nullable',
        'fatherName' => 'nullable',
        'motherName' => 'nullable',
        'SpouseName'=> 'nullable',
        'nid' => 'nullable',
        'passport' => 'nullable',
        'bid' => 'nullable',
        'mobile' => 'nullable',
        'email' => 'nullable',
        'birthdate' => 'nullable',
        'resident' => 'nullable',
        'service' => 'nullable',
        'bn'=>'nullable',
        'presentHoldingNumber' => 'nullable',
        'presentVillage' => 'nullable',
        'presentPostOffice' => 'nullable',
        'presentPoliceStation' => 'nullable',
        'presentDistrict' => 'nullable',
        'permanentHoldingNumber' => 'nullable',
        'permanentVillage' => 'nullable',
        'permanentPostOffice' => 'nullable',
        'permanentPoliceStation' => 'nullable',
        'permanentDistrict' => 'nullable',
        'userImage' => 'nullable',
        'idVerificationImage' => 'nullable',
        'homeVerificationimage' => 'nullable',
        'deathVerificationimage' => 'nullable',
        
        // Add validation rules for other fields
    ]);
        $application = Application::find($id);
        $application->name = $request->filled('name') ? $validatedData['name'] : null;
        $application->ApplicantName = $request->filled('ApplicantName') ? $validatedData['ApplicantName'] : null;
        $application->FatherName =  $request->filled('fatherName') ? $validatedData['fatherName'] : null;
        $application->MotherName = $request->filled('motherName') ? $validatedData['motherName'] : null;
        $application->SpouseName =  $request->filled('SpouseName') ? $validatedData['SpouseName'] : null;
        $application->nid =     $request->filled('nid') ? $validatedData['nid'] : null;
        $application->passport =    $request->filled('passport') ? $validatedData['passport'] : null;
        $application->bid =     $request->filled('bid') ? $validatedData['bid'] : null;
        $application->mobile =  $request->filled('mobile') ? $validatedData['mobile'] : null;
        $application->email =   $request->filled('email') ? $validatedData['email'] : null;
        $application->resident =    $request->filled('resident') ? $validatedData['resident'] : null;
        $application->service =    $request->filled('service') ? $validatedData['service'] : null;
        $application->bn =  $request->filled('bn') ? $validatedData['bn'] : true;
        $application->birthdate =   $request->filled('birthdate') ? $validatedData['birthdate'] : null;
        $application->presentHoldingNumber =    $request->filled('presentHoldingNumber') ? $validatedData['presentHoldingNumber'] : null;
        $application->presentVillage =  $request->filled('presentVillage') ? $validatedData['presentVillage'] : null;
        $application->presentPostOffice =   $request->filled('presentPostOffice') ? $validatedData['presentPostOffice'] : null;
        $application->presentPoliceStation =    $request->filled('presentPoliceStation') ? $validatedData['presentPoliceStation'] : null;
        $application->presentDistrict =     $request->filled('presentDistrict') ? $validatedData['presentDistrict'] : null;
        $application->permanentHoldingNumber =   $request->filled('permanentHoldingNumber') ? $validatedData['permanentHoldingNumber'] : null;
        $application->permanentVillage =    $request->filled('permanentVillage') ? $validatedData['permanentVillage'] : null;
        $application->permanentPostOffice =     $request->filled('permanentPostOffice') ? $validatedData['permanentPostOffice'] : null;
        $application->permanentPoliceStation =  $request->filled('permanentPoliceStation') ? $validatedData['permanentPoliceStation'] : null;
        $application->permanentDistrict =   $request->filled('permanentDistrict') ? $validatedData['permanentDistrict'] : null;
        $data = $request->input('nomineeDetails');
        $application->nominee = json_encode($data);
        // $application->userImage = $request->userImage;
        // $application->idVerificationImage = $request->idVerificationImage;
        // $application->homeVerificationimage = $request->homeVerificationimage;
        // $application->deathVerificationimage = $request->deathVerificationimage;
        $application->save();
        return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'data'=> $application,
            
        ], 201);
    }
    // public function updateApplicationStatusWithComment(Request $request, $id){
    //     $application = Application::find($id);
    //     $application->status = $request->status;
    //     $application->comment = $request->comment;
    //     $application->save();
    //     return response()->json([
    //         'message' => 'Application ',
    //     //      'data'=> $cert,
    //          'data'=> $application,
            
    //     ], 201);
    // }
    public function updateApplicationStatusWithComment(Request $request, $id){
    $application = Application::find($id);
    // if request status value is Approved
    if( $request->input('status') === 'Approved' ){
        
        // transfer all data to certificate table
        $year = date('Y');
        $month = date('m');
        $serial = str_pad($application->id, 11, '0', STR_PAD_LEFT);
        $uid = $year . $month . $serial;
        
        $cert = new GenericCertificate;
        $cert->name = $application->name;
        $cert->certificateId = $uid;
        $cert->ApplicantName = $application->ApplicantName;
        $cert->FatherName = $application->FatherName;
        $cert->MotherName = $application->MotherName;
        $cert->SpouseName = $application->SpouseName;
        $cert->nid = $application->nid;
        $cert->passport = $application->passport;
        $cert->bid = $application->bid;
        $cert->mobile = $application->mobile;
        $cert->email = $application->email;
        $cert->resident = $application->resident;
        $cert->service = $application->service;
        $cert->birthdate = $application->birthdate;
        $cert->bn= $application->bn;
        $cert->presentHoldingNumber = $application->presentHoldingNumber;
        $cert->presentVillage = $application->presentVillage;
        $cert->presentPostOffice = $application->presentPostOffice;
        $cert->presentPoliceStation = $application->presentPoliceStation;
        $cert->presentDistrict = $application->presentDistrict;
        $cert->permanentHoldingNumber = $application->permanentHoldingNumber;
        $cert->permanentVillage = $application->permanentVillage;
        $cert->permanentPostOffice = $application->permanentPostOffice;
        $cert->permanentPoliceStation = $application->permanentPoliceStation;
        $cert->permanentDistrict = $application->permanentDistrict;
        $cert->userImage = $application->userImage;
        $cert->idVerificationImage = $application->idVerificationImage;
        $cert->homeVerificationimage = $application->homeVerificationimage;
        $cert->deathVerificationimage = $application->deathVerificationimage;
        $cert->nominee = $application->nominee;
        $cert->save();

        $application->status = $request->status;
        $application->comment = $request->comment;
        $application->certificate_id = $cert->certificateId;
        $application->save();
        return response()->json([
            'message' => 'Application ',
            'cert'=> $cert,
             'application'=> $application,
            
        ], 201);
    }
    // if request status value is Rejected
    if( $request->input('status') === 'Rejected' ){
        $application->status = $request->status;
        $application->comment = $request->comment;
        $application->save();
        return response()->json([
            'message' => 'Application ',
             //'cert'=> $cert,
             'application'=> $application,
            
        ], 201);
    }
    // if request status value is Pending
    if( $request->input('status') === 'Pending' ){
        $application->status = $request->status;
        $application->save();
        return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
             'application'=> $application,
            
        ], 201);
    }

    
    
    }
    public function recoverApplicationId (Request $request){
        // get application by service, dob, vid
        $application = Application::where('service', $request->service)->where('birthdate', $request->dob)->where('nid', $request->vid)->first();
        if($application){
            return response()->json([
                'message' => 'Application ',
            //      'data'=> $cert,
                //  'application'=> $application,
                'service'=> $request->service,
                'dob'=> $request->dob,
                'vid'=> $request->vid,
                'application'=> $application,
                
            ], 201);
        }
        $application = Application::where('service', $request->service)->where('birthdate', $request->dob)->where('bid', $request->vid)->first();
        if($application){
            return response()->json([
                'message' => 'Application ',
            //      'data'=> $cert,
                //  'application'=> $application,
                'service'=> $request->service,
                'dob'=> $request->dob,
                'vid'=> $request->vid,
                'application'=> $application,
                
            ], 201);
        }
        $application = Application::where('service', $request->service)->where('birthdate', $request->dob)->where('passport', $request->vid)->first();
        if($application){
            return response()->json([
                'message' => 'Application ',
            //      'data'=> $cert,
                //  'application'=> $application,
                'service'=> $request->service,
                'dob'=> $request->dob,
                'vid'=> $request->vid,
                'application'=> $application,
                
            ], 201);
        }
        return response()->json([
            'message' => 'Application ',
        //      'data'=> $cert,
            //  'application'=> $application,
            'service'=> $request->service,
            'dob'=> $request->dob,
            'vid'=> $request->vid,
            'application'=> $application,
            
        ], 201);
    }

}
