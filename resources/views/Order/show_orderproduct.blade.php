@extends('template')
@section('title', 'Ordered Products')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Details</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Id No.</th>
                                    {{-- <th>Category Name</th> --}}
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Vendor name</th>
                                    {{-- <th>Total</th> --}}
                                    {{-- <th>Count</th> --}}
                                    {{-- <th>Product Image</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalss=0 ?>
                                @foreach($orderproducts as $row)
                                <?php $totalss += $row->price ?>
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->discount}}</td>
                                    <td><a href="../vendorProfile/{{ $row->vendor_id }}">{{ $row->vendor_name }}</a></td>

                                    {{-- <td>
                                    @foreach( explode("|", $row->images) as $img)
                                        <img class="media-object round-media" src="storage\images\Product\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                    @endforeach
                                    </td> --}}

                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan=3>Total</td>
                                    <td>{{ $totalss }}</td>
                                </tr>
                                {{-- {{ dd($total) }}; --}}
                                {{-- <td>{{ $total->total->total}}</td> --}}
                                {{-- {{ $total = 0 }} --}}
                                {{-- @foreach($total as $row) --}}
                                {{-- <td>{{ $total}}</td> --}}
                                {{-- @endforeach --}}
                                {{-- <td>{{ $total->total }}</td> --}}
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
