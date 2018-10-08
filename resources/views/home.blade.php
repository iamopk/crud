@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @include('layouts._user_table');
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
