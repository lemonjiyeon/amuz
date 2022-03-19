<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Task 상속
use App\Models\Task;

class TaskController extends Controller
{
    // 메인페이지 메소드
    public function list(Request $request){


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

        // 요청된 정보 처리 후 결과 되돌려줌
        return view('pages.index',[
            'totalCount'=>$totalCount,
            'boards'=>$boards,
            'pageNum'=>$pageNum,
            'startPage'=>$startPage,
            'endPage'=>$endPage,
            'totalPage'=>$totalPage,
        ]);
    }

    // 생성페이지 메소드
    public function create(){
        return view('pages.create');
    }

    // 저장 메소드
    public function store(request $request){
        // 유효성 검사
        $this->validate($request, [
             'writer'=> 'required',
             'title'=> 'required',
             'memo'=> 'required',
        ]);

        // DB에 저장
        $boardList = Task::create([
            'user_id' => $request->input('writer'),
            'writer'=> $request->input('writer'),
            'title' => $request->input('title'),
            'memo' => $request->input('memo'),
        ]);

        $boardList->save();

        return redirect()->route('list');
    }

    // 글 상세보기 메소드
    public function show(Task $board){
        return view('pages.show', compact('board'));
    }

    // 글 수정 메소드
    public function update(request $request, Task $board){
        $board->update(request(['user_id','title','writer','memo']));
        return redirect()->route('list');
    }

    // 글 삭제 메소드
    public function delete(Task $board){
        $board->delete();
        return redirect()->route('list');
    }
}
