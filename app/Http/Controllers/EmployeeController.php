<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees/listing', ['employees' => $employees]);
    }
    
    public function create()
    {
        $companies = Company::all();
        return view('employees/create', ['companies' => $companies]);
    }
    
    public function store(EmployeeRequest $request)
    {
        $data = $request->input();
        Employee::create($data);
        event(new \App\Events\EmployeeAdded('Employee Created!'));
        return redirect('employees')->with('status', 'Employee Created!');
    }
    
    public function show(Employee $employee)
    {
        //
    }
    
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        $employee = Employee::find($employee->id);
        return view('employees/edit')
            ->with('employee', $employee)
            ->with('companies', $companies);
    }
    
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');

        $employee->save();
        return redirect('employees')->with('status', 'Employee Updated!');
    }
    
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('employees')->with('status', 'Employee Deleted!');
    }
}
