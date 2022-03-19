@extends('Layouts.tasks_layout')

@section('title')
회원가입
@stop

@section('content')
<div class="container">

    <form action ='/join' method="post">
    @csrf
        <div class="mt-5 container" style="background-color:RGB(236,236,236); border-radius:1%; width:60%">
        <h1 class="mb-3">회원 가입</h1>
            <td> name
                <input type="text" class="form-control" name = 'name'/>
            </td><br>
            <td> email
                <input type="text" class="form-control" name = 'email'/>
            </td><br>
            <td>
            password
                <input type="password" class="form-control" name = 'password'/> </td><br>
            <br>

    <button type="submit" class="mb-3 btn btn-primary">회원가입</button>
    </div>
    </form>
</div>
@stop
