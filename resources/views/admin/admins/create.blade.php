@extends('admin.sidenav')

@section('customStyle')
    <link href="{{ asset('css/routerLogin.css') }}" rel="stylesheet" media="all">
@endsection

@section('section-Head')
   + Admin To System
@endsection

@section('contentMain')

<div class="page-wrapper p-t-30 p-b-10 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-body">
                <h2 class="title">Add Admins</h2>

                <form method="POST" action="{{ route("admin.store") }}">

                    @csrf 
                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Admin Name" name="name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="email" placeholder="Email" name="email" value="{{ @old('email') }}" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="password" placeholder="Enter Password" name="password" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <input class="input--style-2" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                        
                    </div>                  

                    <div class="p-t-30">
                        <button class="btn btn--radius btn--green" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection