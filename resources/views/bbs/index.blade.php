@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <tr>
        <th>제목</th>
        <th>작성자</th>
        <th>조회수</th>
    </tr>
    @foreach($msgs as $msg)
        <tr>
            <td>
            <a href="{{route('boards.show',['board'=>$msg->id ,'page'=>$page])}}">{{$msg->title}}</a>
            </td>
            <td>{{$msg->user->email}}</td>
            <td>{{$msg->hits}}</td>           
        </tr>
    @endforeach    
</table>

{{$msgs->links()}}
{{-- {{$msgs->appends(['title'=>$title,'content'=>$content])->links()}} --}}
<button class="btn btn-danger" type="button" onclick="location.href='{{route('boards.create')}}'">글작성</button>
<button class="btn btn-danger" type="button" onclick="location.href='{{url('myArticles')}}'">내글보기</button>
@endsection