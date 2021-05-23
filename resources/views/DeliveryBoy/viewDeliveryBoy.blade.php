@extends('template')
@section('title', 'Delivery Boy Profile')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Delivery Boy Profile</h4>
                </div>
            </div>
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="card-block card-dashboard">

                            <table class="table table-striped table-bordered ">
                                <h4 class="card-title" style="padding-top: 2%">Personal Details</h4>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone No</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Availablity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>{{ $row->id}}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->phoneno }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->address }}</td>
                                        @if ($row->is_available)
                                            <td>Yes</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="card-block card-dashboard">

                            <table class="table table-striped table-bordered dom-jQuery-events">
                                <h4 class="card-title" style="padding-top: 2%;padding-left:2%">Order Details</h4>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Amount</th>
                                        <th>Delivery Charges</th>
                                        <th>Total Amount</th>
                                        <th>Timeslot</th>
                                        <th>Status</th>
                                        <th>Rider</th>
                                        <th>Mode of Payment</th>
                                        <th>Date of Delivery</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->delivery_charges }}</td>
                                        <td>{{ $row->total_amount }}</td>
                                        <td>{{ $row->timeslot }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->rider_id }}</td>
                                        <td>{{ $row->mode_of_payment }}</td>
                                        <td>{{ $row->date_of_delivery }}</td>

                                        <td>
                                            <a class="primary"  href="../order/edit/{{ $row->id }}" data-original-title="" title="Edit Order">
                                                <i class="ft-edit font-medium-3"></i>
                                            </a>

                                            <a class="danger" href="../order/delete/{{ $row->id }}" data-original-title="" title="Delete Order">
                                                <i class="ft-trash font-medium-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body collapse show">
                        <div class="card-block card-dashboard">

                            <table class="table">
                                <h4 class="card-title" style="padding-top: 2%">Performance Details</h4>
                                <thead>
                                    <tr>
                                        <th>Availability</th>
                                        <th>Delivered</th>
                                        <th>Cancelled</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>@if ($message->status == 1 )
                                            <td>Available</td>
                                        @else
                                            <td>Not Available</td>
                                        @endif
                                        <td>{{ $message->cancelled }}</td>
                                        <td>{{ $message->delivered }}</td>
                                        <td>{{ $message->sales }}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

@endsection
