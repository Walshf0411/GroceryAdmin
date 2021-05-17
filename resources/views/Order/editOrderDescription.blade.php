@extends('template')
@section('title', 'Edit Order Description')
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
                <h4 class="card-title" id="basic-layout-form">Edit Order Description</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="../update/{{ $orderdescription['0']->id }}?value={{ $orderdescription['0']->counts }}&productId={{ $orderdescription['0']->product_id }}">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="oid">Order Id</label>
                                <input type="text" id="oid" value="{{ $orderdescription['0']->order_id}}" class="form-control" readonly= "readonly" name="order_id" required >
                            </div>
                            <div class="form-group">
                                <label for="vid">Vendor Id</label>
                                <input type="text" id="vid" value="{{ $orderdescription['0']->vendor_id }}" class="form-control" readonly= "readonly" name="vendor_id" required >
                            </div>
                            <div class="form-group">
                                <label for="pid">Product Id</label>
                                <input type="text" id="pid" value="{{ $orderdescription['0']->product_id }}" class="form-control" readonly= "readonly" name="product_id" required >
                            </div>
                            <div class="form-group">
                                <label for="counts">Counts</label>
                                <input type="text" id="counts" value="{{ $orderdescription['0']->counts }}" class="form-control"  name="counts" required >
                            </div>
                        </div>
                        <div class="form-actions">

                            <button type="submit" name="up_od" class="btn btn-raised btn-raised btn-warning">
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
