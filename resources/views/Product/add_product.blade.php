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
                                <label for="projectinput6">Select SubCategory</label>
                                    <select id="sub_list" name="subcategory_id" class="form-control">
                                        @foreach($category as $item)
                                            <option  value="{{ $item->id }}">{{ $item->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="projectinput6">Select Vendor</label>
                                    <select id="sub_list" name="vendor_id" class="form-control">
                                        @foreach($vendors as $item)
                                            <option  value="{{ $item->id }}">{{ $item->shop_name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" id="unit"  class="form-control"  name="unit" required >
                                {{-- <select name="unit" id="unit">
                                    <option value="mL">mL(mililiter)</option>
                                    <option value="gm">gm(gram)</option>
                                </select> --}}
                                {{-- <input type="text" id="unit"  class="form-control"  name="unit" required > --}}
                            </div>
                            <div class="form-group">
                                <label for="pname">Discount</label>
                                <input type="text" id="discount"  class="form-control"  name="discount" required >
                            </div>
                            <div class="form-group">
                                <label for="pname">Price</label>
                                <input type="text" id="price"  class="form-control"  name="price" required >
                            </div>
                            <div class="form-group">
                                <label for="pname">Description</label>
                                <input type="text" id="description"  class="form-control"  name="description" required >
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
