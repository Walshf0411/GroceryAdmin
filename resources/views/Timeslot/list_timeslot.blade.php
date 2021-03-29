@extends('template')
@section('title', 'List Timeslots')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Timeslot List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                 <th>Timeslots</th>
                                 <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeslots as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->timeslot }}</td>
									<td>
                                        <a class="primary"  href="edit_timeslot/{{ $row->id }}" data-original-title="" title="">
                                                <i class="ft-edit font-medium-3"></i>
                                        </a>
                                        <a class="danger" href="deleteTimeslot/{{ $row->id }}" data-original-title="" title="">
                                                <i class="ft-trash font-medium-3"></i>
                                        </a>
									</td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
