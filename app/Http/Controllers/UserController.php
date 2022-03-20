<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Task;



class UserController extends Controller
{
    // 회원가입 폼 메소드
    public function join(){
        return view('pages.join');
    }

    // 회원가입 등록 메소드
    public function register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        if(sizeof(User::where('email',$email)->get())<1) {
            User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password) ]);
            return redirect()->route('login');
        }else{
          return view('join',['error'=>'이미 등록된 email입니다']);
        }
    }

    // 로그인 폼 메소드
    public function loginForm(){
        return view('pages.login');
    }

    // 로그인 메소드
    public function login(Request $request){
        $email = $request -> email;
        $password = $request -> password;
        // 입력한 로그인 정보
        $credentials = ['email'=>$email,'password'=>$password];

        // view에서 넘어온 현재페이지의 파라미터 값
        $pageNum =$request->input('page');

        // 페이지 번호가 없으면 1, 있으면 그대로 사용
        $pageNum =(isset($pageNum)?$pageNum:1);

        // 페이지 내 첫 게시글 번호
        $startNum =($pageNum-1)*10;

        // 한 페이지당 표시될 페이지 갯수
        $writeList =10;

        // 전체 페이지 중 표시도리 페이지 갯수
        $pageNumList =10;

        // 페이지 그룹 번호
        $pageGroup =ceil($pageNum/$pageNumList); // ceil = 올림함수

        // 페이지 그룹 내 첫 페이지 번호
        $startPage = (($pageGroup-1)*$pageNumList)+1;

        // 페이지 그룹 내 마지막 페이지 번호
        $endPage =$startPage+$pageNumList-1;

        // 전체 게시글 갯수
        $totalCount =Task::count();

        // 전체 페이지 갯수
        $totalPage =ceil($totalCount/$writeList);

        // 페이지 그룹이 마지막일 때 마지막 페이지 번호
        if($endPage >= $totalPage){
            $endPage =$totalPage;
        }


        // 테이블에서 가져온 DB 뷰에서 사용 할 수 있는 변수에 저장
        $boards =Task::orderby('contentNum','ASC')
        ->skip($startNum)->take($writeList)->get();


        // 해당하는 정보 일치 여부 확인
        if(! auth()->attempt($credentials)){
            return "로그인정보가 정확하지 않습니다.";
        }
        return view('pages.index',[
        'login'=>auth()->user(),
        'totalCount'=>$totalCount,
        'boards'=>$boards,
        'pageNum'=>$pageNum,
        'startPage'=>$startPage,
        'endPage'=>$endPage,
        'totalPage'=>$totalPage,
         'email'=>$email
        ]);
    }

    // 로그아웃 메소드
    public function logout(){
        auth()->logout();
        return redirect()->route('list');
    }

}
?>
