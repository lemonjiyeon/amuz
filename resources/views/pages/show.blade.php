@extends('layouts.tasks_layout')


@section('title')
상세보기
@stop

@section('content')
<div class="container">
<h1>글 상세보기</h1>
</div>

<div class="container">
    <form action="/show/{{ $board->contentNum }}" method="POST">
    @csrf
    @method('PATCH')


    <!-- 작성자 -->
    <div class="mt-3 row g-3 align-items-center">
      <div class="col-1">
        <label for="writer" class="col-form-label" >작성자</label>
      </div>
      <div class="col-6">
        <input type="text" id="writer" name="writer" class="form-control" value={{ $board->writer }}>
      </div>
    </div>

    <!-- 제목 -->
    <div class="mt-2 row g-3 align-items-center">
      <div class="col-1">
        <label for="writer" class="col-form-label" >제목</label>
      </div>
      <div class="col-6">
        <input type="text" id="title" name="title" class="form-control" value={{ $board->title }}>
      </div>
    </div>


    <!-- 글 작성 -->
    <div class="mt-4">
    <label for="memo" class="form-label">글 작성</label>
    <textarea type="memo" class="form-control" id="memo" name="memo" rows="20">{{ $board->memo }}</textarea>
    </div>


    <button id="update" class="mt-2 btn btn-warning">수정하기</button>
    </form>

    <form action="/show/{{ $board->contentNum }}" method="POST">
    @csrf
    @method('DELETE')
    <button id="delete" class="mt-2 btn btn-danger">삭제하기</button>
    </form>
</div>
@stop

@section('script')
<script>
    $('#update').on('click', function(){
        let cf = confirm('수정하시겠습니까?');

        if(cf == true){
            $('#update').submit();
            alert('수정이 완료되었습니다.');
        }else{
            return false;
        }
    });

    $('#delete').on('click', function(){
        let cf = confirm('삭제하시겠습니까?');

        if(cf == true){
            $('#delete').submit();
            alert('삭제되었습니다.');
        }else{
            return false;
        }
    });
</script>
@stop


