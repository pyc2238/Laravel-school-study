@extends('layouts.app')

@section('title')
새 글쓰기 폼
@endsection

@section('cssNscript')
  <link rel="stylesheet" href="/dist/dropzone.css">
  <script src="/dist/dropzone.js"></script>
@endsection
@section('content')
<div class="container">
    <h2>새 글쓰기 폼</h2>
    <p>아래의 모든 필드를 채워주세요.</p>
    <form id="store" action="{{route('boards.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">제목:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
            <div>
                @if($errors->has('title'))
                <span class="warning">
                    {{$errors->first('title')}}
                </span>
                @endif
            </div>
        </div>
        <!--div class="form-group">
      <label for="writer">작성자:</label>
      <input type="text" class="form-control" id="writer" name="writer"
      required>
    </div-->
        <div class="form-group">
            <label for="content">내용:</label>
            <textarea class="form-control" rows="5" id="content" name="content" required>{{old('content')}}</textarea>
            <div>
                @if($errors->has('content'))
                <span class="warning">
                    {{$errors->first('content')}}
                </span>
                @endif
            </div>
        </div>
    </form>
    <form class="dropzone" action="{{route('attachments.store')}}" method="post" id="dropzone">
        @csrf
        
      </form>
</div>

<div style="margin:10px 0 50px 0">
    <button type="button" class="btn btn-primary offset-md-1" onclick="$('#store').submit()">
        글등록
    </button>
    <a class="btn btn-danger offset-md-1" href="{{route('boards.index',['page'=>1])}}">목록보기</a>
</div>

<script type="text/javascript">
    Dropzone.options.dropzone = {
        addRemoveLinks: true,
        removedfile: function(file) {
                var name = file.upload.filename;
                var fileid = file.upload.id;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                    type: 'DELETE',
                    url: '/attachments/'+fileid,
                    data: {filename: name},
                    success: function (data){
                        //console.log("File has been successfully removed!!");
                        alert(data + 'has been successfully removed!!');
                    },
                    error: function(e) {
                        //console.log(e);
                        alert(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },    
        success: function(file, response) {
            alert(response.filename);
            file.upload.id = response.id;
            $("<input>", {type:'hidden', name:'attachments[]', value:response.id}).appendTo($('#store'));
        },
        error: function(file, response){
           return false;
        }
    }
  </script>
  
@endsection
