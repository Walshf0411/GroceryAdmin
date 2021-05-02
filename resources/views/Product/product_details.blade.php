@extends('template')
@section('title', 'List Products')
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
                            <thead></thead>
                            <body>
                                @foreach($productdescription as $row)
                                <tr>
                                    <th>Id No.</th>
                                    <td>{{ $row->id }}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Id</th>
                                    <td>{{ $row->vendor_id}}</td>
                                </tr>
                                <tr>
                                    <th>Category Id</th>
                                    <td>{{ $row->category_id }}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $row->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Description</th>
                                    <td>{{ $row->description}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $row->price }}</td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td>{{ $row->unit }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{ $row->discount }}</td>
                                </tr>
                                <tr>
                                    <th>Product Image</th>
                                    <td>
                                        @foreach( explode("|", $row->images) as $img)
                                            <img class="media-object round-media" src="storage\images\Product\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach

                                    {{-- <td>
									<a class="primary"  href="edit_product/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									    <a class="danger" href="deleteProduct/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>

									</td> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
