@extends('template')
@section('content')
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<form method="POST" action="addShare">
    @csrf
    <textarea name="share" id="share">{{ $content }}</textarea>
</form>
<script>
  CKEDITOR.replace( 'share' );
</script>

@endsection
