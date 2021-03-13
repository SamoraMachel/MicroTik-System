@extends('layouts.app')

    @section('content')

    <div class="page-wrapper p-t-30 p-b-10 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Router Login</h2>
                    <form method="POST" action="{{ route("router_verify ") }}">
                        
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="IP Address" name="ip" value={{ @old('ip') }}>
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Username" name="username" value={{ @old('username') }}>
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password" name="password" value={{ @old('password') }}>
                        </div>

                        <div class="input-group">
                            <input class="input--style-2" type="number" placeholder="Port" name="port" value={{ @old(port) }}>
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

</body>

</html>
<!-- end document-->
