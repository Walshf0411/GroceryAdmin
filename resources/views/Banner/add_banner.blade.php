@extends('template')
@section('title', 'Add Banner')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Banner</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" action="/insertBanner" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="cname">Banner Image</label>
                                <input type="file" id="pimg" class="form-control"  placeholder="Enter Banner Image" name="banner_image" required>
                            </div>
                                <div class="form-group">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save Banner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
