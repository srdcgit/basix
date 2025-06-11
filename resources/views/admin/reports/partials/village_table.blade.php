

<table class="table datatable-save-state">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Gram Panchyat Name</th>
            <th>Total Executive</th>
            <th>Total Field Staff</th>
            <th>Total Crp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($villages  as $key => $village)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$village->name}}</td>
            <td>{{@$village->gram_panchyat->name}}</td>
            <td>{{$village->getUserCount('3')}}</td>
            <td>{{$village->getUserCount('4')}}</td>
            <td>{{$village->getUserCount('5')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>