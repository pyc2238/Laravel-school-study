@extends('layouts.app')
@section('content')
<form action="{{route('boards.update',['board'=>$board->id,'page'=>$page])}}" method="post">
        @csrf
        @method('patch')
        <label>제목
        <input type="text" name="title" value="{{$board->title}}">
        <span>
            @if($errors->has('title'))
            {{$errors->first('title')}}
            @endif
        </span>
        </label>
        <label>내용
            <input type="text" name="content" value="{{$board->content}}">
                <span>
                    @if($errors->has('content'))
                    {{$errors->first('content')}}
                    @endif
                </span>
        </label>
        
        <input class="btn btn-outline-danger" type="submit" value="수정">
    </form>
@endsection