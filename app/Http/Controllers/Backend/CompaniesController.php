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
        // $validator = Validator::make($request->all(),[
        $this->validate($request, [
            'name'          => 'sometimes|required|string|max:255',
            'email'         => 'sometimes|required|email|max:100',
            'prefecture_id' => 'required|integer',
            'postcode'      => 'required|string|max:9',
            'city'          => 'nullable|string|max:100',
            'local'         => 'nullable|string|max:100',
            'street_address' => 'nullable|string|max:255',
            'business_hour'  => 'nullable|string|max:100',
            'regular_holiday' => 'nullable|string|max:100',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1280,max_height=720',
            'fax'             => 'nullable|string|max:100',
            'url'             => 'nullable|string|max:255',
            'license_number'  => 'nullable|string',
        ]);

        $id_img = Company::max('id');

        if($id_img > 1){
            $id_img +1;
        }else{
            $id_img = 1 ;
        }

        
        dd($request->all());
        return $request;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'image_'.str_slug($request->title).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/files');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $article->image = $name;
          }

        // $dataCompany = $request->all();
        $dataCompany = new Company();

        return $request;

        // $this->validator($dataCompany, 'create')->validate();

        // return $dataCompany;
    }

    public function getPostcode($postcode)
    {
        try {
            $postcodes = Postcode::with('prefecture')->where('postcode', $postcode)->get();
            if($postcodes != ''){
                return response()->json($postcodes);
            }
            else{
                return null;
            }
        } catch (Exception $e) {
            return $e;
        }

    }


    protected function validator(array $data, $type) {
        return Validator::make($data, [
                'name' => 'sometimes|required|string|max:255|unique:companies',
                'email' => 'sometimes|required|email|max:100|unique:companies',
                'prefecture_id' => 'required|integer',
                'postcode' => 'required|string|max:9',
                'city' => 'nullable|string|max:100',
                'local' => 'nullable|string|max:100',
                'street_address' => 'nullable|string|max:255',
                'business_hour' => 'nullable|string|max:100',
                'regular_holiday' => 'nullable|string|max:100',
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'fax' => 'nullable|string|max:100',
                'url' => 'nullable|string|max:255',
                'license_number' => 'nullable|string',
        ]);
    }
}
