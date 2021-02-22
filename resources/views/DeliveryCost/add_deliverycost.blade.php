@extends('template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Delivery Costs</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" action="insertDeliveryCost" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="delivery_cost">DeliveryCost</label>
                                <input type="text" id="delivery_charges"  class="form-control"  name="delivery_charges" required >
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit"  name="up_cost" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save DeliveryCost
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
