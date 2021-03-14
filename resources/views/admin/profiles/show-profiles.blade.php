@extends('admin.sidenav')

@section('section-Head')
    Packages Available
@endsection

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Packages</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Keep Alive</th>
                        <th>Autorefresh</th>
                        <th>Shared Users</th>
                        <th>Idle Timeout</th>
                        <th>Transparent Proxy</th>
                        <th>Mac Timeout</th>
                        <th>Address Pool</th>
                    </tr>
                </thead>
                <tfoot>
                    
                    {{-- <tr>
                        <th>Name</th>
                        <th>Address Pool</th>
                        <th>Idle </th>
                        <th>Keep Alive</th>
                        <th>Autorefresh</th>
                        <th>Shared Users</th>
                        <th>Transparent Proxy</th>
                        <th>Mac Timeout</th>
                    </tr> --}}
                </tfoot>
                <tbody>
                    @foreach ($profiles as $item)
                        
                        <tr>
                            <td class="text-success"> 
                                <b>{{ isset($item["name"])? ucfirst($item["name"]): "" }}</b>
                            </td>
                            <td> {{ isset($item["keepalive-timeout"])? $item["keepalive-timeout"]: "" }} </td>
                            <td> {{ isset($item["status-autorefresh"])? $item["status-autorefresh"]: "" }} </td>
                            <td> {{ isset($item["shared-users"])? $item["shared-users"]: ""  }} </td>
                            <td> {{ isset($item["idle-timeout"])? $item["idle-timeout"]: "" }} </td>
                            <td> {{ isset($item["transparent-proxy"])? $item["transparent-proxy"]: "" }} </td>
                            <td> {{ isset($item["mac-cookie-timeout"])? $item["mac-cookie-timeout"]: "" }} </td>
                            <td> {{ isset($item["address-pool"])? $item["address-pool"]: "" }} </td>
                        </tr>

                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection