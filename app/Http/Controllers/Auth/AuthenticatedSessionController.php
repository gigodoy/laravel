<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login'); // Redirige a la vista login.blade.php
    }

    /**
     * Maneja el inicio de sesión de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario de login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // Regenerar la sesión para evitar ataques de fijación de sesión

            return redirect()->intended('/dashboard'); // Redirige a la página del dashboard
        }

        // Si no se puede autenticar, lanzar un error
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Cerrar sesión y redirigir a la página de inicio.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout(); // Destruir la sesión

        $request->session()->invalidate(); // Invalida la sesión para mejorar la seguridad
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect('/'); // Redirige al inicio
    }
}
