<?php

namespace App\Http\Controllers\Views\Auth;

use App\Helpers\Interfaces\ActivationAccountInterface;
use App\Helpers\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivationAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SignOutViewController extends Controller
{
    //
    public function activate(Request $request, $token)
    {
        $activate = ActivationAccount::where('token', $token)->firstOrFail();

        if($activate->status !== ActivationAccountInterface::STATUS_ACTIVE) {
            return redirect()->route('auth.activation', $token)->with('error', 'Esta ativação não é valida!');
        }

        $user = User::find($activate->user_id);
        $user->status = UserInterface::STATUS_ACTIVE;
        if(!$user->save()){
            Log::error("FAILED | ID: {$user->id} | UPDATED USER STATUS TO {$user->email}! TRY AGAIN, PLEASE!");
            return back()->withErrors(['message' => 'Falha ao ativar conta. Tente novamente.']);
        }

        $activate->status = ActivationAccountInterface::STATUS_USED;

        if(!$activate->save()){
            Log::error("FAILED | ID: {$activate->id} | UPDATED ACTIVATION ACCOUNT STATUS TO {$activate->email}! TRY AGAIN, PLEASE!");
            return back()->withErrors(['message' => 'Falha ao ativar conta. Tente novamente.']);
        }

        session()->flash('message', "Conta ativada com sucesso!");

        return redirect()->route('auth.sign-in');
    }
}
