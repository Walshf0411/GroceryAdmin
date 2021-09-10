@extends('template')

@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor  List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Id<</th>
                                    <th>Name</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
									<th>Email ID</th>
                                    <th>Mobile Number</th>
                                    <th>Rating</th>
                                    <th>GST Number</th>
                                    <th>Blocked</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i =0; ?>
                                @foreach($vendordetails as $row)
                                <tr>
                                    <td><?php echo ++$i;?></td>
                                    <td>{{ $row->id }}</td>
									<td>{{ $row->name }}</td>
                                    <td>{{ $row->shop_name }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>{{ $row->email_id }}</td>
                                    <td>{{ $row->mobile_number }}</td>
                                    <td>{{ $row->rating }}</td>
                                    <td>{{ $row->gst_number }}</td>
                                    @if ( $row->is_blocked )
                                        <td color="red">Blocked</td>
                                    @else
                                        <td color="green">Not Blocked</td>
                                    @endif
                                    <td></td>
									<td>
									<a class="primary"  href="subcategory.php?edit=somenumber" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="?dele=id" data-original-title="" title="">
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
