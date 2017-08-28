<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Partner;
use App\SimpleImage;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::get();
        return view('admin/partner/partner-index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/partner/partner-create');
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
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/small/'.$data['photo1'];

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
        if(!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        Partner::create($data);
        return redirect('admin/partners')->with('message', 'Успешно добавлено');
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
        $partner = Partner::find($id);
        return view('admin/partner/partner-edit', compact('partner'));
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
        $data = $request->all();
        $partner = Partner::findOrFail($id);
        if(!empty($data['photo1'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/'.$data['photo1'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/small/'.$data['photo1'];

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
		if(substr($data['password'],0,6) != '$2y$10'){
			// пароль введен заново
            $data['password'] = bcrypt($data['password']);
		}
        $partner->update($data);
        return redirect('admin/partners')->with('message', 'Успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        if(!empty($partner->image)){
            $image = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/'.$partner->image;
            $image_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/partners/small/'.$partner->image;
            unlink($image);
            unlink($image_mini);
        }
        Partner::destroy($id);
        return redirect('admin/partners')->with('message', 'Успешно удален');
    }

    # начисление партнеров
    public function partner_charges(){
        $charges = DB::table('pay_to_user')->orderBy("id", 'DESC')->paginate(30);
        return view('admin/partner/partner-charge', compact('charges'));
    }

    # возврат
    public function refund($id_pay){
        $payment = DB::select("SELECT * FROM pay_to_user WHERE id='$id_pay'");
        $status = $payment[0]->status + 10;
        DB::transaction(function() use ($payment,$status,$id_pay){
            DB::update("UPDATE `pay_to_user` SET `status`= '$status' WHERE id = '$id_pay'");
            User::user_fm_minus($payment[0]->user_id, $payment[0]->sum, 'Возврат начисления: id ' . $payment[0]->id);
            Partner::partner_fm_plus($payment[0]->partner_id, $payment[0]->sum_minus, 'Возврат начисления: id ' . $payment[0]->id);
        });
        return redirect('admin/partners/charge')->with('message', 'Транзакция успешно завершен');
    }
}
