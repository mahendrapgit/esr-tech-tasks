@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies
                <div class="float-right"><a href="/companies">Back</a></div>
            </div>
            <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <form method="POST" action="/companies" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="required">Name</label>

                        <input id="name"  name="name" autocomplete="off" type="text" class="@error('name') is-invalid @enderror form-control">

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <br/>
                        <label for="email">Email</label>

                        <input id="email" name="email" autocomplete="off" type="text" class="@error('email') is-invalid @enderror form-control">

                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        

                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror">
                        
                        @error('logo')
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
