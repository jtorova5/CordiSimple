<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login'); // Vista común de login
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validar los datos de inicio de sesión
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Verificar si el email pertenece a un Admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Iniciar sesión como admin y redirigir a su dashboard
            Auth::guard('admin')->login($admin);
            return redirect()->route('events.index'); // Redirigir a eventos para admins
        }

        // Si no es Admin, verificar si es un User
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Iniciar sesión como user y redirigir a su dashboard
            Auth::guard('web')->login($user);
            return redirect()->route('public.events.index'); // Redirigir a reservas para usuarios
        }

        // Si no se encontró el usuario o las credenciales no coinciden
        return back()->withErrors(['email' => trans('auth.failed')]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy()
    {
        // Logout para ambos tipos de usuario
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        return redirect()->route('welcome'); // Redirigir al dashboard después de cerrar sesión
    }
}





// holaaaaaaaaa hasta aqui