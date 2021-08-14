@extends('master.layout')

@section('content')


<div class="container">
<div class="container">
  <div class="row">
    <div class="col">
      
<!--  -->
@foreach($list as $item)

<b>
    {{ $item->title }}
    <a href="crud/edit/{{ $item->id }}">[sua]</a>
    <a href="crud/delete/{{ $item->id }}">[xoa]</a>
</b>
<p>{{ $item->content }}</p>

@endforeach

    </div>
    <div class="col">
    



<!-- FORM -->
<form action="crud/store" method="POST">
@csrf
<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" class="form-control" id="titleExample" placeholder="title..." name="title">
</div>
<div class="mb-3">
  <label class="form-label">Content</label>
  <textarea class="form-control" id="textExample" rows="3" placeholder="writing something homie" name="content"></textarea>
</div>
  <button type="submit" class="btn btn-primary" id="btnExample">Submit</button>
</form>
<!-- FORM -->




    </div>
    <div class="col">
      Column
    </div>
  </div>
</div>
</div>




@endsection