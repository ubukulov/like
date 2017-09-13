<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin/user/user-index', compact('users'));
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

    public function phone(){
        $phone1 = $_POST['phone'];
        return $phone1;
    }

    public function card($number){
        $result = DB::select("SELECT US.id,US.referral,US.avatar,US.lastname,US.firstname,US.mphone,CR.code, US.fm, US.created_at,US.reg_date FROM users US
                        INNER JOIN cards CR ON CR.user_id=US.id
                        WHERE CR.code='$number'");
        $result = collect($result)->toArray();
        for($i=0; $i<count($result); $i++){
            $result[$i]->fm = __decode($result[$i]->fm, env('KEY'));
            if(!empty($result[$i]->reg_date)){
                $result[$i]->reg_date = date('d.m.Y H:i:s', $result[$i]->reg_date);
            }
        }
        return json_encode($result);
    }

    public function withdraw(){
        $withdraw = DB::table('user_withdraw_history')->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/user/withdraw', compact('withdraw'));
    }

    public function withdraw_set($id){
        $id = (int) $id;
        $withdraw = DB::table('user_withdraw_history')->where(['id' => $id, 'status' => '0'])->first();
        if($withdraw){
            $amount = $withdraw->amount;
            $id_user = $withdraw->id_user;
            $user = User::findOrFail($id_user);
            $user_balance = __decode($user->fm, env('KEY'));
            if($user_balance >= $amount){
                // у пользователя достаточно денег для снятия
                DB::transaction(function() use ($id_user, $amount, $id){
                    User::user_fm_minus($id_user, $amount, "Вывод денег со счета.");
                    DB::update("UPDATE user_withdraw_history SET status='1' WHERE id='$id'");
                });
                return redirect()->back()->with('message', 'Успешно начислено.');
            }else{
                return redirect()->back()->with('message', 'У пользователя недостаточно денег.');
            }
        }else{
            return redirect()->back()->with('message', 'Платеж уже начислен либо отменен.');
        }
    }
}
