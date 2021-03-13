@extends('admin.sidenav')

@section('customStyle')
    <link href="{{ asset('css/routerLogin.css') }}" rel="stylesheet" media="all">
@endsection

@section('section-Head')
    Package Section
@endsection

@section('contentMain')

<div class="page-wrapper p-t-30 p-b-10 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-body">
                <h2 class="title">Create New Package</h2>

                <form method="POST" action="{{ route("newProfile") }}">

                    @csrf 
                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Package Name" name="name" value={{ @old('ip') }}>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Shared Users" name="shared-users" value={{ @old('username') }}>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Rate Limit" name="rate-limit" value={{ @old('username') }}>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="number" placeholder="Price" name="price" value={{ @old('port') }}>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Status Autofresh" name="status-autofresh" value={{ @old('username') }}>
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Transparency Proxy" name="transparency-proxy" value={{ @old('username') }}>
                    </div>

                    <div class="p-t-30">
                        <button class="btn btn--radius btn--green" type="submit">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection