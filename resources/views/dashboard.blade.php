@extends('template')
@section('content')

<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Dashboard</h4>

				</div>
				<div class="card-body" style="padding:10px;">
				   <div class="row" matchheight="card">
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger">{{ $category }}</h3>
                <span>Total Category</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-list danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger">{{ $vendors }}</h3>
                <span>Total Vendors</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-user warning font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success">{{ $products }}</h3>
                <span>Total Product</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-basket-loaded success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 warning">{{ $bvendors }}</h3>
                <span>Total Blocked Vendors</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-user danger font-large-2 float-right"></i>
                {{-- <i class="icon-pie-chart warning font-large-2 float-right"></i> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary">4</h3>
                <span>Total Timesloat</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-hourglass primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary">{{ $banner }}</h3>
                <span>Total Banner</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-screen-desktop primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success">{{ $customers }}</h3>
                <span>Total Customer</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-user success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger">1000</h3>
                <span>Pending Order</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
{{--
     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary">100000</h3>
                <span>Complete Order</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 warning">50</h3>
                <span>Cancelled Order</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-handbag warning font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 danger">5</h3>
                <span>Customer Rating</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-like danger font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary">20</h3>
                <span>Total Feedback</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-bubbles primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 success">500</h3>
                <span>Total Sales</span>
              </div>
              <div class="media-right align-self-center">
                <i class="icon-rocket success font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

	 <div class="col-xl-3 col-lg-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="px-3 py-3">
            <div class="media">
              <div class="media-body text-left">
                <h3 class="mb-1 primary">75</h3>
                <span>Total Deliv. Boy</span>
              </div>
              <div class="media-right align-self-center">
                <i class="fa fa-motorcycle primary font-large-2 float-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}

@endsection
