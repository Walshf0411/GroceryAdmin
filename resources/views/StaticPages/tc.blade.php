@extends('template')
@section('content')
{{-- <script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script> --}}
<script src="{{ asset('app-assets/ckeditor/ckeditor.js') }}"></script>
<form method="POST" action="addTc">
    @csrf
    <textarea name="tc" id="tc">{{ $content }}</textarea>
    <br>
    <input type="submit" name="submit">
</form>
<script>
  CKEDITOR.replace( 'tc' );
</script>

@endsection
