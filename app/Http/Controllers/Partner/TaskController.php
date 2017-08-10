<?php

namespace App\Http\Controllers\Partner;

use App\Partner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use App\SimpleImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\TaskType;
use App\TaskWork;
use App\User;

class TaskController extends Controller
{
    protected $id_partner;
    
    public function __construct()
    {
        $this->id_partner = Auth::guard('partner')->user()->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tasks = DB::table('tasks')->where(['id_partner' => $this->id_partner])->paginate(10);
        $tasks = DB::select("SELECT TT.*, (SELECT MAX(TD.amount) FROM task_details TD WHERE TD.id_task=TT.id AND TD.amount IS NOT NULL LIMIT 1) AS is_amount,
        (SELECT TD.gift_name FROM task_details TD WHERE TD.id_task=TT.id AND TD.gift_name IS NOT NULL LIMIT 1) AS is_gift FROM tasks TT ORDER BY TT.created_at DESC");
        return view('partner/task/task-index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task_types = TaskType::all();
        return view('partner/task/task-create', compact('task_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_partner'] = $this->id_partner;
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
            $data['image'] = $data['photo1'];
            unset($data['photo1']);
        }
        if(isset($data['task_variant1'])){
            // деньги
            $count = $data['money'];
            if ($count < 1) {
                $count = 1;
            }
            $title = $data['title'];
            $text = $data['text'];
            $id_type = $data['id_type'];
            $related_works = $data['related_works'];
            $image = $data['image'];
            $id_partner = $this->id_partner;
            $current_time = date("Y-m-d H:i:s");
            DB::transaction(function() use ($title,$text,$id_type,$related_works,$image,$id_partner,$current_time,$count,$data){
                $lastInsertId = DB::table('tasks')->insertGetId([
                    'title' => $title, 'text' => $text, 'id_partner' => $id_partner, 'image' => $image, 'created_at' => $current_time,
                    'related_works' => $related_works, 'id_type' => $id_type
                ]);

                for ($i = 1; $i <= $count; $i++) {
                    $amount = $data['amount'.$i];
                    $count_type = $data['count' . $i];
                    DB::insert("INSERT INTO task_details (id_task,amount,count,created_at) VALUES('$lastInsertId','$amount','$count_type','$current_time')");
                }
            });
        }
        if(isset($data['task_variant2'])){
            // подарками
            $count = $data['gift'];
            if ($count < 1) {
                $count = 1;
            }
            $title = $data['title'];
            $text = $data['text'];
            $id_type = $data['id_type'];
            $related_works = $data['related_works'];
            $image = $data['image'];
            $id_partner = $this->id_partner;
            $current_time = date("Y-m-d H:i:s");
            DB::transaction(function() use ($title,$text,$id_type,$related_works,$image,$id_partner,$current_time,$count,$data){
                $lastInsertId = DB::table('tasks')->insertGetId([
                    'title' => $title, 'text' => $text, 'id_partner' => $id_partner, 'image' => $image, 'created_at' => $current_time,
                    'related_works' => $related_works, 'id_type' => $id_type
                ]);

                for ($i = 1; $i <= $count; $i++) {
                    $gift_name = $data['gift_name'.$i];
                    $gift_count = $data['gift_count' . $i];
                    DB::insert("INSERT INTO task_details (id_task,gift_name,gift_count,created_at) VALUES('$lastInsertId','$gift_name','$gift_count','$current_time')");
                }
            });
        }
        return redirect('partner/task')->with('message', 'Успешно добавлен');
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
    
    # список работы
    public function works(){
        //$works = TaskWork::all();
        $works = DB::select("SELECT id,id_user,id_task,title,text,link_to_work,image,status,DATE_FORMAT(created_at,'%d.%m.%Y %H:%i:%s') AS created_at FROM task_works");
        return view('partner/task/works', compact('works'));
    }

    public function approve($id_task){
        $id = (int) $id_task;
        $result = DB::select("SELECT * FROM task_details WHERE id_task='$id' AND count <> 0 OR gift_count <> 0");
        return json_encode($result);
    }

    # рейтинг испольнителей
    public function rating($rid, $id_work){
        $id_work = (int) $id_work;
        $task_work = TaskWork::find($id_work);
        $id_user = $task_work->id_user;
        $id_task = $task_work->id_task;
        $id_partner = $this->id_partner;
        $result = DB::select("SELECT * FROM task_user_ratings WHERE id_user='$id_user' AND id_task='$id_task' AND id_work='$id_work' AND id_partner='$id_partner'");
        if(count($result) > 0){
            return 100; // уже оценили испольнителя
        }else{
            $current_time = date("Y-m-d H:i:s");
            $result1 = DB::insert("INSERT INTO task_user_ratings(id_user,id_task,id_work,id_partner,rating,created_at) VALUES('$id_user','$id_task','$id_work','$id_partner','$rid','$current_time')");
            if($result1){
                return 0; // успешно оценили
            }else{
                return 101; // каким-то причинам не удалось оценить
            }
        }
    }

    # вознаграждение денгами
    public function send_money($id_task_details, $id_task, $id_work){
        $id_work = (int) $id_work;
        $work = TaskWork::where(['id' => $id_work, 'status' => 0])->get();
        if(count($work) > 0){
            // еще испольнитель не вознагражден
            $id_partner = $this->id_partner;
            $id_task_details = (int) $id_task_details;
            $result = DB::select("SELECT * FROM task_details WHERE id='$id_task_details'");
            if(count($result) > 0){
                $money = $result[0]->amount;
                $count = $result[0]->count;
                $task_work = TaskWork::find($id_work);
                if(count($task_work) > 0){
                    $id_user = $task_work->id_user;
                    $partner = Partner::find($id_partner);
                    if(!empty($partner->fm)){
                        $partner_balance = __decode($partner->fm, env('KEY'));
                    }else{
                        $partner_balance = 0;
                    }

                    if($partner_balance > $money){
                        User::user_fm_plus($id_user,$money,"Зачислено от партнера ".$partner->name,1);
                        Partner::partner_fm_minus($id_partner,$money,"Отправлено ".$money." тг в счет испольнителя");
                        $count = $count - 1;
                        DB::update("UPDATE task_details SET count='$count' WHERE id='$id_task_details'");
                        $task_work->update([
                            'status' => '1'
                        ]);
                        return 0; // успешно зачислено
                    }else{
                        return 103; // у партнера не достаточно денег
                    }
                }else{
                    return 102; // Ошибка! Не удалось получить данные о работе
                }
            }else{
                return 100; // Ошибка. Не удалось найти данные
            }
        }else{
            // уже вознаграждали
            return 101;
        }
    }

    # вознаграждение подарками
    public function send_gift($id_detail, $id_work){
        $id_work = (int) $id_work;
        $id_detail = (int) $id_detail;
        $id_partner = $this->id_partner;
        $work = TaskWork::where(['id' => $id_work, 'status' => 0])->get();
        if(count($work) > 0){
            $id_user = $work[0]->id_user;
            $user = User::find($id_user);
            if(count($user) > 0){
                $mphone = $user->mphone;
                $detail = DB::select("SELECT * FROM task_details WHERE id='$id_detail'");
                if(count($detail) > 0){
                    $sms_code = strtoupper(generateCode(6));
                    $gift_name = "SC-code: ".$sms_code.". ".$this->set_transliterator($detail[0]->gift_name);
                    $gift_count = $detail[0]->gift_count;
                    sendSms($mphone, "Vash podarok: ".$gift_name);
                    Partner::partner_gift_history($id_partner,$id_user,$detail[0]->gift_name,$sms_code);
                    $gift_count--;
                    DB::update("UPDATE task_details SET gift_count='$gift_count' WHERE id='$id_detail'");
                    DB::update("UPDATE task_works SET status='1' WHERE id='$id_work'");
                    return 0;
                }else{
                    return 100;
                }
            }else{
                return 100; // Ошибка! Не удалось получить данные
            }
        }else{
            return 101; // уже вознаграждали
        }
    }

    public function get_transliterator($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
    public function set_transliterator($str) {
        // переводим в транслит
        $str = $this->get_transliterator($str);
        // в нижний регистр
        //$str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-zA-Z0-9_.]+~u', ' ', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return ucfirst($str);
    }

    public function task_work_close($id_work){
        $work = TaskWork::find($id_work);
        if(count($work) > 0){
            $work->status = 2;
            $work->save();
            return redirect()->back()->with('message', 'Работа испольнителя успешно отменен');
        }else{
            return redirect()->back()->with('message', 'Не удалось отменить работу испольнителя');
        }
    }

    public function task_work_commit(Request $request){
        $id_work = $request->get('id_work');
        $title = $request->get('title');
        $text = $request->get('text');
        $link = $request->get('link');
        $image = $request->get('image');
        $current_time = date("Y-m-d H:i:s");
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
        $result = DB::insert("INSERT INTO task_work_commits(id_work, id_partner, title, text, created_at, link, image)
        VALUES('$id_work', '$this->id_partner', '$title', '$text', '$current_time', '$link', '$image')");
        if($result){
            return 0; // успешно
        }else{
            return 100;
        }
    }

    # commits
    public function commits($id_work){
        $work = TaskWork::find($id_work);
        $commits = DB::select("SELECT TW.id,TW.id_work,TW.id_partner,TW.title,TW.link,TW.image,TW.text,TW.avtor, DATE_FORMAT(TW.created_at,'%d.%m.%Y %H:%i:%s') AS 'created',PT.name AS 'partner_name',
                                PT.image AS 'partner_image',WK.id_user,UR.lastname,UR.firstname,UR.avatar FROM task_work_commits TW
                                LEFT JOIN partners PT ON PT.id=TW.id_partner
                                LEFT JOIN task_works WK ON WK.id=TW.id_work
                                LEFT JOIN users UR ON UR.id=WK.id_user
                                WHERE TW.id_work='$id_work'");
        return view('partner/task/commit', compact('work', 'commits'));
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
                                  VALUES('$id_work', '$id_partner', '$text', CURRENT_TIMESTAMP(), '$link', '$image','0')");
            if($result1){
                return redirect()->back()->with('message', 'Успешно прокомментирован');
            }else{
                return redirect()->back()->with('message', 'Ошибка! Не удалось комментировать');
            }
        }else{
            return redirect()->back()->with('message', 'Ошибка! Не удалось комментировать');
        }
    }

    # список отправленные подарки
    public function gifts(){
        $gifts = DB::select("SELECT TG.id,TG.id_user,TG.name_ru,TG.sms_code, DATE_FORMAT(TG.created_at,'%d.%m.%Y %H:%i:%s') AS created,
        UR.lastname,UR.firstname,UR.avatar FROM task_gift_history TG
        INNER JOIN users UR ON UR.id=TG.id_user ORDER BY TG.created_at DESC");
        return view('partner/task/gifts', compact('gifts'));
    }
}
