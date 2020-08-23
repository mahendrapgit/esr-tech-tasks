@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees
                <div class="float-right"><a href="/employees">Back</a></div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="/employees" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="first_name" class="required">First Name</label>

                    <input id="first_name" name="first_name" autocomplete="off" type="text" class="@error('first_name') is-invalid @enderror form-control">

                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br/>
                    <label for="last_name" class="required">Last Name</label>

                    <input id="last_name" name="last_name" autocomplete="off" type="text" class="@error('last_name') is-invalid @enderror form-control">

                    @error('last_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror            
                    <br/>
                    <label for="company_id">Company</label>

                    <select id="company_id" name="company_id" autocomplete="off" type="text" class="@error('company_id') is-invalid @enderror form-control">
                        <option value="">Select</option>
                        @foreach($companies as $company)  
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>

                    @error('company_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br/>
                    <label for="email">Email</label>

                    <input id="email" name="email" autocomplete="off" type="text" class="@error('email') is-invalid @enderror form-control">

                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    

                    <br/>
                    <label for="phone">Phone</label>

                    <input id="phone" name="phone" autocomplete="off" type="text" class="@error('phone') is-invalid @enderror form-control">

                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br/>            
                    
                    <input type="submit" value="Submit" class="form-control">
                    </div>
                </form>            
            </div>
        </div>
    </div>
</div>
@endsection
