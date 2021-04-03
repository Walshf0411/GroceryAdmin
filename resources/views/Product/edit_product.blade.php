@extends('template')
@section('title', 'Edit Products')
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
                <h4 class="card-title" id="basic-layout-form">Edit Product</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="../update_product/{{ $product->id }}">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="cname">Product Name</label>
                                <input type="text" id="cname" value="{{ $product->name }}" class="form-control"  name="name" required >
                            </div>
                            <div class="form-group">
                                <label for="vendor_id">Vendor ID</label>
                                <input type="text" id="vendor_id" value="{{ $product->vendor_id }}" class="form-control" name="vendor_id" readonly >
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="number" id="unit" value="{{ $product->unit }}"  class="form-control"  name="unit" required >
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" id="description"  class="form-control"  name="description" required >{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" id="price" value="{{ $product->price }}"  class="form-control"  name="price" required >
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" id="discount" value="{{ $product->discount }}"  class="form-control"  name="discount" required >
                            </div>
                            <div class="form-group">
                                <label for="cname">Category Name</label>
                                <select id="sub_list" name="category_id" class="form-control">
                                    @foreach($category as $item)
                                        @if($item->category_name == $product->category_name)
                                            <option value="{{ $item->id }}" selected>{{ $item->category_name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product Image</label>
                                <input type="file"  name="images[]" onchange="readURL(this);" class="form-control-file" id="projectinput8" multiple>
                            </div>
                            <div class="form-group">
                                @foreach( explode("|", $product->images) as $img)
                                <img class="media-object round-media" id="blah" src = "..\storage\images\Product\{{ $product->id }}\{{ $img }}" alt="your image" height="100px" width="100px"/>
                                @endforeach
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
