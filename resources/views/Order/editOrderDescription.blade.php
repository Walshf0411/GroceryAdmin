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
                    <form class="form" method="post" enctype="multipart/form-data" action="../update/{{ $orderdescription->id }}?value={{ $orderdescription->counts }}&productId={{ $orderdescription->product_id }}">
                        @csrf
                        <div class="form-body">
                                {{-- {{ dd($orderdescription->vendor->name)}} --}}
                            <div class="form-group">
                                <label for="id">Order Id</label>
                                <input type="text" id="id" value="{{ $orderdescription->id}}" class="form-control" readonly= "readonly" name="id" required >
                            </div>
                            <div class="form-group">
                                <label for="order_id">Order Id</label>
                                <input type="text" id="order_id" value="{{ $orderdescription->order_id}}" class="form-control" readonly= "readonly" name="order_id" required >
                            </div>
                            <div class="form-group">
                                <label for="vendor_id">Vendor Id</label>
                                <input type="text" id="vendor_id" value="{{ $orderdescription->vendor_id }}" class="form-control" readonly= "readonly" name="vendor_id" required >
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product Id</label>
                                <input type="text" id="product_id" value="{{ $orderdescription->product_id }}" class="form-control" readonly= "readonly" name="product_id" required >
                            </div>
                            <div class="form-group">
                                <label for="counts">Counts</label>
                                <input type="text" id="counts" value="{{ $orderdescription->counts }}" class="form-control"  name="counts" required >
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" id="price" value="{{ $orderdescription->price }}" class="form-control"  name="price" required >
                            </div>
                            <div class="form-group">
                                <label for="subtotal">Sub Total Price</label>
                                <input type="text" id="subtotal" value="{{ $orderdescription->price * $orderdescription->counts }}" class="form-control"  name="subtotal" readonly="readonly">
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
