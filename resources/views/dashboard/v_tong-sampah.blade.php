@extends('layouts.app')

@section('title', 'Tong Sampah')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Tong Sampah') }} Todolist <b>{{Auth::user()->name}}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b>Success  {{session('success')}}</b></h6>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6><i class="fas fa-check"></i><b>Error! {{session('error')}}</b></h6>
                    </div>
                    @endif

                    <a href="{{route('trash.deleteAll')}}" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete All</a>
                    <a href="{{route('trash.restoreAll')}}" class="btn btn-outline-success">Restore All</a>
                    <a href="{{route('dashboard')}}" class="btn btn-outline-primary">Kembali</a>
                    <div class="table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $list)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->start_date}}</td>
                                    <td><progress value="{{$list->progress}}" max="100"></progress></td>
                                    <td><a href="{{route('trash.restore', [$list->id])}}" class="btn btn-sm btn-outline-primary">Restore</a> <a href="{{route('trash.deletePermanent', [$list->id])}}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
