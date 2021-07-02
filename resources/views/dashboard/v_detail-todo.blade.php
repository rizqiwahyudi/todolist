@extends('layouts.app')

@section('title', 'Detail Todolist')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('dashboard')}}" class="btn btn-primary"><- Kembali</a><br><br>
            <div class="card">
                <div class="card-header">
                    {{ __('Detail Todolist') }} <b>{{Auth::user()->name}}</b><br>
                    <small>Start Date : {{$todolist->start_date}}</small>
                </div>

                <div class="card-body">
                    <h2 class="card-title text-center">{{$todolist->name}}</h2>

                    <div class="alert alert-secondary">
                        <p class="card-text">{{$todolist->comment}}</p>
                    </div>
                    <br>
                    <ul>
                        <li>Dibuat pada <b>{{$todolist->created_at}}</b>, Oleh <b>{{$todolist->created_by}}</b>.</li>
                        @if($todolist->updated_by != '')
                            <li>Terakhir diperbarui pada <b>{{$todolist->updated_at}}</b>, Oleh <b>{{$todolist->updated_by}}</b>.</li>
                        @endif
                    </ul><br><br>
                    <label>Progress :</label><br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="{{$todolist->progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$todolist->progress}}%"><b>{{$todolist->progress}}%</b></div>
                    </div>


                </div>
                <div class="card-footer text-muted">
                    <strong>
                        <div class="alert alert-danger">
                            Deadline : {{$todolist->end_date}}
                        </div>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
