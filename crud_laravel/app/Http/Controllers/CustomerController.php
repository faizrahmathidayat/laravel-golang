<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreUpdateRequest;
use App\Models\CustomerModel;
use App\Models\FamilyListModel;
use App\Models\NaitonalityModel;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $data = CustomerModel::with('nationality','family_list')->get();
        return view('customer.list', compact('data'));
    }

    public function create()
    {
        $nationality = NaitonalityModel::get();
        return view('customer.create', compact('nationality'));
    }

    public function store(StoreUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $cst_name = $request->cst_name;
            $cst_dob = $request->cst_dob;
            $cst_phone_num = $request->cst_phone_num;
            $cst_email = $request->cst_email;
            $nationality_id = $request->nationality_id;
            $fl_name = $request->fl_name;
            $fl_dob = $request->fl_dob;
            $fl_relation = $request->fl_relation;

            $data_customer = array(
                'nationality_id' => $nationality_id,
                'cst_name' => $cst_name,
                'cst_dob' => $cst_dob,
                'cst_phone_num' => $cst_phone_num,
                'cst_email' => $cst_email,
            );

            $insert_customer = CustomerModel::create($data_customer);

            if(count($fl_name) > 0)
            {
                $data_family_list = array();
                foreach($fl_name as $key => $value) {
                    $arr_data_family = array(
                        'cst_id' => $insert_customer->cst_id,
                        'fl_name' => $value,
                        'fl_dob' => $fl_dob[$key],
                        'fl_relation' => $fl_relation[$key],
                    );
                    $data_family_list[] = $arr_data_family;
                }
                FamilyListModel::insert($data_family_list);
            }

            DB::commit();
            return response()->json(['message' => 'Berhasil menyimpan data.','data'=>$data_family_list],200);
        } catch(\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(),'errors' => []], 500);
        }
    }

    public function showById($cst_id)
    {
        $data = CustomerModel::with('nationality','family_list')->where('cst_id', $cst_id)->first();
        $nationality = NaitonalityModel::get();

        if(!empty($data) > 0) {
            return view('customer.edit', compact('data','nationality'));
        }
        abort(404);
    }

    public function update(StoreUpdateRequest $request, $cst_id)
    {
        DB::beginTransaction();
        try {
            $cst_name = $request->cst_name;
            $cst_dob = $request->cst_dob;
            $cst_phone_num = $request->cst_phone_num;
            $cst_email = $request->cst_email;
            $nationality_id = $request->nationality_id;
            $fl_name = $request->fl_name;
            $fl_dob = $request->fl_dob;
            $fl_relation = $request->fl_relation;

            $data_customer = array(
                'nationality_id' => $nationality_id,
                'cst_name' => $cst_name,
                'cst_dob' => $cst_dob,
                'cst_phone_num' => $cst_phone_num,
                'cst_email' => $cst_email,
            );

            CustomerModel::where('cst_id', $cst_id)->update($data_customer);
            FamilyListModel::where('cst_id', $cst_id)->delete();

            if(count($fl_name) > 0)
            {
                $data_family_list = array();
                foreach($fl_name as $key => $value) {
                    $arr_data_family = array(
                        'cst_id' => $cst_id,
                        'fl_name' => $value,
                        'fl_dob' => $fl_dob[$key],
                        'fl_relation' => $fl_relation[$key],
                    );
                    $data_family_list[] = $arr_data_family;
                }
                FamilyListModel::insert($data_family_list);
            }

            DB::commit();
            return response()->json(['message' => 'Berhasil menyimpan data.','data'=>$data_family_list],200);
        } catch(\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(),'errors' => []], 500);
        }
    }

    public function delete($cst_id)
    {
        DB::beginTransaction();
        try {
            $check_customer = CustomerModel::where('cst_id', $cst_id)->first();
            if(empty($check_customer)) {
                return response()->json(['message' => 'Data tidak ditemukan'], 400);
            }
            CustomerModel::where('cst_id', $cst_id)->delete();
            FamilyListModel::where('cst_id', $cst_id)->delete();
            DB::commit();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } catch(\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
