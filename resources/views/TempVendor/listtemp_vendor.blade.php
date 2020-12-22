@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Temporary Vendor List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Id No.</th>
                                    <th>Name</th>
                                    <th>Vendor Shop Name</th>
                                    <th>Mobile Number</th>

									{{-- <th>Total Subcategory</th> --}}
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tempvendors as $row)
                                <tr>

                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->shop_name }}</td>
                                    <td>{{ $row->mobile_number }}</td>
                                    {{-- <td>
                                    @foreach( explode("|", $row->images) as $img)
                                        <img class="media-object round-media" src="storage\images\TempProduct\{{ $row->id }}\{{ $img }}" alt="Generic placeholder image" style="height: 75px;">
                                    @endforeach
                                    </td>
                                    <td>{{ $row->shop_name }}</td>--}}
                                    <td>
									<a class="primary"  href="add_temp_Vendor/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="delete_temp_Vendor/{{ $row->id }}" data-original-title="" title="">
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
