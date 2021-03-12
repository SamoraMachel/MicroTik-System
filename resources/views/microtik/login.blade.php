@extends('layouts.app')

    @section('styles')

    <link href="/css/routerLogin.css" rel="stylesheet" media="all">

    @endsection

    @section('content')

    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Router Login</h2>
                    <form action="{{route('router_verify')}}" method="POST">
                        @csrf
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="Remote Router IP Address" name="ip">

                                    @error('ip')
                                        <span class="text-danger font-weight-bold">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="Username" name="username">
                                     @error('username')
                                        <span class="text-danger font-weight-bold">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-2" type="password" placeholder="Password" name="password">
                                    @error('password')
                                        <span class="text-danger font-weight-bold">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-2" type="number" placeholder="Port" name="port">
                                    @error('port')
                                        <span class="text-danger font-weight-bold">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
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

