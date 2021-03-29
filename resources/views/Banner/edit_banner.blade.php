@extends('template')
@section('title', 'Edit Banner')
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
                <h4 class="card-title" id="basic-layout-form">Edit Banner</h4>

            </div>
            <div class="card-body">
                <div class="px-3">

                    <form class="form" action="../update_banner/{{ $banners['0']->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="cname">Banner Image</label>
                                {{-- <input type="file" id="pimg" onchange="loadFile(event)" > --}}
                                <input type='file' onchange="readURL(this);" class="form-control"  placeholder="Enter Banner Image" name="banner_image"  required />
                            </div>
                                <div class="form-group">
                                    <img id="blah" src = "..\storage\images\Banner\{{ $banners['0']->banner_image }}" alt="your image" height="100px" width="100px"/>
                                </div>
                            </div>

                        <div class="form-actions">

                            <button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-warning">
                                <i class="fa fa-check-square-o"></i> Update Banner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
