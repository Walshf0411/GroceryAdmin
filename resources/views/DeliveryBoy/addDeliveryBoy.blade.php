@extends('template')
@section('title', 'Delivery Boy')
@section('content')<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Delivery Boy</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" action="/addDeliveryBoy" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name"  class="form-control"  name="name" required >
                            </div>
                            <div class="form-group">
                                <label for="phoneno">Phone No</label>
                                <input type="number" id="phoneno"  class="form-control"  name="phoneno" required >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email"  class="form-control"  name="email" required >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password"  class="form-control"  name="password" required >
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address"  class="form-control"  name="address" required >
                            </div>

                                <div class="form-group">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save Delivery Boy
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
