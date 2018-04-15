<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OptMain;
use App\OptPartner;
use App\OptCat;
use App\SimpleImage;
use Illuminate\Support\Facades\DB;
use App\OptRange;

class OptpriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opt_main = OptMain::all();
        return view('admin/optprice/opt-index', compact('opt_main'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opt_cats = DB::select("SELECT id,title,position,parent_id FROM opt_cat");
        $opt_partners = DB::select("SELECT * FROM opt_price_partners");
        return view('admin/optprice/opt-create', compact('opt_cats', 'opt_partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/files/';
        $count = $request->get('count');
        $id_opt_price_cat = $request->get('id_opt_price_cat');
        if ($count < 1) {
            $count = 1;
        }
        $id_partner = $request->get('id_partner');
        for ($i = 1; $i <= $count; $i++) {
            $title = $request->get('title' . $i);
            $count_type = $request->get('count_type' . $i);
            $excel = "excel" . $i;
            //Получаем расширение файла
            $ext = substr($_FILES[$excel]['name'], strpos($_FILES[$excel]['name'], '.'), strlen($_FILES[$excel]['name']) - 1);
            //Генерируем название файла с расширением
            $file = substr_replace(sha1(microtime(true)), '', 12) . $ext;
            $file_types = array('.xls', '.xlsx', '.doc', '.docx', '.pdf');
            //проверяем расширение файла
            if (in_array($ext, $file_types)) {
                //перемещаем во временную папку
                if (move_uploaded_file($_FILES[$excel]['tmp_name'], $upload_dir . $file)) {
                    $current_time = strtotime("now");
                    DB::transaction(function () use ($title, $count_type, $id_partner, $file, $id_opt_price_cat, $current_time) {
                        $lastInsertId = DB::table('opt_price_main')->insertGetId([
                            'title' => $title, 'count_type' => $count_type, 'id_partner' => $id_partner, 'file' => $file, 'created_at' => $current_time
                        ]);

                        for ($j = 0; $j < count($id_opt_price_cat); $j++) {
                            DB::insert("INSERT INTO opt_price_main_cat (id_cat,id_opt_price_main) VALUES('$id_opt_price_cat[$j]','$lastInsertId')");
                        }
                    });
                } else {
                    return redirect()->back()->with('message', 'Не предвиденная ошибка');
                }
            } else {
                return redirect()->back()->with('message', 'Данный формат файлов не поддерживается');
            }
        }
        return redirect('/admin/opt_price')->with('message', 'Успешно добавлен');
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
        $opt_price = OptMain::find($id);
        $opt_cats = DB::select("SELECT id,title,position,parent_id FROM opt_cat");
        $opt_partners = DB::select("SELECT * FROM opt_price_partners");
        return view('admin/optprice/opt-edit', compact('opt_cats', 'opt_partners', 'opt_price'));
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
        $opt_main = OptMain::find($id);
        $file_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/files/'.$opt_main->file;
        $result = unlink($file_path);
        OptMain::destroy($id);
        DB::table('opt_price_main_cat')->where(['id_opt_price_main' => $id])->delete();
        return redirect()->back()->with('message', 'Успешно удален');
    }

    public function partner()
    {
        $partner = OptPartner::all();
        return view('admin/optprice/opt-partner', compact('partner'));
    }

    # Список прайс категории
    public function cat(){
        $cat = OptCat::all();
        return view('admin/optprice/opt-cat', compact('cat'));
    }

    # Форма добавление партнера
    public function partner_create(){
        return view('admin/optprice/opt-partner-create');
    }

    # сохранение информации о партнере
    public function partner_store(Request $request){
        $data = $request->all();
        if(!empty($data['logo'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['logo'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['logo'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['logo'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image1'] = $data['photo1'];
            unlink($from);
        }
        if(!empty($data['photo2'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo2'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo2'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo2'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image2'] = $data['photo2'];
            unlink($from);
        }
        if(!empty($data['photo3'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo3'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo3'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo3'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image3'] = $data['photo3'];
            unlink($from);
        }
        $data['date_start'] = strtotime($request->input('date_start'));
        $data['date_end']   = strtotime($request->input('date_end'));
        OptPartner::create($data);
        return redirect('admin/opt_partner')->with('message', 'Успешно добавлен');
    }

    # посмотреть информацию о партнера
    public function partner_edit($id){
        $partner = OptPartner::find($id);
        return view('admin/optprice/opt-partner-edit', compact('partner'));
    }

    # По ид партнера обновить информацию
    public function partner_update(Request $request,$id){
        $data = $request->all();
        if(!empty($data['logo'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['logo'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['logo'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['logo'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image1'] = $data['photo1'];
            unlink($from);
        }
        if(!empty($data['photo2'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo2'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo2'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo2'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image2'] = $data['photo2'];
            unlink($from);
        }
        if(!empty($data['photo3'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo3'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$data['photo3'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$data['photo3'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            $data['image3'] = $data['photo3'];
            unlink($from);
        }
        $data['date_start'] = strtotime($request->input('date_start'));
        $data['date_end']   = strtotime($request->input('date_end'));
        $partner = OptPartner::findOrFail($id);
        $partner->update($data);
        return redirect('/admin/opt_partner')->with('message', 'Успешно обновлено');
    }

    # По ид партнера удалить
    public function partner_destroy($id){
        $partner = OptPartner::findOrFail($id);
        if(!empty($partner->logo)){
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$partner->logo;
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$partner->logo;
            unlink($to);
            unlink($to_mini);
        }
        if(!empty($partner->image1)){
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$partner->image1;
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$partner->image1;
            unlink($to);
            unlink($to_mini);
        }
        if(!empty($partner->image2)){
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$partner->image2;
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$partner->image2;
            unlink($to);
            unlink($to_mini);
        }
        if(!empty($partner->image3)){
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/'.$partner->image3;
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/partners/small/'.$partner->image3;
            unlink($to);
            unlink($to_mini);
        }
        OptPartner::destroy($id);
        return redirect('/admin/opt_partner')->with('message', 'Успешно удален');
    }

    // Ассортименты
    public function range_index(){
        $opt_range = DB::select("SELECT * FROM opt_price_range");
        $opt_cats = DB::select("SELECT id,title,position,parent_id FROM opt_cat");
        return view('admin/optprice/opt-range-index', compact('opt_range', 'opt_cats'));
    }

    public function range_create(){
        $opt_partners = DB::select("SELECT * FROM opt_price_partners");
        $opt_cats = DB::select("SELECT id,title,position,parent_id FROM opt_cat");
        return view('admin/optprice/opt-range-create', compact('opt_partners', 'opt_cats'));
    }
    
    public function range_store(Request $request){
        $data = $request->all();
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
            $data['photo'] = $data['photo1'];
            unset($data['photo1']);
        }
        DB::transaction(function() use ($data){
            $lastInsertId = OptRange::create($data)->id;
            foreach ($data['id_opt_price_cat'] as $item){
                DB::insert("INSERT INTO opt_price_range_cat(id_cat,id_opt_price_range) VALUES('$item','$lastInsertId')");
            }
        });
        return redirect('admin/range')->with('message', 'Успешно добавлен');
    }

    # удаление ассортимента по ид
    public function range_destroy($id){
        $opt_range = OptRange::find($id);
        $file_large = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/'.$opt_range->photo;
        $file_small = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/small/'.$opt_range->photo;
        unlink($file_large);
        unlink($file_small);
        DB::transaction(function() use ($id){
            OptRange::destroy($id);
            DB::table('opt_price_range_cat')->where(['id_opt_price_range' => $id])->delete();
        });
        return redirect()->back()->with('message', 'Успешно удален');
    }

    # редактирование ассортимента
    public function range_edit($id){
        $opt_partners = DB::select("SELECT * FROM opt_price_partners");
        $opt_cats = DB::select("SELECT id,title,position,parent_id FROM opt_cat");
        $opt_range = OptRange::find($id);
        $range_cat = DB::select("SELECT * FROM opt_price_range_cat WHERE id_opt_price_range='$id'");
        $arr_range = [];
        for($i=0; $i<count($range_cat); $i++){
            $arr_range[$range_cat[$i]->id_cat]['ite'] = $i;
        }
        return view('admin/optprice/opt-range-edit', compact('opt_partners', 'opt_cats', 'opt_range', 'arr_range'));
    }

    # обновление по ид
    public function range_update(Request $request, $id){
        $data = $request->all();
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/small/'.$data['photo1'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
            $data['photo'] = $data['photo1'];
            unset($data['photo1']);
        }

        DB::transaction(function() use ($data,$id){
            $opt_range = OptRange::findOrFail($id);
            $opt_range->update($data);
            foreach ($data['id_opt_price_cat'] as $item){
                $result = DB::select("SELECT * FROM opt_price_range_cat WHERE id_cat='$item' AND id_opt_price_range='$id'");
                if(count($result) == 0){
                    // такой категории нет
                    DB::insert("INSERT INTO opt_price_range_cat(id_cat,id_opt_price_range) VALUES('$item','$id')");
                }
            }
        });
        return redirect('admin/range')->with('message', 'Успешно обновлен');
    }
    
    # удаление картинку
    public function range_destroy_photo($id){
        $opt_range = OptRange::findOrFail($id);
        $file_large = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/'.$opt_range->photo;
        $file_small = $_SERVER['DOCUMENT_ROOT'] . '/uploads/opt_price/range/small/'.$opt_range->photo;
        unlink($file_large);
        unlink($file_small);
        $opt_range->photo = '';
        $opt_range->save();
        return redirect()->back()->with('message', 'Картинка успешно удален');
    }
}
