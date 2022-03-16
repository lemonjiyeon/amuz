<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // 글 번호
            $table->increments('id');
            // 사용자가 작성한 글
            $table->text('memo');
            // 사용자 이름
            $table->text('writer');
            // 게시물의 고유번호
            $table->integer('contentNum');
            // 같은 고유번호 내의 댓글 순서
            $table->integer('sort')->nullable();
            // 같은 그룹 내 댓글 계층
            $table->integer('depth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
