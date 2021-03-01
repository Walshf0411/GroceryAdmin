@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Customer Id</th>
                                    <th>Address Id</th>
									<th>Amount</th>
                                    <th>Delivery Charges</th>
                                    <th>Total Amount</th>
									<th>Timeslot</th>
                                    <th>Status</th>
                                    <th>Rider</th>
                                    <th>Mode of Payment</th>
									<th>Date of Delivery</th>
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $row)
                                <tr>
                                    <td><a href="../showOrderProduct/{{ $row->id }}">{{ $row->id }}</a></td>
                                    <td>{{ $row->customer_id }}</td>
                                    <td><a href="../showOrderAddress/{{ $row->address_id }}">{{ $row->address_id }}</a></td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->delivery_charges }}</td>
                                    <td>{{ $row->total_amount }}</td>
                                    <td>{{ $row->timeslot }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>{{ $row->rider_id }}</td>
                                    <td>{{ $row->mode_of_payment }}</td>
                                    <td>{{ $row->date_of_delivery }}</td>
                                   {{-- <td></td> --}}

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
