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
        $lists = Todolist::where('user_id', Auth::user()->id)->paginate(5);
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
            'name'       => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date'],
            'progress'   => ['required', 'max:100'],
            'comment'    => ['required'],
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
        if (Auth::user()->id == $todolist->user_id) {
            return view('dashboard.v_detail-todo', compact('todolist'));
        } else {
            return redirect('/dashboard')->with(['error' => 'Access Denied !']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        if (Auth::user()->id == $todolist->user_id) {
            return view('dashboard.v_edit-todo', compact('todolist'));
        } else {
            return redirect('/dashboard')->with(['error' => 'Access Denied !']);
        }
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
            'name'       => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date'],
            'progress'   => ['required', 'max:100'],
            'comment'    => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect("/dashboard/create-todo/$request->id")
                            ->withErrors($validator)
                            ->withInput();
        }

        if (Auth::user()->id == $todolist->user_id) {
            $data = $request->all();
            $data['updated_by'] = Auth::user()->email;
            $todolist->update($data);

            return redirect('/dashboard')->with(['success'  => 'Data Berhasil Diupdate!']);
        } else {
            return redirect('/dashboard')->with(['error'    => 'Data Gagal Diupdate!']);
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

        if (Auth::user()->id == $todolist->user_id) {
            $todolist->deleted_by = Auth::user()->email;
            $todolist->save();


            $todolist->delete();
            return redirect('/dashboard')
                                ->with(['success'  => 'Data Berhasil Dihapus Sementara!']);
        } else {
            return redirect('/dashboard')
                                ->with(['error'    => 'Data Gagal Dihapus!']);
        }
    }

    public function getDeleteTodos()
    {
        $lists = Todolist::where('user_id', Auth::user()->id)->onlyTrashed()->paginate(5);
        return view('dashboard.v_tong-sampah', compact('lists'));
    }

    public function restore($id)
    {

        $todolist = Todolist::onlyTrashed()->where('id', $id);
        $todolist->restore();

        if ($todolist) {
            return redirect('/dashboard')->with(['success'  => 'Data Berhasil Direstore!']);
        } else {
            return redirect('/dashboard')->with(['error'    => 'Data Gagal Direstore!']);
        }
    }

    public function restoreAll()
    {
        
        $todos = Todolist::where('user_id', Auth::user()->id)->onlyTrashed();
        $todos->restore();

        if ($todos) {
            return redirect('/dashboard')
                                ->with(['success'  => ' Semua Data Berhasil Direstore!']);
        } else {
            return redirect('/dashboard')
                                ->with(['error'    => 'Data Gagal Direstore!']);
        }
            
    }

    public function deletePermanent($id)
    {
        
        $todolist = Todolist::onlyTrashed()->where('id', $id);
        $todolist->forceDelete();

        if ($todolist) {
            return redirect('/dashboard/trash')
                                ->with(['success'   => 'Data Berhasil Dihapus Permanen!']);
        } else {
            return redirect('/dashboard/trash')
                                ->with(['error'     => 'Data Gagal Dihapus!']);
        } 
    }

    public function deleteAll()
    {

        $todos = Todolist::where('user_id', Auth::user()->id)->onlyTrashed();
        $todos->forceDelete();

        if ($todos) {
            return redirect('/dashboard/trash')
                                ->with(['success'   => 'Semua Data Berhasil Dihapus Permanen!']);
        } else {
            return redirect('/dashboard/trash')
                                ->with(['error'     => 'Data Gagal Dihapus!']);
        }
    }
}
