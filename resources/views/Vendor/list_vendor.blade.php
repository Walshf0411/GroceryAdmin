@extends('template')
@section('title', 'List Vendors')
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
                                    <th>Sr No.</th>
                                    {{-- <th>Id</th> --}}
                                    <th>Name</th>
                                    <th>Nickname</th>
                                    <th>Shop Name</th>
                                    <th>Mobile Number</th>
									<th>Address</th>
                                    <th>Email ID</th>
                                    <th>GST Number</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i =0; ?>

                                @foreach($vendordetails as $row)
                                <tr>
                                    <td><?php echo ++$i;?></td>
                                  {{-- <td><a href="vendorProfile/{{ $row->id }}">{{ $row->id }}</a></td> --}}
                                  <td><a href="vendorProfile/{{ $row->id }}">{{ $row->name }}</a></td>
                                  <td><a href="vendorProfile/{{ $row->id }}">{{ $row->nickname }}</a></td>
                                  <td><a href="vendorProfile/{{ $row->id }}"> {{ $row->shop_name }}</a></td>
                                  <td> <a href="vendorProfile/{{ $row->id }}">{{ $row->mobile_number }}</a></td>
                                  <td><a href="vendorProfile/{{ $row->id }}">{{ $row->address }}</a></td>
                                  <td><a href="vendorProfile/{{ $row->id }}">{{ $row->email_id }}</a></td>
                                    <td><a href="vendorProfile/{{ $row->id }}">{{ $row->gst_number }}</a></td>

                                    <td>
									    <a class="primary"  href="block_Vendor/{{ $row->id }}" data-original-title="" title="block vendor">
                                            <i class="fa fa-ban font-medium-3"></i>
                                        </a>
                                        &ensp;
									    {{-- <a class="danger" href="delete_block_vendor/{{ $row->id }}" data-original-title="" title="delete vendor">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a> --}}

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
