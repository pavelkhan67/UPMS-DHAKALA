<?php

namespace App\Http\Controllers;

use App\Models\BasicSettings\Village;
use App\Models\District;
use App\Models\Division;
use App\Models\House;
use App\Models\People\AddressInfo;
use App\Models\Religion;
use App\Models\Road;
use App\Models\Thana;
use App\Models\Union;
use App\Models\UnionWard;
use App\Models\User;
use App\Models\VillageArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddressInfoController extends Controller
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
    public function create($id)
    {
        $user = User::with( 'institute')
        ->with(array('addressInfo' => function($address){
            $address->with('presentUnion', 'permanentHouse', 'presentHouse', 'presentRoad', 'permanentRoad',  'presentVillage', 'presentDistrict', 'presentThana');
        }))
        ->find($id);
        $data['user'] = $user;
        $data['religions'] = Religion::where('status', true)->get();
        $data['villages'] = [];
        $data['permanentVillageAreas'] = [];
        $data['presentVillageAreas'] = [];
        $data['wards'] = [];
        $data['permanent_houses'] = [];
        if(isset($user->institute->institute_type_id) && $user->institute->institute_type_id == 1) {
            $data['villages'] = Village::where('union_id', $user->institute->union_id)->get();
            $data['wards'] = UnionWard::where('status', true)->get();
            $data['roads'] = Road::where('institute_id',  $user->institute->id)->latest()->get();
        } else if (isset($user->institute->institute_type_id) && $user->institute->institute_type_id == 2) {
           
        } else if (isset($user->institute->institute_type_id) && $user->institute->institute_type_id == 3) {

        }
        $data['divisions'] = Division::where('status', true)->get();

        if($user->addressInfo){
            if($user->addressInfo->permanent_ward_id){
                $data['permanent_houses'] = House::where('institute_id',  $user->institute->id)
                ->where('union_ward_id', $user->addressInfo->permanent_ward_id)
                ->latest()
                ->get();
            }
            $data['permanentVillageAreas'] = VillageArea::where('village_id',$user->addressInfo->permanent_village_id)->get();
            $data['presentVillageAreas'] = VillageArea::where('village_id',$user->addressInfo->present_village_id)->get();

        }

        // return response()->json($data, 200);

        return view('backend.pages.people.tabs.address', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'permanent_division_id' => 'nullable',
                'permanent_district_id' => 'nullable',
                'permanent_thana_id' => 'nullable',
                'permanent_union_id' => 'nullable',
                'permanent_ward_id' => 'nullable',
                'permanent_village_id' => 'nullable',
                'permanent_road' => 'nullable',
                'permanent_house' => 'nullable',
                'permanent_flat' => 'nullable',
                'present_division_id' => 'nullable',
                'present_district_id' => 'nullable',
                'present_thana_id' => 'nullable',
                'present_union_id' => 'nullable',
                'present_ward_id' => 'nullable',
                'present_village_id' => 'nullable',
                'present_road' => 'nullable',
                'present_house' => 'nullable',
                'present_flat' => 'nullable',
                'present_start_date' => 'nullable',
            ]);

            if ($validate->fails()) {
                $data['status'] = false;
                $data['message'] = "Sorry! Invalid Entry.";
                $data['errors'] = $validate->errors();
                return response(json_encode($data, JSON_PRETTY_PRINT), 400)->header('Content-Type', 'application/json');
            }

            $result = DB::transaction(function () use ($request) {

                $peopleFamily = AddressInfo::updateOrCreate([
                    'user_id' => $request->user_id
                ], [
                    'permanent_division_id' => $request->permanent_division_id,
                    'permanent_district_id' => $request->permanent_district_id,
                    'permanent_thana_id' => $request->permanent_thana_id,
                    'permanent_union_id' => $request->permanent_union_id,
                    'permanent_ward_id' => $request->permanent_ward_id,
                    'permanent_village_id' => $request->permanent_village_id,
                    'permanent_village_area_id' => $request->permanent_village_area_id,
                    'permanent_road' => $request->permanent_road,
                    'permanent_house' => $request->permanent_house,
                    'permanent_flat' => $request->permanent_flat,
                    'permanent_area' => $request->permanent_area,
                    'permanent_area_bn' => $request->permanent_area_bn,
                    'present_division_id' => $request->present_division_id,
                    'present_district_id' => $request->present_district_id,
                    'present_thana_id' => $request->present_thana_id,
                    'present_union_id' => $request->present_union_id,
                    'present_ward_id' => $request->present_ward_id,
                    'present_village_id' => $request->present_village_id,
                    'present_village_area_id' => $request->present_village_area_id,

                    'present_road' => $request->present_road,
                    'present_house' => $request->present_house,
                    'present_area' => $request->present_area,
                    'present_area_bn' => $request->present_area_bn,
                    'present_flat' => $request->present_flat,
                    'present_start_date' => $request->present_start_date,
                ]);



                if ($peopleFamily) {
                    $data['status'] = true;
                    $data['message'] = "Address submitted successfully!";
                    $data['result'] = $peopleFamily;
                    $data['code'] = 200;
                    $data['redirect_url'] = route('people.education', $request->user_id);
                    return $data;
                } else {
                    $data['status'] = false;
                    $data['message'] = "Family comment save failed!";
                    $data['code'] = 500;
                    return $data;
                }
            });

            return response(json_encode($result, JSON_PRETTY_PRINT), $result['code'])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $data['status'] = false;
            $data['message'] = "Something went wrong! Please try again...";
            $data['errors'] = $th;
            return response(json_encode($data, JSON_PRETTY_PRINT), 500)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People\AddressInfo  $addressInfo
     * @return \Illuminate\Http\Response
     */
    public function show(AddressInfo $addressInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People\AddressInfo  $addressInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(AddressInfo $addressInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\People\AddressInfo  $addressInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddressInfo $addressInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People\AddressInfo  $addressInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressInfo $addressInfo)
    {
        //
    }
}
