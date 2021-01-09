@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Vendor Name</th>
                                    <th>Shop Name</th>
                                    <th>Mobile Number</th>
									{{-- <th>Total Subcategory</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendordetails as $row)
                                <tr>

                                  <td><a href="showVendorProduct/{{ $row->id }}">{{ $row->id }}</a></td>
                                  <td><a href="showVendorProduct/{{ $row->id }}">{{ $row->name }}</a></td>
                                  <td><a href="showVendorProduct/{{ $row->id }}"> {{ $row->shop_name }}</a></td>
                                  <td> <a href="showVendorProduct/{{ $row->id }}">{{ $row->mobile_number }}</a></td>

                                    <td>
									    <a class="primary"  href="block_Vendor/{{ $row->id }}" data-original-title="" title="block vendor">
                                            <i class="fa fa-ban font-medium-3"></i>
                                        </a>
                                        &ensp;
									    <a class="danger" href="delete_block_vendor/{{ $row->id }}" data-original-title="" title="delete vendor">
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
        </div>
    </div>
</section>

@endsection
