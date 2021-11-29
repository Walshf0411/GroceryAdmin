@extends('template')
@section('title', 'Edit Order')
@section('content')<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Assign Order</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    {{-- {{ dd($order) }} --}}
                    <form class="form" action="../assigned/{{ $order->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- {{ dd() }} --}}
                        <div class="form-body">
                            <div class="form-group">
                                <label for="order_details">Please select rider for Order id # {{ $order->id }}</label> <br>


                                <label for="rider_details">Rider Details</label> <br>
                                <label for="rider">Rider ID | Name | Address | Phone Number | Email Address</label>
                                <select id="rider_id"  class="form-control"  name="rider_id" required>
                                @foreach ( $delivery as $item )
                                    <option class="form-control" value="{{ 0 }}">Please select</option><br>
                                    @if( $item->id == $order->rider_id)
                                    <option class="form-control" value="{{ $item->id }}" selected>{{ $item->id }} | {{ $item->name }} | {{ $item->address }} | {{ $item->phoneno }} | {{ $item->email }}</option><br>
                                    @else
                                    <option class="form-control" value="{{ $item->id }}">{{ $item->id }} | {{ $item->name }} | {{ $item->address }} | {{ $item->phoneno }} {{ $item->email }}</option><br>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

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
