@extends('template')
@section('title', 'List Deliverycost')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Delivery Cost</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 {{-- <th>Sr No.</th> --}}
                                 <th>Charge Name</th>
                                 <th>Amount</th>
                                 <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                    {{-- <td>{{ $row->id }}</td> --}}
                                    {{-- dd{{ $delivery_cost }} --}}
                                    <td>Delivery Charge</td>
                                    <td>{{ $delivery->cost->delivery_charges}}</td>
									<td>
                                        <a class="primary"  href="edit_deliverycost" data-original-title="" title="">
                                                <i class="ft-edit font-medium-3"></i>
                                        </a>
                                        {{-- <a class="danger" href="deletedeliveryCost" data-original-title="" title="">
                                                <i class="ft-trash font-medium-3"></i>
                                        </a> --}}
									</td>

                                </tr>
                                <tr>

                                    {{-- <td>{{ $row->id }}</td> --}}
                                    {{-- dd{{ $delivery_cost }} --}}
                                    <td>Delivery Charge Limit Value</td>
                                    <td>{{ $delivery->limit->content}}</td>
									<td>
                                        <a class="primary"  href="edit_deliverylimit" data-original-title="" title="">
                                                <i class="ft-edit font-medium-3"></i>
                                        </a>
                                        {{-- <a class="danger" href="deletedeliveryCost" data-original-title="" title="">
                                                <i class="ft-trash font-medium-3"></i>
                                        </a> --}}
									</td>

                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
