@extends('layouts.tasks_layout')


@section('title')
글 작성
@endsection

@section('content')
<div class="container">
    <h1>글 작성</h1>

    <form action="/" method="POST">
    @csrf
    <div class="mt-3 row g-3 align-items-center">
      <div class="col-2">
        <label for="writer" class="col-form-label" >작성자</label>
      </div>
      <div class="col-6">
        <input type="text" id="writer" name="writer" class="form-control" placeholder="이름 입력">
      </div>
    </div>

    <div class="mt-2 row g-3 align-items-center">
      <div class="col-2">
        <label for="writer" class="col-form-label" >제목</label>
      </div>
      <div class="col-6">
        <input type="text" id="title" name="title" class="form-control" placeholder="제목 입력">
      </div>
    </div>


    <div class="mt-4">
    <label for="memo" class="form-label">글 작성</label>
    <textarea type="memo" class="form-control" id="memo" name="memo" placeholder="글 작성" rows="20"></textarea>
    </div>
    <button id="submit" class="mt-2 btn btn-primary">등록하기</button>
    </form>
    @endsection


    @section('script')
    <script>
        $('#submit').on('click', function(){
            let cf = confirm('등록하시겠습니까?');

            if(cf == true){
                $('#submit').submit();
                alert('등록이 완료되었습니다.');
            }else{
                return false;
            }
        });
    </script>
</div>
@stop


