@extends('admin.sidenav')

@section('section-Head')
    Admins at Microtik
@endsection

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Admins</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example23_info" style="width: 100%;">
                <thead >
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>                        
                    </tr>
                </thead>
                <tfoot>                   
                </tfoot>
                <tbody>
                    @foreach ($Admins as $user)
                        
                        <tr>
                            <td class="">
                                {{$user->id}}
                            </td>
                            <td > 
                                <b>{{ucfirst($user->name)}}</b>
                            </td>

                            <td> <a target="_blank" href="mailto:{{$user->email}}">{{$user->email}}</a>
                            </td>

                            <td> 
                                {{$user->created_at->diffForHumans()}}
                             </td>
                                
                            <td> 

                            </td>                            
                        </tr>

                    @endforeach

                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection