<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies/listing', ['companies' => $companies]);
    }

    public function create()
    {
        return view('companies/create');
    }
    
    public function store(CompanyRequest $request)
    {
        $data = $request->input();        
        if (request()->hasFile('logo')) {
            $request->file('logo')->store(
                'public'
            );
        $data['logo'] = $request->logo->hashName();            ; 
        }

        Company::create($data);
        return redirect('companies')->with('status', 'Company Created!');
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies/edit')->with('company', $company);
    }
    
    public function update(CompanyRequest $request, Company $company)
    {
        if (request()->hasFile('logo')) {
            $request->file('logo')->store(
                'public'
            );
        $company->logo = $request->logo->hashName();            ; 
        }
        $company->name = $request->input('name');
        $company->email = $request->input('email');

        $company->save();
        return redirect('companies')->with('status', 'Company Updated!');
    }
    
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('companies')->with('status', 'Company Deleted!');
    }
}
