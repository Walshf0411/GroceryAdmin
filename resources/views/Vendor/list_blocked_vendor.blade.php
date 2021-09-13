@extends('template')
@section('title', 'List Blocked Vendors')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blocked Vendor List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Vendor Name</th>
                                    <th>Nick Name</th>
                                    <th>Shop Name</th>
                                    <th>Mobile Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendordetails as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->nickname }}</td>
                                    <td>{{ $row->shop_name }}</td>
                                    <td>{{ $row->mobile_number }}</td>

                                    <td>
									    <a class="primary"  href="unblock_Vendor/{{ $row->id }}" data-original-title="" title="unblock vendor">
                                            <i class="fa fa-unlock font-medium-3"></i>
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
