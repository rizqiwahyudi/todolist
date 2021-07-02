<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodolistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Todolist::where('user_id', Auth::user()->id)->get();
        return view('dashboard.v_index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.v_create-todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'progress' => ['required', 'max:100'],
            'comment' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect("/dashboard/create-todo")
                            ->withErrors($validator)
                            ->withInput();
        }

        $datas = $request->all();
        $datas['created_by'] = Auth::user()->email;
        Todolist::create($datas);
        return redirect("/dashboard")->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        
        return view('dashboard.v_detail-todo', compact('todolist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        return view('dashboard.v_edit-todo', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'progress' => ['required', 'max:100'],
            'comment' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect("/dashboard/create-todo/$request->id")
                            ->withErrors($validator)
                            ->withInput();
        }

        $todolist->name = $request->name;
        $todolist->start_date = $request->start_date;
        $todolist->end_date = $request->end_date;
        $todolist->progress = $request->progress;
        $todolist->comment = $request->comment;
        $todolist->updated_by = Auth::user()->email;
        $todolist->save();

        if ($todolist) {
            return redirect('/dashboard')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect('/dashboard')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        $todolist->delete();

        if ($todolist) {
            return redirect('/dashboard')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect('/dashboard')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
