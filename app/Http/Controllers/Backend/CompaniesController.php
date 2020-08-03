<?php

namespace App\Http\Controllers\Backend;

use Config;
use App\Models\Company;

use App\Models\Postcode;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCompanyRequest;

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
        // Validate input, indicate this is 'create' function
        $this->validator($request->all(), 'create')->validate();
        $company = new Company();
        

        try {
            $img_path = public_path('/uploads/files');

            if (!file_exists($img_path)) {
                mkdir($img_path, 0755, true);
            }
            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->prefecture_id = $request->get('prefecture_id');
            $company->phone = $request->get('phone');
            $company->postcode = $request->get('postcode');
            $company->city = $request->get('city');
            $company->local = $request->get('local');
            $company->street_address = $request->get('street_address');
            $company->business_hour = $request->get('business_hour');
            $company->regular_holiday = $request->get('regular_holiday');
            $company->image = "";
            $company->fax = $request->get('fax');
            $company->url = $request->get('url');
            $company->license_number = $request->get('license_number');

            $company->save();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'image_'.$company->id.'.'.$image->getClientOriginalExtension();
                $imagePath = $img_path. "/".  $filename;
                $image->move($img_path, $filename);
                $image = $filename;
                $company->image = $image;
            }
            //save the image file name after other fields saved and id can be retreived, so if there is deleted data if using method img_id() file name will not match company_id
            $company->save();

            if($company){
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_SAVE_COMPANY'));
            }else{
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_SAVE_COMPANY'));
            }            
        } catch (\Exception $e) {
            return print($e);
        }
    }

    
    public function edit($id)
    {
        $companies = Company::findOrFail($id);
        $companies->form_action = $this->getRoute() . '.update';
        $companies->page_title = 'Edit Company ' . $companies->name;
        $companies->page_type = 'edit';
        $companies->prefecture = Prefecture::get()->pluck('display_name', 'id');
        return view('backend.companies.form', ['companies' => $companies]);
    }

    public function update(Request $request, $id)
    { 
        // UpdateCompanyRequest 
        $this->validator($request->all(), 'update')->validate();
        
        try {
            $company = Company::findOrFail($id);

            $img_path = public_path('/uploads/files');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'image_'.$company->id.'.'.$image->getClientOriginalExtension();
                $imagePath = $img_path. "/".  $filename;
                $image->move($img_path, $filename);
                $image = $filename;
                $company->image = $image;
            }
            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->prefecture_id = $request->get('prefecture_id');
            $company->phone = $request->get('phone');
            $company->postcode = $request->get('postcode');
            $company->city = $request->get('city');
            $company->local = $request->get('local');
            $company->street_address = $request->get('street_address');
            $company->business_hour = $request->get('business_hour');
            $company->regular_holiday = $request->get('regular_holiday');
            $company->fax = $request->get('fax');
            $company->url = $request->get('url');
            $company->license_number = $request->get('license_number');

            // return $request;
            $company->update();

            if($company){
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_UPDATE_COMPANY'));
            }else{
                
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_UPDATE_COMPANY'));
            }
            
        } catch (\Exception $e) {
            return redirect()->route($this->getRoute())->with('error', $e .' '. Config::get('const.FAILED_UPDATE_COMPANY'));
            print_r($e);
        }
        
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

    public function delete(T$id)
    {
        try {
            $company = Company::where('id', $id)->delete();
            return response()->json($company);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    protected function validator(array $data, $type) {
        return Validator::make($data, [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:100',
            'prefecture_id' => 'required',
            'postcode'      => 'required|string|max:9',
            'city'          => 'nullable|string|max:100',
            'local'         => 'nullable|string|max:100',
            'street_address' => 'nullable|string|max:255',
            'business_hour'  => 'nullable|string|max:100',
            'regular_holiday' => 'nullable|string|max:100',
            'image'           => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1280,max_height=720',
            'fax'             => 'nullable|string|max:100',
            'url'             => 'nullable|string|max:255',
            'license_number'  => 'nullable|string',
        ]);
    }

    public function data_company()
    {
        $companies = Company::with('prefecture')->get();

        return response()->json($companies);
    }
}
