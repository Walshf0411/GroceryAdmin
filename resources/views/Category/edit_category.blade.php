@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit Category</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="cname">Category Name</label>
                                <input type="text" id="cname" value="Cateogry" class="form-control"  name="cname" required >
                            </div>
                            <div class="form-group">
                                <label>Category Image</label>
                                <input type="file" name="f_up" class="form-control-file" id="projectinput8">
                            </div>
                            <div class="form-group">
                                <img src="img" class="media-object round-media"  style="height: 75px;"/>
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
