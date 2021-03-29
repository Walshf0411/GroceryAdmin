@extends('template')
@section('title', 'Add Timeslots')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Add Timeslot</h4>
            </div>
            <div class="card-body">
                <div class="px-3">
                    <form class="form" action="insertTimeslot" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label for="timeslot">Timeslot</label>
                                <input type="text" id="timeslot"  class="form-control"  name="timeslot" required >
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit"  name="up_tim" class="btn btn-raised btn-raised btn-primary">
                                <i class="fa fa-check-square-o"></i> Save Timeslot
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
