@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Delivery Boy</h4>

            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">




                            <div class="form-group">
                                <label for="cname">Delivery Boy Name</label>
                                <input type="text" id="aname" class="form-control" placeholder="Enter Delivery Boy Name"  name="cname" required >
                            </div>

                            <div class="form-group">
                                <label for="cname">Delivery Boy Mobile Number(Only Digit)</label>
                                <input type="text" id="dcharge"  maxlength="10" class="form-control" pattern="[0-9]+"  placeholder="Enter Delivery Boy Mobile Number" name="dcharge" required >
                            </div>

                                <div class="form-group">
                                <label for="cname">Delivery Boy Email Address</label>
                                <input type="email"   class="form-control"   placeholder="Enter Delivery Boy Email Address" name="email" required >
                            </div>

                            <div class="form-group">
                                <label for="cname">Delivery Boy Password</label>
                                <input type="text"   class="form-control"   placeholder="Enter Delivery Boy Password" name="password" required >
                            </div>

 <div class="form-group">
                                <label for="cname">Select A Area</label>
                                <select name="area_id" class="form-control" required>
                                    <option value="">Select A Area</option>

                                    <option value="area1">area1</option>

                                </select>
                            </div>

                                <div class="form-group">
                                <label for="cname">Delivery Boy  Address</label>
                            <textarea style="resize: none;" class="form-control" name="raddress"></textarea>
                            </div>

                                <div class="form-group">
                                <label for="cname">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>





                        </div>

                        <div class="form-actions">

                            <button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-motorcycle"></i> Save  Delivery Boy
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
