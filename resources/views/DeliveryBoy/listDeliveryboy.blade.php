@extends('template')
@section('title', 'List Delivery Boys')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Delivery Boy List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone No</th>
									<th>Email</th>
									<th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($delivery as $row)
                                <tr>

                                    <td><a href="viewDeliveryBoy/{{ $row->id }}">{{ $row->id }}</a></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{  $row->phoneno }}</td>
                                    <td>{{  $row->email }}</td>
                                    <td>{{  $row->address }}</td>
									<td>
									<a class="primary"  href="viewEditDeliveryBoy/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="deleteDeliveryBoy/{{ $row->id }}" data-original-title="" title="">
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
