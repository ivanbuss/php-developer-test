@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users list</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ url('user/'.$user->id.'/view') }}">{{ $user->email }}</a></td>
                                <td><a href="{{ url('user/'.$user->id.'/view') }}">{{ $user->profile->first_name }}</a></td>
                                <td><a href="{{ url('user/'.$user->id.'/view') }}">{{ $user->profile->last_name }}</a></td>
                                <td><a v-on:click="popup" href="{{ url('user/'.$user->id.'/edit') }}">Edit</a><a href="{{ url('user/'.$user->id.'/delete') }}">Delete</a></td>
                            <tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $users->links() !!}
                    <a v-on:click="popup" class="btn btn-default" href="{{ url('user/add') }}" role="button">Add new user</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ modalTitle }}</h4>
            </div>
            <div class="modal-body" v-html="modalForm"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
