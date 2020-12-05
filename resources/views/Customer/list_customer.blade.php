@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								    <th>Id No.</th>
                                    <th>Customer Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email id</th>
									<th>Wallet</th>
                                    <th>Unique Code</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerdetails as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->c_name }}</td>
                                    <td>{{ $row->mobile_number}}</td>
                                    <td>{{ $row->email_id }}</td>
                                    <td>{{ $row->wallet }}</td>
                                    <td>{{ $row->unique_code }}</td>
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