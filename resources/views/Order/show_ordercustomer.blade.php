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
                                @foreach($customer as $row)

                                <tr>
                                    <th>Id No.</th>
                                    <td colspan="3">{{ $row->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer Name</th>
                                    <td colspan="3">{{ $row->c_name }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td  colspan="3">{{ $row->mobile_number}}</td>
                                </tr>
                                <tr>
                                    <th>Email id</th>
                                    <td  colspan="3">{{ $row->email_id }}</td>
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