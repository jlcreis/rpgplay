@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="display-4">Jogadores</h1>
        </div>
        <div class="col">
            @if (session('msg_ok'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><small>{{ session('msg_ok') }}</small></p>
            </div>
            @endif
            @if (session('msg_erro'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p><small>{{ session('msg_erro') }}</small></p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
