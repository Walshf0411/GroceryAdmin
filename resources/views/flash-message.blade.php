<style>
    #hideMe {
    -moz-animation: cssAnimation 5s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 5s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 5s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 5s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
/* @keyframes cssAnimation {
    to {
        overflow:hidden;
    }
}
@-webkit-keyframes cssAnimation {
    to {
        visibility:hidden;
    }
} */
@keyframes cssAnimation {
    0%   {opacity: 0;display: none;position: absolute;}
    90%  {opacity: 0;}
    100% {opacity: 0;}
}
@-webkit-keyframes cssAnimation {
    0%   {opacity: 0;display: none;position: absolute;}
    90%  {opacity: 0;}
    100% {opacity: 0;}
}

</style>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block" id="hideMe">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>


@elseif ($message = Session::get('error'))
<div class="alert alert-danger alert-block" id="hideMe">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>



@elseif ($message = Session::get('warning'))
<div class="alert alert-warning alert-block" id="hideMe">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>



@elseif ($message = Session::get('info'))
<div class="alert alert-info alert-block" id="hideMe">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>



@elseif($errors->any())
<div class="alert alert-danger" id="hideMe">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Please check the form below for errors
</div>
@endif
