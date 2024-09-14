<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function index()
    {
        return view( 'profile.password-change' );
    }

    public function update( PasswordChangeRequest $request )
    {
        $request->validated();
        DB::table( 'users' )->where( 'id', '=', auth()->user()->id )->update( [
            'password' => Hash::make( $request->input( 'password' ) ),
        ] );

        return redirect(route('edit-profile'))->with('success', 'Password changed successfully');
    }
}
