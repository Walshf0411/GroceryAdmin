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
                            <thead></thead>
                            <tbody>
                                @foreach($address as $row)
                                <tr>
                                    <th>Address 1</th>
                                    <td colspan="3">{{ $row->address_line_1}}</td>
                                </tr>
                                <tr>
                                    <th>Address 2</th>
                                    <td  colspan="3">{{ $row->address_line_2 }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td  colspan="3">{{ $row->city }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td colspan="3">{{ $row->state }}</td>
                                </tr>
                                <tr>
                                    <th>Pincode </th>
                                    <td colspan="3">{{ $row->pincode }}</td>
                                </tr>
                                <tr>
                                    <th>Address Type</th>
                                    <td colspan="3">{{ $row->address_type }}</td>
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
