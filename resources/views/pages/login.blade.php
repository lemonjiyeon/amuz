@extends('Layouts.tasks_layout')

@section('title')
로그인
@stop

@section('content')
<div class="container">

    <form action ='/login' method="post">
    @csrf
        <div class="mt-5 container" style="background-color:RGB(236,236,236); border-radius:1%; width:60%">
        <h1 class="mb-3">로그인</h1>
            <td> email
                <input type="text" class="form-control" name = 'email'/>
            </td><br>
            <td>
            password
                <input type="password" class="form-control" name = 'password'/> </td><br>
            <br>

    <button type="submit" class="mb-3 btn btn-primary">로그인</button>
    <button type="submit" class="mb-3 btn btn-primary" onclick="http://localhost:8000/join">회원가입</button>
    </div>
    </form>
</div>
@stop
