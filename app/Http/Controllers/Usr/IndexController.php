<?php

namespace App\Http\Controllers\Usr;

use App\Card;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    protected $id_user;

    public function __construct()
    {
        $this->id_user = Auth::id();
    }

    public function account(){
        Card::setCard($this->id_user);
        return view('user/account');
    }
    
    # Выход из личного кабинета
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    # Форма редактирование профиль пользователя
    public function setting_form(){
        return view('user/settings');
    }
    
    # Сохранение данные о пользователя
    public function setting_save(Request $request){
        $data = $request->all();
        $data['id'] = $this->id_user;
        $user = User::findOrFail($this->id_user);
        $user->update($data);
        return redirect()->back();
    }

    public function balance_history(){
        $balances = DB::table('user_fm_history')->where(['id_user' => $this->id_user])->orderBy('date', 'DESC')->paginate(30);
        $profit_today = User::get_count_sum_agent($this->id_user,1);
        $profit_week  = User::get_count_sum_agent($this->id_user,2);
        $profit_month = User::get_count_sum_agent($this->id_user,3);
        return view('user/balance-history', compact('balances', 'profit_today', 'profit_week', 'profit_month'));
    }

    # снят со счета
    public function withdraw(Request $request){
        $data = $request->all();
        $amount = $data['amount'];
        //$amount_in_commission = $data['amount_in_commission'];
        $lastInsertID = DB::table('user_withdraw_history')->insertGetId([
            'id_user' => $this->id_user, 'amount' => $amount, 'status' => '0', 'created_at' => date("Y-m-d H:i:s")
        ]);

        if($lastInsertID){
            return $lastInsertID;
        }else{
            return 0;
        }
    }
}
