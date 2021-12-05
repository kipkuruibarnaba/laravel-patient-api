<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\HealthFacility;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function statistics()
    {
        $currentmonthregistrations=array();
        $currentmonth=Carbon::now()->month;
     $dateregistrations=Patient::select('created_at')->get();
     foreach ($dateregistrations as $date){
         $monthName = $date->created_at->format('m');
         if($monthName == $currentmonth){
             array_push($currentmonthregistrations,$monthName);
         }
     }

        $stats = [
            'totalregistrations'=> Patient::count(),
            'male'=> Patient::where('gender', 'Male')->count(),
            'female'=> Patient::where('gender', 'Female')->count(),
            'monthly'=>count($currentmonthregistrations),
            'facilities'=>HealthFacility::count(),
        ];
        return $stats;
    }
    public function listpatients()
    {
        $patients = Patient::all();
        return $patients;
    }
    public function listfacilities()
    {
        $facilities = HealthFacility::all();
        return $facilities;
    }
    public function addfacility(Request $request)
    {
        $HealthFacility = new HealthFacility;
        $HealthFacility->facilityname=$request->facilityname;
        $HealthFacility->facilitycounty=$request->facilitycounty;
        $HealthFacility->facilitylocation=$request->facilitylocation;
        $HealthFacility->Save();
        return response()->json([
            'status'=>200,
            'message'=>'Facility Added Successfully'
        ]);
    }
    public function addpatient(Request $request)
    {
        // $facility = explode("||",$request->input('facilityname'));

        $Patient = new Patient;
        $Patient->facilityid=$request->facilityname;
        $Patient->facilityname=$request->facilityname;
        $Patient->firstname=$request->firstname;
        $Patient->lastname=$request->lastname;
        $Patient->gender=$request->gender;
        $Patient->dateofbirth=$request->dateofbirth;
        $Patient->Save();
        return response()->json([
            'status'=>200,
            'message'=>'Patient Added Successfully'
        ]);
    }

    public function search($key)
    {
        $patient= Patient::where('firstname','like',"%$key%")->get();
        if($patient){
            return $patient;
        } else{
            return['message'=>'Failed not found'];
        }
        return $key;
    }
}
