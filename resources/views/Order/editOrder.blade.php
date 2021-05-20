@extends('template')
@section('title', 'Edit Order')
@section('content')<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit Order</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" action="../update/{{ $order->details->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="id">Id</label>
                                <input type="text" id="id"  class="form-control"  value="{{ $order->details->id }}" name="id" readonly="readonly" >
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Customer Id</label>
                                <input type="number" id="customer_id"  class="form-control"  value="{{ $order->details->customer_id }}" name="customer_id" readonly="readonly" >
                            </div>
                            <div class="form-group">
                                <label for="address_id">Address Id</label>
                                <select id="address_id"  class="form-control"  name="address_id" required>
                                @foreach ($order->address as $item )
                                    @if($item->id == $order->details->address_id)
                                    <option class="form-control" value="{{ $item->id }}" selected>{{ $item->id }} | {{ $item->address_line_1 }} | {{ $item->address_line_2 }} | {{ $item->city }} | {{ $item->state }} | {{ $item->pincode }} | {{ $item->address_type }}</option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->id }}">{{ $item->id }} | {{ $item->address_line_1 }} | {{ $item->address_line_2 }} | {{ $item->city }} | {{ $item->state }} | {{ $item->pincode }} | {{ $item->address_type }}</option><br>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" id="amount"  class="form-control"  value="{{ $order->details->amount }}" name="amount" required >
                            </div>
                            <div class="form-group">
                                <label for="delivery_charges">Delivery Charges</label>
                                <input type="text" id="delivery_charges"  class="form-control" value="{{ $order->details->delivery_charges }}" name="delivery_charges" required >
                            </div>
                            <div class="form-group">
                                <label for="total_amount">Total Amount</label>
                                <input type="text" id="total_amount"  class="form-control" value="{{ $order->details->total_amount }}" name="total_amount" required >
                            </div>
                            <div class="form-group">
                                <label for="timeslot">Timeslot</label>
                                <select id="timeslot"  class="form-control"  name="timeslot" required>
                                @foreach ( $order->timeslots as $item )
                                    @if( $item->timeslot == $order->details->timeslot)
                                    <option class="form-control" value="{{ $item->timeslot }}" selected>{{ $item->timeslot }}</option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->timeslot }}">{{ $item->timeslot }}</option><br>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status"  class="form-control"  name="status" required>
                                @foreach ( $order->status as $item )
                                    @if( $item->status_name == $order->details->status)
                                    <option class="form-control" value="{{ $item->status_name }}" selected>{{ $item->status_name }}</option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->status_name }}">{{ $item->status_name }}</option><br>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rider_id">Rider Id</label>
                                <select id="rider_id"  class="form-control"  name="rider_id" required>
                                @foreach ( $order->rider as $item )
                                    @if( $item->id == $order->details->rider_id)
                                    <option class="form-control" value="{{ $item->id }}" selected>{{ $item->id }} | {{ $item->name }} | {{ $item->address }} | {{ $item->phoneno }} | {{ $item->email }}</option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->id }}">{{ $item->id }} | {{ $item->name }} | {{ $item->address }} | {{ $item->phoneno }} {{ $item->email }}</option><br>
                                    @endif
                                @endforeach
                                </select>
                                <label> Rider ID | Name | Address | Phone Number | Email Address </label>
                            </div>
                            <div class="form-group">
                                <label for="mode_of_payment">Mode of Payment</label>
                                <select id="mode_of_payment"  class="form-control"  name="mode_of_payment" required>
                                @foreach ( $order->mop as $item )
                                    @if( $item->mode == $order->details->mode_of_payment)
                                    <option class="form-control" value="{{ $item->mode }}" selected>{{ $item->mode }} </option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->mode }}">{{ $item->mode }} </option><br>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_delivery">Date of Delivery</label>
                                <input type="date" id="date_of_delivery"  class="form-control" value="{{ $order->details->date_of_delivery }}" name="date_of_delivery" required >
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <input type="text" id="comment"  class="form-control" value="{{ $order->details->comment }}" name="comment" >
                            </div>
                            <div class="form-group">
                                <label for="customer_signature">Customer Signature</label>
                                @if ( $order->details->customer_signature == "")
                                    Signature will Appearafter the order is delivered
                                @else
                                    <img src="..\..\storage\images\CustomerSignatures\{{ $order->details->id }}\{{ $order->details->customer_signature }}" style="height: 50vh; width:10vw">
                                @endif
                            </div>

                                <div class="form-group">
                            </div>
                        </div>
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Id No.</th>

                                    <th>Vendor Id</th>
                                    <th>Product Id</th>
                                    <th>Count</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($order->description as $row)

                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td><a href= "../../vendorProfile/{{ $row->vendor_id }}">{{ $row->vendor_id }} || {{ $row->vendor->name }} || {{ $row->vendor->shop_name }} || {{ $row->vendor->mobile_number }}</a></td>
                                    <td><a href="../../productDetails/{{ $row->product_id }}"> {{ $row->product_id }} || {{ $row->product->name }} || {{ $row->product->price }}</td>
                                    <td>{{ $row->counts }}</td>
                                    <td>
                                        <a class="primary"  href="../../../orderDescription/edit/{{ $row->id }}" data-original-title="" title="Edit Order">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

                                        <a class="danger" href="../../../orderDescription/delete/{{ $row->id }}" data-original-title="" title="Delete Order">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach


                            </tbody>

                        </table>

                        </table>
                        <div class="form-actions">
                            <button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save Delivery Boy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
