@extends('template')
@section('title', 'Ordered Products')
@section('content')
<style>
    table, th, td{
        text-align:center;
    }
</style>
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
                                    <th>Product Name</th>
                                    <th>Vendor name</th>
                                    <th>Product Description</th>
                                    <th>Price</th>
                                    <th>Count</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>
        <tbody>
                                <?php $totalss=0 ?>
                                @foreach($orderdetails as $row)
                                <?php $totalss += $row->price * $row->counts  ?>
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->product->name }}</td>
                                    <td><a href="../vendorProfile/{{ $row->vendor_id }}">{{ $row->vendor->name }}</a></td>
                                    <td>{{ $row->product->description }}</td> 
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->counts }}</td>
                                    <td>{{ $row->price * $row->counts }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan=4>Total</td>
                                    <td colspan =3>{{ $totalss }}</td>
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
