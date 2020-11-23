@extends('template')
@section('content')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result).attr('style', 'display:block;height: 75px;');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Product</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="insertProduct">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="pname">Product Name</label>
                                <input type="text" id="cname"  class="form-control"  name="name" required >
                            </div>
                            <div class="form-group">
                            <label for="projectinput6">Select Category</label>
                                <select id="sub_list" name="category_id" class="form-control">
                                    @foreach($category as $item)
                                        <option  value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Images</label>
                                <input type="file" onchange="readURL(this);" name="images[]" class="form-control-file" id="projectinput8" multiple>
                            </div>
                            <div class="form-group">
                                <img  style="display: none;" class="media-object round-media" id="blah"/>
                            </div>
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
