<p>Movement Card Produk {{ $source->name }}</p>
<table style="height: 73px; border-color: #000000;" border="1" width="265">
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Tag ID</th>
            <th>Nama</th>
            <th>From Branch</th>
            <th>From Location</th>
            <th>To Branch</th>
            <th>To Location</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key=>$val)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{date("d F Y H:i",strtotime($val->updated_at)) }}</td>
            <td>{{ $val->product_id }}</td>
            <td>{{ $val->Products->name }}</td>
            <td>{{ $val->OriginBranch->name }}</td>
            <td>{{ $val->OriginLocations->location_name }}</td>
            <td>{{ $val->DestBranch->name }}</td>
            <td>{{ $val->DestLocations->location_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>