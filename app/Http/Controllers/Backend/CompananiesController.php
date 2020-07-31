<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Config;

class CompananiesController extends Controller
{

    private function getRoute() {
        return 'companies';
    }

    public function index() {
        return view('backend.companies.index');
    }

    public function add()
    {
        $companies = new User();
        $companies->form_action = $this->getRoute() . '.create';
        $companies->page_title = 'Add New Company';
        $companies->page_type = 'create';
        return view('backend.companies.form', [
            'companies' => $companies
        ]);
    }
}
