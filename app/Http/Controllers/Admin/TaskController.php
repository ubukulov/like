<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;
use App\TaskType;
use App\Task;

class TaskController extends Controller
{

    # список задании
    public function index(){
        $tasks = DB::table('tasks')
            ->leftJoin('partners', 'partners.id', '=', 'tasks.id_partner')
            ->select('tasks.created_at', DB::raw('tasks.*,partners.name as partner_name,partners.image as partner_image,DATE_FORMAT(tasks.created_at, "%d.%m.%Y %H:%i:%s") as created'))
            ->orderBy('tasks.created_at', 'DESC')
            ->paginate(20);
        return view('admin/task/index', compact('tasks'));
    }

    # список работы
    public function works(){
        $works = DB::table('task_works')
            ->leftJoin('users', 'users.id', '=', 'task_works.id_user')
            ->select('task_works.created_at', DB::raw('task_works.*, users.lastname, users.firstname, users.avatar,DATE_FORMAT(task_works.created_at, "%d.%m.%Y %H:%i:%s") as created'))
            ->orderBy('task_works.created_at', 'DESC')
            ->paginate(20);
        return view('admin/task/works', compact('works'));
    }

    # типы задании
    public function types(){
        $types = DB::select("SELECT id,name_ru,image,DATE_FORMAT(created_at, '%d.%m.%Y %H:%i:%s') as created FROM task_types");
        return view('admin/task/types', compact('types'));
    }
    
    # форма добавление тип задании
    public function type_create(){
        return view('admin/task/create-type');
    }

    # сохранение тип задании
    public function type_store(Request $request){
        $data = $request->all();
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/types/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/types/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        $current_time = date("Y-m-d H:i:s");
        TaskType::create([
            'name_ru' => $data['name_ru'], 'image' => $data['photo1'], 'created_at' => $current_time, 'updated_at' => $current_time
        ]);
        return redirect()->back()->with('message', 'Успешно добавлен');
    }
    
    # форма редактирование типы задании
    public function type_edit($id){
        $id = (int) $id;
        $type = TaskType::find($id);
        return view('admin/task/edit-type', compact('type'));
    }

    # форма обновление
    public function type_update(Request $request, $id){
        $type = TaskType::findOrFail($id);
        $data = $request->all();
        if(!empty(isset($data['photo1']))){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/types/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/types/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
            $type->image = $data['photo1'];
        }
        $type->name_ru = $data['name_ru'];
        $type->save();
        return redirect('admin/task/types')->with('message', 'Успешно обновлен');
    }
    
    # удаление тип задании
    public function type_destroy($id){
        $type = TaskType::find($id);
        if(!empty($type->image)){
            $image = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/types/'.$type->image;
            $image_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/types/small/'.$type->image;
            unlink($image);
            unlink($image_mini);
        }
        TaskType::destroy($id);
        return redirect('admin/task/types')->with('message', 'Успешно удален');
    }

    # форма редактирование задании
    public function edit($id){
        $task_types = TaskType::all();
        $task = Task::find($id);
        return view('admin/task/task-create', compact('task_types', 'task'));
    }

    # удаление таск по ид
    public function destroy($id){
        $task = Task::find($id);
        if(!empty($task->image)){
            $image = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/'.$task->image;
            $image_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tasks/small/'.$task->image;
            unlink($image);
            unlink($image_mini);
        }
        Task::destroy($id);
        return redirect()->back()->with('message', 'Успешно удален');
    }
}
