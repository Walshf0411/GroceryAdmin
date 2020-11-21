@extends('template')
@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Banner List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>

                                    <th>Banner Image</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $i = 0 }} --}}

                                @foreach($banners as $row)
                                {{-- {{ $i++ }} --}}
                                <tr>
                                    <td>{{ $row->id }}</td>

                                    <td><img src="storage\images\Banner\{{ $row->banner_image }}" width="100" height="100"/></td>
                                    <td>

										<a class="primary"  href="edit_banner/{{ $row->id }}" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
									<a class="danger" data-original-title=""  href="deleteBanner/{{ $row->id }}" title="">
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
