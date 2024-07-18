<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInLoginRequest;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class SignInApiController extends Controller
{
    //
    public int $attempts = 5;

    public function authenticate(SignInLoginRequest $request)
    {
        if(RateLimiter::tooManyAttempts($request->ip(), $this->attempts)) {
            Log::info('SIGN IN | SIGN IN RATE LIMIT | ATTEMPTS: ' . $this->attempts . ' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors(['message' => 'Demasiadas tentativas de acesso. Por favor, tente novamente em 1 hora.']);
        }

        if(!$request->validated()) {
            Log::info('SIGN IN | SIGN IN VALIDATION | ERROR: '.$request->errors() .' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors($request->errors());
        }

        $field = match(gettype($request->input('username'))){
            'string' => filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username',
            'integer' => 'mobile_phone',
            default => 'username'
        };

        $credentials = [
            $field => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(Auth::attemptWhen($credentials, function ($user) {
            return $user->status === UserInterface::STATUS_ACTIVE;
        })) {
            session()->regenerate();

            if(auth()->user()->status === UserInterface::STATUS_ACTIVE){
                RateLimiter::clear($request->ip());
                return (session()->has('url.intended')) ? redirect(session()->get('url.intended')) : redirect()->route('home');
            }

            return redirect()->route('auth.sign-in')->withErrors(['message' => 'O utilizador não está ativo, verifique o seu e-mail para ativar a conta']);
        }

        $user = User::where($field, $request->input('username'))
            ->orWhere('mobile_phone', $request->input('username'))
            ->orWhere('email', $request->input('username'));

        if($user->count() > 0){
            switch ($user->first()->status) {
                case UserInterface::STATUS_PENDING:
                    return back()->withInput()->withErrors(['status' => 'A sua conta não está ativa, o administrador não aprovou a sua conta!.']);
                case UserInterface::STATUS_BANNED:
                    return back()->withInput()->withErrors(['status' => 'A sua conta foi banida. Contate o administrador.']);
                case UserInterface::STATUS_SUSPENDED:
                    return back()->withInput()->withErrors(['status' => 'A sua conta foi suspensa. Contate o administrador.']);
                case UserInterface::STATUS_EXPIRED:
                    return back()->withInput()->withErrors(['status' => 'A sua conta expirou. Contate o administrador.']);
            }
        }

        RateLimiter::hit($request->ip(), 3000);
        return back()->withInput()->withErrors(['message' => 'As credênciais introduzidas são inválidas, tente novamente.']);
    }

}
