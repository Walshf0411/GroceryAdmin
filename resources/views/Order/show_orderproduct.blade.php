@extends('template')
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
                                    {{-- <th>Count</th> --}}
                                    {{-- <th>Product Image</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderproducts as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->discount}}</td>
                                    <td><a href="../showOrderVendor/{{ $row->vendor_id }}">{{ $row->vendor_name }}</a></td>
                                    {{-- <td>{{ $row->count}}</td> --}}
                                    {{-- <td>
                                    @foreach( explode("|", $row->images) as $img)
                                        <img class="media-object round-media" src="storage\images\Product\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                    @endforeach
                                    </td> --}}

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
