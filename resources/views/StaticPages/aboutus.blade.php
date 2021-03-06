@extends('template')
@section('content')
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<form method="POST" action="addAbout">
    @csrf
    <textarea name="aboutus" id="aboutus">{{ $content }}</textarea>
<form>
<script>
  CKEDITOR.replace( 'aboutus' );
</script>

@endsection
