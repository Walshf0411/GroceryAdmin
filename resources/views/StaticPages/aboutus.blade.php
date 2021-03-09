@extends('template')
@section('content')
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">About Us </h4>
        </div>
        <div class="card-body collapse show">
            <div class="card-block card-dashboard">
                <form method="POST" action="addAbout">
                    @csrf
                    <textarea name="aboutus" id="aboutus">{{ $content }}</textarea>
                    <br>
                    <input type="submit" name="submit">
                <form>

                <script>
                CKEDITOR.replace( 'aboutus' );
                </script>

            </div>
        </div>
    </div>
</div>
@endsection
