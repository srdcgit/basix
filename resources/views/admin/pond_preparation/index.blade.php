@extends('admin.layout.index')

@section('title')
    Manage Pond Preparation
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Pond Preparation</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.pond_preparation.create')}}" class="btn btn-primary text-right">Add New Pond Preparation</a>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table datatable-save-state">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Farmer Name</th>
                    <th>Date Of Update</th>
                    <th>Time Of Update</th>
                    <th>Location</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\PondPreparation::all()  as $key => $pond_preparation)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{@$pond_preparation->respondent_master->name .'('.@$pond_preparation->respondent_master->farmer_id.')'}}</td>
                    <td>{{@$pond_preparation->date_of_update?\Carbon\Carbon::parse($pond_preparation->date_of_update)->format('d M,Y'):''}}</td>
                    <td>{{@$pond_preparation->date_of_update?\Carbon\Carbon::parse($pond_preparation->date_of_update)->format('H i A'):''}}</td>
                    <td>{{@$pond_preparation->location}}</td>
                    <td>
                        <a href="{{route('admin.pond_preparation.edit',$pond_preparation->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('admin.pond_preparation.destroy',$pond_preparation->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                        <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('scripts')
@endsection