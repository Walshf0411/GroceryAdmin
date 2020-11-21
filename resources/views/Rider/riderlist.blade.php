@extends('template')
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
                                    <th>Sr No.</th>
                                    <th>Delivery Boy Name</th>
                                    <th>Delivery Boy Mobile</th>
                                    <th>Delivery Boy Email</th>
                                    <th>Delivery Boy Area</th>
                                    <th>Delivery Boy Address</th>
                                    <th>Delivery Boy Status</th>
                                    <th>Delivery Boy App Status(On/Off)</th>
                                    <th>Delivery Boy Total Reject</th>
                                    <th>Delivery Boy Total Accept</th>
                                    <th>Delivery Boy Total Complete</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>

                                    <td>Rajesh</td>
                                    <td>9999999999</td>
                                    <td>asd.asd@sda.com</td>
                                    <td>Powder Galli, Gokuldham Society, Goregoan East</td>
                                    <td>Active/Deactive</td>
                                    <td>On/off</td>
                                    <td>5</td>
                                    <td>10</td>
                                    <td>100</td>
                                    <td> Button to make active or deactive

                                        <a href="?status=1&rid=id">	<button class="btn btn-success"   data-original-title="" title="">
                                            Make Active
                                            </button></a>

                                    <a	href="?status=0&rid=id">	<button class="btn btn-danger"  href="?status=0&rid=id" data-original-title="" title="">
                                                Make Deactive
                                            </button>
                                            </a>

                                            </td>
                                            <td></td>
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
