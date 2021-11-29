@extends('template')
{{-- @include('flash-message') --}}
@section('title', 'Add Category')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Sub Category</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="insertSubCategory">
                        @csrf
                        <div class="form-body">
                                <div class="form-group">
                                    <label for="cname">Sub Category Name</label>
                                    <input type="text" id="subcategory_name"  class="form-control"  name="subcategory_name" required >
                                </div>
                            <div class="form-group">
                                <label>Sub Category Image</label>
                                <input type="file" name="subcategory_image" class="form-control-file" id="subcategory_image" required>
                            </div>
                            {{-- <div class="form-group">
                                <img src="some_source" class="media-object round-media"  style="height: 75px;"/>
                            </div> --}}
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
