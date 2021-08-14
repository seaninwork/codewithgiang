@extends('master.layout')


@section('content')


<!-- FORM -->
<form action="{{ url('/crud/update/$getData[0]->id') }}" method="POST">
@csrf

<input type="hidden" value="{{ $getData[0]->id }}" name="idExample">

<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" 
    class="form-control" 
    id="titleExample" 
    placeholder="title..." 
    name="title" 
    value="{{ $getData[0]->title }}"
  >
</div>
<div class="mb-3">
  <label class="form-label">Content</label>
  <textarea class="form-control" id="textExample" rows="3" placeholder="writing something homie" name="content">
{{ $getData[0]->content }}
  </textarea>
</div>
  <button type="submit" class="btn btn-primary" id="btnExample">Submit</button>
</form>
<!-- FORM -->


@endsection

