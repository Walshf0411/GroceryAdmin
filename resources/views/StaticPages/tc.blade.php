@extends('template')
@section('title', 'Add Terms & Conditions')
@section('content')
{{-- <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script> --}}
<script src="{{ asset('app-assets/ckeditor/ckeditor.js') }}"></script>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Terms & Conditions</h4>
        </div>
        <div class="card-body collapse show">
            <div class="card-block card-dashboard">
                <form method="POST" action="addTc">
                    @csrf
                    <textarea name="tc" id="tc">{{ $content }}</textarea>
                    <br>
                    <input type="submit" name="submit">
                </form>
                <script>
                CKEDITOR.replace( 'tc' );
                </script>
            </div>
        </div>
    </div>

</div>

@endsection
