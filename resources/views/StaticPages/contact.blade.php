@extends('template')
@section('title', 'Add Contact')
@section('content')
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Contact </h4>
        </div>
        <div class="card-body collapse show">
            <div class="card-block card-dashboard">
                <form method="POST" action="addContact">
                    @csrf
                    <textarea name="contact" id="contact">{{ $content }}</textarea>
                    <br>
                    <input type="submit" name="submit">
                <form>

                <script>
                CKEDITOR.replace( 'contact' );
                </script>

            </div>
        </div>
    </div>
</div>
@endsection
