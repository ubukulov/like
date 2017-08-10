<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TaskType;
use App\Task;
use App\Partner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\TaskWork;
use Cookie;
use App\SimpleImage;

class TaskController extends Controller
{
    protected $types; // виды задании
    protected $id_user;

    public function __construct()
    {
        $this->types = TaskType::all();
        $this->id_user = Auth::id();
    }

    public function index(){
        $types = $this->types;
        $tasks = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
        (SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift FROM tasks TT ORDER BY TT.created_at DESC");
        return view('task/index', compact('types', 'tasks'));
    }

    public function show($id){
        if(!Auth::check()){
            // не авторизован
            Cookie::queue('cert', $_SERVER['REQUEST_URI'], 0);
        }
        $task = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
        (SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift FROM tasks TT WHERE TT.id='$id' ORDER BY TT.created_at DESC");
        $partner = Partner::find($task[0]->id_partner);
        return view('task/show', compact('task', 'partner'));
    }

    public function store(Request $request){
        $id_task = $request->get('id_task');
        $title = $request->get('title');
        $text = $request->get('text');
        $link_to_work = $request->get('link_to_work');
        $image = $request->get('image');
        if(!empty($image)){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$image;
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/works/'.$image;

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            unlink($from);
        }
        $current_time = date("Y-m-d H:i:s");
        $result = TaskWork::where(['id_user' => $this->id_user, 'id_task' => $id_task])->get();
        if(count($result) > 0){
            return 1;
        }else{
            if($this->id_user){
                $result1 = DB::insert("INSERT INTO task_works(id_user,id_task,title,text,link_to_work,created_at,image) VALUES('$this->id_user','$id_task','$title','$text','$link_to_work', '$current_time', '$image')");
                if($result1){
                    return 0;
                }else{
                    return 2;
                }
            }else{
                return 2;
            }
        }
    }

    # Топ испольнителей
    public function top_users(){
        $top_users = DB::select("SELECT US.id,US.lastname,US.firstname,US.avatar, ROUND((SELECT SUM(TUR.rating)/COUNT(*) FROM task_user_ratings TUR WHERE TUR.id_user=US.id),2) AS rating,
                                    (SELECT COUNT(*) FROM task_works TK WHERE TK.id_user=US.id AND TK.status='1') AS count_done_task
                                    FROM task_works TW
                                    INNER JOIN users US ON US.id=TW.id_user
                                    GROUP BY US.id ORDER BY rating DESC, count_done_task DESC");
        return view('task/top_users', compact('top_users'));
    }

    # По типам
    public function types(){
        $types = DB::select("SELECT * FROM (SELECT TT.id, TT.name_ru,TT.image, (SELECT COUNT(*) FROM tasks TS WHERE TS.id_type=TT.id) AS count_task,
(SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
(SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift 
FROM task_types TT) OO ORDER BY OO.is_amount DESC,OO.count_task DESC");
        return view('task/types', compact('types'));
    }

    # По партнерам
    public function partners(){
        $partners = DB::select("SELECT PT.id,PT.name,PT.image, (SELECT COUNT(*) FROM tasks TK WHERE TK.id_partner=PT.id) AS count_task,
(SELECT COUNT(*) FROM task_works TW WHERE TW.status='1' AND TW.id_task IN(SELECT TG.id FROM tasks TG WHERE TG.id_partner=PT.id)) AS count_work FROM partners PT
INNER JOIN tasks TT ON TT.id_partner=PT.id
GROUP BY PT.id ORDER BY count_task DESC, count_work DESC");
        return view('task/partners', compact('partners'));
    }

    # Список задании по определенного типа
    public function types_tasks($id){
        $id = (int) $id;
        $tasks = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
        (SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift FROM tasks TT
        WHERE TT.id_type='$id' ORDER BY TT.created_at DESC");
        return view('task/types_tasks', compact('tasks'));
    }

    # Список задании по определенного партнера
    public function partners_tasks($id){
        $id = (int) $id;
        $tasks = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
        (SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift FROM tasks TT
        WHERE TT.id_partner='$id' ORDER BY TT.created_at DESC");
        return view('task/partners_tasks', compact('tasks'));
    }

    # По высокому оплату
    public function high_payment(){
        $tasks = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount FROM tasks TT
        ORDER BY is_amount DESC");
        return view('task/high_payment', compact('tasks'));
    }
}
