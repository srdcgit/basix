@extends('admin.layout.index')

@section('title')
    Manage Respondent Master Form
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Respondent Master Form</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.respondent_master.create')}}" class="btn btn-primary text-right">Add New Respondent Master Form</a>
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
                    <th>Name</th>
                    <th>Block Name</th>
                    <th>District Name</th>
                    <th>Gram Panchyat Name</th>
                    <th>Village Name</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\RespondentMaster::all()  as $key => $respondent_master)
                <tr>
                    <td>{{@$respondent_master->farmer_id}}</td>
                    <td>{{$respondent_master->name}}</td>
                    <td>{{@$respondent_master->block->name}}</td>
                    <td>{{@$respondent_master->district->name}}</td>
                    <td>{{@$respondent_master->gram_panchyat->name}}</td>
                    <td>{{@$respondent_master->village->name}}</td>
                    <td>
                        <a href="{{route('admin.respondent_master.edit',$respondent_master->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('admin.respondent_master.destroy',$respondent_master->id)}}" method="POST">
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