<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],　→現状name欄の指示はないためコメントアウト
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[\x21-\x7E]+$/',
                'unique:'.User::class
            ],
            'password' => [
                'required',
                'regex:/^[!-~]+$/',
                Rules\Password::defaults()
            ],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()], →現状確認用は必要ないためコメントアウト
        ],
        [
            'email.regex' => 'メールアドレスは半角英数字・記号のみで入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'password.regex' => 'パスワードは半角英数字・記号のみで入力してください。',
        ]);

        $user = User::create([
            // 'name' => $request->name,　→現状name欄の指示はないためコメントアウト
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);　→現状は自動ログインしないためコメントアウト

        // return redirect(RouteServiceProvider::HOME);　→現状は自動ログインしないためコメントアウト

        return redirect()->route('login');
            
    }
}
