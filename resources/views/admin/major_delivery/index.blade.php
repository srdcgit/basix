@extends('admin.layout.index')

@section('title')
    Manage Major Delivery
@endsection

@section('content')

<div class="card">
    
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Manage Major Delivery</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a href="{{route('admin.major_delivery.create')}}" class="btn btn-primary text-right">Add New Major Delivery</a>
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
                    <th>Project Name</th>
                    <th>Deliverable</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (App\Models\MajorDelivery::all()  as $key => $major_delivery)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$major_delivery->project->name}}</td>
                    <td>{{$major_delivery->deliverable}}</td>
                    <td>{{$major_delivery->date?$major_delivery->date->format('d M,Y'):''}}</td>
                    <td>
                        <a href="{{route('admin.major_delivery.edit',$major_delivery->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('admin.major_delivery.destroy',$major_delivery->id)}}" method="POST">
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