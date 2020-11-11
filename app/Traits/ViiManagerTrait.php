<?php


namespace App\Traits;


use App\UserVii;
use Illuminate\Support\Facades\Auth;

trait ViiManagerTrait
{
    public function storeVii()
    {
        $authId = Auth::id();
        $vii = UserVii::where('user_id' , $authId)->get()->first();

        if($vii){
            $vii->amount += 5;
            $vii->save();
        }else
        {
            UserVii::create([
                'user_id' => $authId,
                'amount' => 5,
            ]);
        }
    }

    public function updateVii($userId, $amount)
    {
        $vii = UserVii::where('user_id' , $userId)->first();
        $vii->amount = $amount;
        $vii->save();
    }
}
