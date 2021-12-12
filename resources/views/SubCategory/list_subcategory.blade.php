@extends('template')
@section('title', 'List Categories')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sub Category List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                 <th>Id</th>
                                 <th>Category Id</th>
                                    <th>Sub Category Name</th>
                                    <th>Sub Category Image</th>
									{{-- <th>Total Subcategory</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                             <?php $i =0; ?>
                                @foreach($subcategory as $row)
                                <tr>
                                    <td><?php echo ++$i;?></td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->category_id }}</td>
                                    <td>{{ $row->subcategory_name }}</td>
                                    <td><img class="media-object round-media" src="storage\images\SubCategory\{{ $row->subcategory_image }}" alt="Generic placeholder image" style="height: 75px;"></td>
									<td>
									<a class="primary"  href="edit_subcategory/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="deleteSubCategory/{{ $row->id }}" data-original-title="" title="">
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
