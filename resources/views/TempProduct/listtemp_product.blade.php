@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Temporary Product List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Category Name</th>
                                    <th>Temporary Product Name</th>
                                    <th>Product Image</th>
                                    <th>Vendor Shop Name</th>
									{{-- <th>Total Subcategory</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempproducts as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->temp_product_name }}</td>
                                    <td>
                                    @foreach( explode("|", $row->images) as $img)
                                        <img class="media-object round-media" src="storage\images\TempProduct\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                    @endforeach
                                    </td>
                                    <td>{{ $row->shop_name }}</td>
                                    <td>
									<a class="primary"  href="addProduct/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="temp_delete_product/{{ $row->id }}" data-original-title="" title="">
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
