<?php

namespace App\Http\Controllers;

use App\Model\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $eventmembers=EventMember::paginate(10);
        return view('eventmember/index', compact('eventmembers'));
    }

    public function signup(Request $request)
    {
        $eventmembers=EventMember::where('events_id',$request->id)->paginate(10);
        return view('eventmember/signup', compact('eventmembers'));
    }
}
