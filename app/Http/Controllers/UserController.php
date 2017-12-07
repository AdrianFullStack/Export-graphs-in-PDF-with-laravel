<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function list_register(Request $request, User $user, DataTables $datatables)
    {
        if( $request->ajax() )
            return $datatables::of($user->with('profile')->get())->make(true);
    }

    public function view_graph()
    {
        $users  = User::with('profile')
                    ->groupBy('profile_id')
                    ->select('profile_id')
                    ->selectRaw('count(*) as count')
                    ->get('count');
        $data   = collect($users)->map(function($u){ return [ 'name' => $u->profile->name, 'y' => $u->count ]; });
        return view('user.graph', compact('data'));
    }

    public function download_pdf(Request $request){
        $image = $request->image;
        $view  = \View::make('user.export-pdf', compact('image'))->render();
        return \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadHtml( $view )
                    ->setPaper('A4')
                    ->stream("export_graph.pdf");
    }
}
