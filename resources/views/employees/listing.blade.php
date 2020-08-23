@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees
                <div class="float-right"><a href="/employees/create">Add</a></div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            <div class="float-right">{{ $employees->links() }}</div><br>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)  
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>@if ($employee->company) 
                                    {{ $employee->company->name }}
                                @endif
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>
                            <a href="/employees/{{$employee->id}}/edit" class="btn btn-primary">Edit</a> <br/><br/>
                            <form method="POST" action="/employees/{{$employee->id}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger delete-employee" value="Delete" onclick="return confirm('Are you sure you want to delete?')">
                                </div>
                            </form>
                            </td>
                        </tr>
                    @endforeach    
                </tbody>    
            </table>
        </div>
    </div>
</div>
@endsection
