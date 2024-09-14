<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view( 'profile.edit' );
    }

    public function show(): View
    {
        return view( 'profile.show' );
    }

    public function update( UpdateUserProfileRequest $request )
    {
        if ( !auth()->user() ) {
            return false;
        }

        $request->validated();

        $imagePath = $request->file( 'avatar' ) ? $request->file( 'avatar' )->store( 'avatars', 'public' ) : auth()->user()->avatar;

        if ( $request->file( 'avatar' ) && auth()->user()->avatar ) {
            unlink( "storage/" . auth()->user()->avatar );
        }

        DB::table( 'users' )
            ->where( 'id', '=', auth()->user()->id )
            ->update( [
                "firstName" => $request->input( 'firstName' ),
                "lastName"  => $request->input( 'lastName' ),
                "email"     => $request->input( 'email' ),
                "bio"       => $request->input( 'bio' ),
                'avatar'    => $imagePath,
            ] );

        return redirect()->back()->with( 'success', 'Profile updated successfully!' );
    }
}
