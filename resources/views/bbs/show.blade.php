@extends('layouts.app')
@section('content')

<table class="table table-striped">
    <tr>
        <td>제목</td>
        <td>{{$board->title}}</td>
    </tr>
    <tr>
        <td>작성자</td>
        <td>{{$board->user->name}}</td>
    </tr>
    <tr>
        <td>내용</td>
        <td>{{$board->content}}</td>
    </tr>
    <tr>
        <td>조회수</td>
        <td>{{$board->hits}}</td>
    </tr>
    <tr>
        <td>작성일</td>
        <td>{{date('m-d',strtotime($board->created_at))}}</td>

    </tr>
</table>
<hr>
<h3>댓글 리스트</h3>
<table class="table">
    <tr>
        <th>작성자</th>
        <th>내용</th>
    </tr>

    @foreach($board->comments as $c)
    <tr>
        <td>{{$c->user->name}}</td>
        <td>{{$c->content}}</td>
    </tr>
    @endforeach
</table>
<div class="row" >
<button class="btn btn-outline-info" onclick="location.href='{{route('boards.index',['page'=>$page])}}'">목록보기</button>
    <button class="btn btn-outline-success" onclick="location.href='{{route('boards.edit',['board'=>$board->id,'page'=>$page])}}'">수정</button>
    <button class="btn btn-outline-danger">삭제</button>
</div>
@endsection

