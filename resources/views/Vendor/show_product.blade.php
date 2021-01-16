@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor Profile</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                @foreach($vendordetails as $row)
                                <tr>
                                    <th  >Vendor Name</th>
                                    <td colspan="3">{{ $row->name }}</td>
                                </tr>
                                <tr>
                                    <th>Vendor Shop Name</th>
                                    <td  colspan="3">{{ $row->shop_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td  colspan="3">{{ $row->address }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td colspan="3">{{ $row->mobile_number }}</td>
                                </tr>
                                <tr>
                                    <th>Email ID</th>
                                    <td colspan="3">{{ $row->email_id }}</td>
                                </tr>
                                <tr>
                                    <th>Rating</th>
                                    <td colspan="3">{{ $row->rating }}</td>
                                </tr>
                                <tr>
                                    <th>GST Number</th>
                                    <td colspan="3">{{ $row->gst_number }}</td>
                                </tr>
                                @endforeach

                                <tr>

                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Unit</th>
                                    <th>Description</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($vendordetails as $row)
                                <tr>


                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->unit }}</td>
                                    <td>{{ $row->description }}</td>
                                    {{-- <td>
                                    @foreach( explode("|", $row->images) as $img)
                                        <img class="media-object round-media" src="storage\images\Product\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                    @endforeach
                                    </td>
                                    <td>
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
