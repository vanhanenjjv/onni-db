<?php

namespace OWS\Http\Controllers\Settings;

use Auth;
use Illuminate\Http\Request;
use OWS\Rules\CurrentPassword;
use OWS\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show password change form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('settings.password')->with(['user' => $user]);
    }

    /**
     * Store settings to database.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'current_password'          => ['required', 'string', new CurrentPassword()],
            'new_password'              => 'required|string|min:8|different:current_password',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()
            ->route('settings.password')
            ->with([
                'flash_status'  => 'success',
                'flash_message' => 'Settings saved.',
            ]);
    }
}
