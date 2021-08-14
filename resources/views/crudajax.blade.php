@extends('master.layout')

@section('content')


<div class="container">
<div class="container">
  <div class="row">
    <div class="col noteList" id="resultAjax">
      
<!--  -->
@foreach($list as $item)

<div class="line {{ $item->status }}">
  <b class="line-title">{{ $item->title }}</b>
  <p class="line-content">{{ $item->content }}</p>
  <span data-id="{{ $item->id }}" class="editThis btn btn-light btn-sm">Sửa</span>
  <span data-id="{{ $item->id }}" class="deleteThis btn btn-light btn-sm">Xóa</span>
  <span data-id="{{ $item->id }}" class="finishThis btn btn-light btn-sm">Xong</span>
</div>

@endforeach

    </div>

    <div class="col">
    



<!-- FORM -->

<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" class="form-control" id="title" placeholder="title..." name="title" autocomplete="off">
</div>
<div class="mb-3">
  <label class="form-label">Content</label>
  <textarea class="form-control" id="content"  placeholder="writing something homie" name="content"></textarea>
</div>


<input type="file" id="image-upload" name="image_upload[]" enctype="multipart/form-data" multiple>
                        
<textarea name="keywords" class="demo wordlist">@you</textarea>
  <button class="btn btn-primary" id="btnExample">Submit</button>

<!-- FORM -->


    </div>
  </div>
</div>
</div>


<div class="modal" tabindex="-1" id="editNoteContentModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sửa note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div contenteditable="true" id="modalEditTitle">...</div>
        <div contenteditable="true" id="modalEditContent">...</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modalEditBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<style>
  #modalEditTitle{
    font-size: 2em;
    outline:0;
  }
  #modalEditContent{
    outline:0;
  }
  .finish b, .finish p{
    text-decoration: line-through;
    color: #ccc;
  }
  .noteList{
    height:100vh;
    overflow:auto;
  }
</style>

<script>
  $(document).ready(function() {
    $('.demo').wordlist();

  });
</script>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#btnExample').on('click', function() {
        var title = $("#title").val();
        var content = $("#content").val();
        var tags =[];

        $('.wordTag').each(function(index, obj){ tags.push($(this).text()); });
        $.post( "ajax/store",{title: title, content: content, tags: tags}, function( data ) {
          $("#title").val("");
          $("#content").val("");
          $("#resultAjax").append("<b>" + data.title + "</b>" + "<p>" + data.content + "</p>");
        });
    });
    $('.deleteThis').on('click', function() {
        var id = $(this).attr("data-id");
        var _this = $(this);
        $.post( "ajax/delete",{id: id}, function( data ) {
          _this.parents('.line').remove();
        });      
    });
    $('.editThis').on('click', function(e) {
        var _this = $(this);
        var id = _this.attr("data-id");
        var title = _this.siblings(".line-title").text();
        var content = _this.siblings(".line-content").text();

        $("#editNoteContentModal").modal('show');
        $("#modalEditTitle").text(title);
        $("#modalEditContent").text(content);

        $("#modalEditBtn").on('click', function(){
          var title = $("#modalEditTitle").text();
          var content = $("#modalEditContent").text();
          $.post( "ajax/edit",{id:id, title:title, content:content}, function( data ) {
            $("#editNoteContentModal").modal('hide');
            _this.siblings(".line-title").text(title);
            _this.siblings(".line-content").text(content);
          }); 
        });
    });
    $('.finishThis').on('click', function() {
        var id = $(this).attr("data-id");
        var _this = $(this);
        $.post( "ajax/finish",{id: id}, function( data ) {
          _this.parents('.line').addClass("finish");
        });      
    });
});
</script>




@endsection


<style>
  .line{
    margin-bottom:1em;
    border-bottom: 1px solid #eee;
    padding-bottom:1em;
  }
  .line p{
    margin-bottom:0;
  }
</style>