@extends('layouts.tasks_layout')

@section('title')
게시판
@stop

@section('content')
<div class="container"><h1>게시판</h1>

<ul class="nav justify-content-end">
   @if (Route::has('login'))
     @auth
     <li class="nav-item">
        <a class="nav-link"><?=$email?>님 </a>
      </li>
     <li class="nav-item">
        <a class="nav-link active" aria-current="page" href={{ route('logout')}}>로그아웃</a>
      </li>
   @else
    <li class="nav-item">
         <a class="nav-link active" aria-current="page" href={{ route('login')}}>로그인</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href={{ route('join')}}>회원가입</a>
    </li>
    @endauth
  @endif
</ul>
</div>

<div class="mb-2 container">
<small><?= $totalCount ?>개의 글이 있습니다.
<?= $pageNum ?>페이지 입니다.</small>
</div>
<div class="container">
    <div class="mb-5 container">
        <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th class="col-1">NO</th>
                <th class="col-2">NAME</th>
                <th class="col-5" style="text-align:center">TITLE</th>
                <th style="text-align:right">DATE</th>
            </tr>
        </thead>
            <!-- 게시글 번호-->
            <?php $i=1; ?>

            <!-- 글 목록 -->
            <tbody>
            @foreach($boards as $board)

                <tr onClick="location.href='/show/{{ $board->contentNum }}'">
                    <td>
                        <?= $i++ ?>
                    </td>
                    <td>
                        {{ $board->writer }}
                    </td>
                    <td style="text-align:center">
                        {{ $board->title }}
                    </td>
                    <td style="text-align:right">
                        {{ $board->created_at }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 글 쓰기 버튼 -->
    <form action="/create" method="GET">
        <button type="submit" class="mb-3 btn btn-success" style="margin-top:20px;">글쓰기</button>
        <input type="hidden" name="page" value="{{ $pageNum }}">
    </form>

    <!-- 페이지 -->
    <div class="container" style="text-align:center">
        <a href = "/pages?pageNum={{ $startPage }}"> << </a>
        <a href = "/pages?page={{ $pageNum-1 }}"> < </a>
        <?php if($pageNum ==1){?>
            <a href = "/pages?page=1"> 1 </a>
        <?php } ?>

        <?php for($i=$startPage; $i<$endPage; $i++){ ?>
        <a href = "/pages?page=<?= $i+1 ?>"><?= $i+1 ?></a>
        <?php } ?>

        <?php if($pageNum == $totalPage){
            echo "";
        }
        else{ ?>
        <a href = "/pages?page={{ $pageNum+1 }}"> > </a>
        <?php } ?>
        <a href = "/pages?page={{ $endPage }}"> >> </a><br>
    </div>
</div>
    @stop
