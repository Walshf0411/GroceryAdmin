@extends('template')
@section('title', 'List Products')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
                                 <th>Id No.</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Vendor Name</th>
                                    <th>Unit</th>
                                    <th>Product Image</th>
									{{-- <th>Total Subcategory</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                     {{-- {{ dd($row)}} --}}
                                    <td>{{ $row->category->category_name }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->vendor->name }}</td>
                                    <td>{{ $row->unit }}</td>
                                    <td>
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
