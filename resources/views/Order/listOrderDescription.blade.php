@extends('template')
@section('title', 'List Orders')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Description List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Order Id</th>
                                    <th>Vendor Id</th>
									<th>Product Id</th>
                                    <th>Counts</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderdescription as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->order_id }}</td>
                                    <td>{{ $row->vendor_id }}</td>
                                    <td>{{ $row->product_id }}</td>
                                    <td>{{ $row->counts }}</td>
                                    <td>
									    <a class="primary"  href="edit/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
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
