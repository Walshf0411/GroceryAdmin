@extends('template')
@section('title', 'Edit Category')
@section('content')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit Sub Category</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="../update_subcategory/{{ $subcategory['0']->id }}">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="cname">Category Name</label>
                                <select id="sub_list" name="category_id" class="form-control">
                                    @foreach($category as $item)
                                        @if($item->id == $subcategory['0']->category_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->category_name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cname">Sub Category Name</label>
                                <input type="text" id="cname" value="{{ $subcategory['0']->subcategory_name }}" class="form-control"  name="subcategory_name" required >
                            </div>
                            <div class="form-group">
                                <label>Sub Category Image</label>
                                <input type="file" name="subcategory_image" onchange="readURL(this);" class="form-control-file" id="projectinput8">
                            </div>
                            <div class="form-group">
                                <img class="media-object round-media" id="blah" src = "..\storage\images\Category\{{ $category['0']->category_image }}" alt="your image" height="100px" width="100px"/>
                                </div>
                        </div>
                        <div class="form-actions">

                            <button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-warning">
                                <i class="fa fa-check-square-o"></i> Edit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
