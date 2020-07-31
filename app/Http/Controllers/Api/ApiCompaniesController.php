<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Postcode;

class ApiCompaniesController extends Controller
{
    public function getCompaniesTabular() {
        $companies = Company::with('prefecture')->get();
        return response()->json($companies);
    }
    public function getPrefectureTabular() {
        $prefecture = Prefecture::with('area')->get();
        return response()->json($prefecture);
    }

}
