@extends('admin.master')

@section('title', 'Admin | All members')

@section('body')

    <div class="container-fluid">
        <h2 class="mb-4">Member List</h2>

        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                members
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        
                        <th scope="col">Users Referred</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$serials++}}</th>
                            <td>{{$user->name}}</td>
                            
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>

                            <td>{{\App\User::where('ref_by',$user->id)->count()}}</td>
                            <td>
                                @if ($user->account_status==1)
                                    <span class="badge  badge-pill  badge-success">Active</span>
                                @elseif($user->account_status==0)
                                    <span class="badge  badge-pill  badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.member.details',$user->id)}}" class="btn btn-primary btn-sm customs-btn-bd text-white"> <i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                    <a href="{{route('admin.member.export')}}" class="btn btn-primary">Export all the members</a>
                <a href="{{route('admin.member.export.referrals')}}" class="btn btn-success">Export referral reports</a>
                </table>
                
<br>
                {{$users->links()}}
                
            </div>
        </div>
    </div>

    {{--dropdown active--}}
    <script>
        $('#memberSetting li:nth-child(1)').addClass('active');
        $('#memberSetting').addClass('show');
    </script>
@endsection

