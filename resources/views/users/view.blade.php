@extends('layouts.app')

@section('content')
<div id="familytree" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Family tree for <a id="tree_link" v-on:click="showTree" href="{{ url('user/'.$user->id.'/view') }}">{{ $user->profile->first_name }} {{ $user->profile->last_name }}</a></div>
                <div class="panel-body">
                    <div class="row">
                        <div v-if="parents" v-for="parent in parents" class="col-md-3">
                            <div class="well">
                                <a v-on:click="showTree" href="/user/@{{ parent.id }}/view">Parent</a>
                                <p>@{{ parent.profile.first_name }} @{{ parent.profile.last_name }}</p>
                                <p>@{{ parent.email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div v-if="user" class="col-md-3 col-md-offset-2">
                            <div class="well">
                                <p>@{{ user.profile.first_name }} @{{ user.profile.last_name }}</p>
                                <p>@{{ user.email }}</p>
                            </div>
                        </div>
                        <div v-if="partner" class="col-md-3 col-md-offset-2">
                            <div class="well">
                                <a v-on:click="showTree" href="/user/@{{ partner.id }}/view">Partner</a>
                                <p>@{{ partner.profile.first_name }} @{{ partner.profile.last_name }}</p>
                                <p>@{{ partner.email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div v-if="children" v-for="child in children" class="col-md-3">
                            <div class="well">
                                <a v-on:click="showTree" href="/user/@{{ child.id }}/view">Child</a>
                                <p>@{{ child.profile.first_name }} @{{ child.profile.last_name }}</p>
                                <p>@{{ child.email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
