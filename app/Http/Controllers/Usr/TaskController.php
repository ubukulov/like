<?php

namespace App\Http\Controllers\Usr;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\TaskWork;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;

class TaskController extends Controller
{
    protected $id_user;

    public function __construct()
    {
        $this->id_user = Auth::id();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = DB::select("SELECT TW.*,TT.image,TR.rating,TT.title AS task_title FROM task_works TW 
        LEFT JOIN tasks TT ON TT.id=TW.id_task
        LEFT JOIN task_user_ratings TR ON TR.id_work=TW.id
        WHERE TW.id_user='$this->id_user'");
        return view('user/task/task-index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    # commits
    public function commits($id_work){
        $work = TaskWork::find($id_work);
        $commits = DB::select("SELECT TW.id,TW.id_work,TW.id_partner,TW.title,TW.link,TW.image,TW.text,TW.avtor,
                        DATE_FORMAT(TW.created_at,'%d.%m.%Y %H:%i:%s') AS 'created',PT.name AS 'partner_name',PT.image AS 'partner_image' FROM task_work_commits TW
                                LEFT JOIN partners PT ON PT.id=TW.id_partner
                                WHERE TW.id_work='$id_work'");
        DB::update("UPDATE task_work_commits SET new='1' WHERE id_work='$id_work' AND new='0'");
        return view('user/task/commit', compact('work', 'commits'));
    }

    # send commit
    public function send_commit(Request $request, $id_work){
        $text = $request->get('text');
        $link = $request->get('link');
        $image = $request->get('photo1');
        $result = DB::select("SELECT TK.id_partner FROM task_works TW
                                LEFT JOIN tasks TK ON TK.id=TW.id_task
                                WHERE TW.id='$id_work'");
        if($result){
            if(!empty($image)){
                $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$image;
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/commit/'.$image;
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/commit/small/'.$image;

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(227, 140);
                $img->save($to_mini);
                unlink($from);
            }
            $id_partner = $result[0]->id_partner;
            $result1 = DB::insert("INSERT INTO task_work_commits(id_work, id_partner, text, created_at, link, image,avtor)
                                  VALUES('$id_work', '$id_partner', '$text', CURRENT_TIMESTAMP(), '$link', '$image','1')");
            if($result1){
                return redirect()->back()->with('message', 'Успешно прокомментирован');
            }else{
                return redirect()->back()->with('message', 'Ошибка! Не удалось комментировать');
            }
        }else{
            return redirect()->back()->with('message', 'Ошибка! Не удалось комментировать');
        }
    }
}
