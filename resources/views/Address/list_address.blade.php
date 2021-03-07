@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Address Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Address 1</th>
                                    <th>Address 2</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode </th>
                                    <th>Address Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($address as $row)
                                <tr>
                                    <td>{{ $row->address_line_1}}</td>
                                    <td>{{ $row->address_line_2 }}</td>
                                    <td>{{ $row->city }}</td>
                                    <td>{{ $row->state }}</td>
                                    <td>{{ $row->pincode }}</td>
                                    <td>{{ $row->address_type }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
