@extends('layouts.app', [
    
    'class' => 'sidebar-mini',
    'activePage' => 'User List',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="card align-content-center">
        <div class="card-header">
        <div style="text-align:center;">
            <strong><h1>{{$record->name}}</h1></strong>
        </div>
            
        </div>
        <div class="card-body">
            
                <div class="ml-4"><strong><h4>Email</h4></strong> </div>
                <div class="ml-4">{{$record->email}}</div>
            
        </div>
    </div>

@endsection
