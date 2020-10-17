@extends('template')

@section('content')
<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Apna  List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">

                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
								 <th>Category Name</th>
                                    <th>SubCategory Name</th>
                                    <th>SubCategory Image</th>
									<th>Total Product</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td></td>
									<td></td>
                                    <td></td>
                                    <td><img class="media-object round-media" src="no" alt="Generic placeholder image" style="height: 75px;"></td>
                                    <td></td>
									<td>
									<a class="primary"  href="subcategory.php?edit=somenumber" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>

									<a class="danger" href="?dele=id" data-original-title="" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>

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
