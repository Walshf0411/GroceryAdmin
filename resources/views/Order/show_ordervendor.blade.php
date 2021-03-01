@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>

                            </thead>
                            <tbody>
                                @foreach($vendordetails as $row)
                                <tr>
                                    <th  >Vendor Name</th>
                                    <td colspan="3">{{ $row->name }}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Shop Name</th>
                                    <td  colspan="3">{{ $row->shop_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td  colspan="3">{{ $row->address }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td colspan="3">{{ $row->mobile_number }}</td>
                                </tr>
                                <tr>
                                    <th>Email ID</th>
                                    <td colspan="3">{{ $row->email_id }}</td>
                                </tr>
                                <tr>
                                    <th>Rating</th>
                                    <td colspan="3">{{ $row->rating }}</td>
                                </tr>
                                <tr>
                                    <th>GST Number</th>
                                    <td colspan="3">{{ $row->gst_number }}</td>
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
