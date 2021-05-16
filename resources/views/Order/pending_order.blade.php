@extends('template')
@section('title', 'List Pending Orders')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pending Orders</h4>
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
                                    <th>Comment</th>
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingorders as $row)
                                <tr>
                                    <td><a href="../orderDetails/{{ $row->id }}">{{ $row->id }}</a></td>
                                    <td><a href="../showCustomer/{{ $row->customer_id }}">{{ $row->customer_id }}</a></td>
                                    <td><a href="../showAddress/{{ $row->address_id }}">{{ $row->address_id }}</a></td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->delivery_charges }}</td>
                                    <td>{{ $row->total_amount }}</td>
                                    <td>{{ $row->timeslot }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td><a href="../viewDeliveryBoy/{{ $row->rider_id }}">{{ $row->rider_id }}</a></td>
                                    <td>{{ $row->mode_of_payment }}</td>
                                    <td>{{ $row->date_of_delivery }}</td>
                                   <td>{{ $row->comment }}</td>
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
