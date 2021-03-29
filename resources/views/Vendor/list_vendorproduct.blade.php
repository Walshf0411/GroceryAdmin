@extends('template')
@section('title', 'List Vendor Products')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor Product List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 {{-- <th>Id No.</th> --}}
                                    <th>Business id</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Vendor Name</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Stocks</th>
                                    <th>Discount</th>
									{{-- <th>Total Subcategory</th> --}}
                                    {{-- <th>Action</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendordetails as $row)
                                <tr>


                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->product_name }}</td>

                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->unit }}</td>
                                    <td>{{ $row->description }}</td>

                                    <td>{{ $row->images }}</td>
                                    <td>{{ $row->stocks }}</td>
                                    <td>{{ $row->discount }}</td>
                                    {{-- <td>
                                        <a class="primary"  href="showVendorProduct/{{ $row->vendor_id }}" data-original-title="" title="click">
                                            <i class="fa fa-hand-pointer-o font-medium-3"></i><span>Click</span>
                                        </a>
                                    </td> --}}

                                    {{-- <td>
									<a class="primary"  href="edit_product/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="deleteProduct/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>

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
