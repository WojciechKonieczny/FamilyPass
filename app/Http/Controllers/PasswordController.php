<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // zwraca wszystkich rekordow
    public function index() {
        // dd(Item::with('manufacturer', 'modelorname', 'category')->get());
        return view(
            'passwords.index', // nazwa szablony
            [
                'pass' => Password::withTrashed()->get()
            ]
        );
    }

    public function create() {
        return view(
            'passwords.create'
        );
    }

    public function store( Request $request ) {


        $password = Password::create(
            $request->merge([
                'password' => Crypt::encrypt($request->password),
                'user_id' => Auth::id(),
            ])->all()
        );

        return redirect()->route('passwords.index')->with('success', __('Password has been added successfully'));
    }

    // wyswietlajaca formularz
    public function edit(Password $password) {
        $isEdit = true;

        return view(
            'passwords.create',
            compact( 'password', ['isEdit'] )
        );
    }

    // wysylajace dane do bazy
    public function update(Request $request, Password $password) {
        $password->fill(
            $request->merge([
                'password' => Crypt::encrypt($request->password),
                'created_by' => Auth::id()
            ])->all()
        )->save();

        return redirect()->route('passwords.index');
    }

    public function destroy(Password $password) {
        $password->delete();

        return redirect()->route('passwords.index');
    }

    public function restore(int $id) {
        $password = Password::onlyTrashed()->findOrFail($id);
        $password->restore();

        return redirect()->route('passwords.index');

    }
}
