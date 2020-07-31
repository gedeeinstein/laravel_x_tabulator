<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Prefecture;
use App\Models\Company;
use App\Models\Postcode;
use Config;

class CompaniesController extends Controller
{

    private function getRoute() {
        return 'companies';
    }

    public function index() {
        return view('backend.companies.index');
    }

    public function add()
    {
        $companies = new Company();
        $companies->form_action = $this->getRoute() . '.create';
        $companies->page_title = 'Add New Company';
        $companies->page_type = 'create';

        $companies->prefecture = Prefecture::get()->pluck('display_name', 'id');
        return view('backend.companies.form', [
            'companies' => $companies
        ]);
    }

    public function create(Request $request)
    {
        return $request->all();
    }

    public function getPostcode($postcode)
    {
        
        try {
            
            // $query = DB::select(" 
            // SELECT 
            // postcodes.id, 
            // prefectures.id as prefectures_id, 
            // postcodes.prefecture, 
            // prefectures.display_name, prefectures.name, postcodes.postcode, postcodes.city, postcodes.local FROM prefectures, postcodes WHERE postcodes.postcode LIKE '%$postcode%' GROUP BY postcodes.prefecture 
            // ");
            $postcode = Postcode::with('prefecture')->where('postcode', $postcode)->get();

            // return response()->json($query);
            return response()->json($postcode);
            
        } catch (Exception $e) {
            
            // $postcode = Postcode::where('postcode','like', '%'. $postcode . '%')->get();
        }

    }
}
