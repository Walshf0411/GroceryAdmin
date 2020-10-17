@extends('template')
@section('content')


<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Apna Add SubCategory</h4>

				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">



<div class="form-group">
									<label for="cname">Select A Category</label>
									<select name="scat" class="form-control" required>
									<option value="">select a category</option>

										<option value="Value 1">Value 1</option>

									</select>
								</div>

								<div class="form-group">
									<label for="cname">SubCategory Name</label>
									<input type="text" id="cname" class="form-control"  name="cname" required >
								</div>



								<div class="form-group">
									<label>SubCategory Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8">
								</div>


							</div>

							<div class="form-actions">

								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>



							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Insert SubCategory Successfully!!!');

  });
  </script>

						</form>
					</div>
				</div>
			</div>
		</div>


@endsection
