@extends('layouts.app')

@section('content')
<users-list inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="row">
                            <div class="col-sm-4">
                                Users
                            </div>
                            <div class="col-sm-6">  
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" v-model="filters.q" placeholder="Type keywords here...">
                                    
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" @click="getList(1)" type="button">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{url('users/new')}}" class="btn btn-primary btn-sm btn-block">Add</a>
                            </div>
                        </div> 
                    </div>

                    <ul v-cloak class="list-group list-group-flush"  v-if="users.total">
                        <li v-for="(user, index) in users.data" class="list-group-item clearfix">
                            <div class="float-right" role="group">
                                <a :href="'/users/'+user.hash" class="btn-sm btn btn-info">View</a>
                                <a :href="'/users/'+user.hash+'/edit'" class="btn-sm btn btn-primary">Edit</a>
                                <a :href="'/users/'+user.hash+'/delete'" class="btn-sm btn btn-danger">Delete</a>
                            </div>
                            <span class="mr-3">@{{user.name}} </span>
                            <small class="text-muted mr-3">@{{user.email}}</small>
                            <small class="text-muted mr-3">@{{user.role}}</small>
                        </li> 
                    </ul> 

                    <ul v-cloak class="list-group list-group-flush" v-if="!users.total && !isLoading">
                        <li class="list-group-item clearfix text-center">
                            There are no users found. 
                        </li> 
                    </ul> 

                    <ul class="list-group list-group-flush" v-if="!users.total && isLoading">
                        <li class="list-group-item clearfix text-center">
                            loading...
                        </li> 
                    </ul> 
                </div>

                <pagination :data="users" @pagination-change-page="getPage"></pagination>
            </div>
        </div>
    </div>
</users-list>
@endsection
