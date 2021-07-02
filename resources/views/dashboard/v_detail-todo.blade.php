@extends('layouts.app')

@section('title', 'Detail Todolist')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Todolist') }} <b>{{Auth::user()->name}}</b></div>

                <div class="card-body">
                    <h2 class="card-title text-center">{{$data->name}}</h2>

                    <p class="card-text">{{$data->comment}}</p>
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="{{$data->progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$data->progress}}%"><b>{{$data->progress}}%</b></div>
                    </div>


                </div>
                <div class="card-footer text-muted">
                    <strong>
                        {{$data->start_date}} - {{$data->end_date}}
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
