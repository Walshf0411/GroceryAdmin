@extends('template')
@section('title', 'Edit Delivery Limit')
@section('content')
{{-- <script>
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
    </script> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit Delivery Limit</h4>

            </div>
            <div class="card-body">
                <div class="px-3">

                    <form class="form" action="../update_deliverylimit" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="delivery_charges">Delivery Limit</label>
                                <input type="text" id="delivery_charges" value="{{$delivery->content}}" class="form-control"  name="delivery_charges" required >
                            </div>
                         </div>

                        <div class="form-actions">

                            <button type="submit"  name="up_tim" class="btn btn-raised btn-raised btn-warning">
                                <i class="fa fa-check-square-o"></i> Update Delivery Limit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
