@extends('template')
@section('title', 'Edit Delivery Boy')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Edit Delivery Boy</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data" action="../editDeliveryBoy/{{ $delivery['0']->id }}">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="{{ $delivery['0']->name }}" class="form-control"  name="name" required >
                            </div>
                            <div class="form-group">
                                <label for="phoneno">Phone no</label>
                                <input type="number" id="phoneno" value="{{ $delivery['0']->phoneno }}" class="form-control"  name="phoneno" required >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" value="{{ $delivery['0']->email }}" class="form-control"  name="email" required >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password"  class="form-control"  name="password" required >
                                <p>Please note: If you add any value in password field it will be cosidered as new password else it will remain as previous</p>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="{{ $delivery['0']->address }}" class="form-control"  name="address" required >
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
