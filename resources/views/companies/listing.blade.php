@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies
                <div class="float-right"><a href="/companies/create">Add</a></div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="float-right">{{ $companies->links() }}</div><br>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)  
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                    <?php
                                    $exists = Storage::disk('public')->exists($company->logo);
                                    ?>
                                    @if ($exists)
                                    <img src="/storage/{{ $company->logo }}" height="100px" width="100px" /> @endif
                                    </td>
                                    <td>
                                    <a href="/companies/{{$company->id}}/edit" class="btn btn-primary">Edit</a> <br/><br/>
                                    <form method="POST" action="/companies/{{$company->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-danger delete-company" value="Delete" onclick="return confirm('Are you sure you want to delete?')">
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
    </div>
</div>
@endsection
