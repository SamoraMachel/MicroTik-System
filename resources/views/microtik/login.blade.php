@extends('layouts.app')

    @section('styles')

    <link href="/css/routerLogin.css" rel="stylesheet" media="all">

    @endsection

    @section('content')

    <div class="page-wrapper p-t-30 p-b-10 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Router Login</h2>

                    @if(session('error'))
                        <h3 class="text-danger">{{session('error')}}</h3>
                    @endif
                    <form method="POST" action="{{ route("router_verify") }}">

                        @csrf 
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="IP Address" name="ip" value={{ @old('ip') }}>
                            @error('ip')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                            @enderror

                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Username" name="username" value={{ @old('username') }}>

                            @error('username')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password" name="password" >

                            @error('password')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="number" placeholder="Port" name="port" value={{ @old('port') }}>

                            @error('port')
                                <span class="text-danger font-weight-bold">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

