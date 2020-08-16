@extends('layouts.app')

@section('content')
<listings-list inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="row">
                            <div class="col-sm-4">
                                Listings
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 pr-1">
                                        <input type="text" 
                                            class="form-control form-control-sm" 
                                            v-model="filters.q" 
                                            placeholder="Type keywords here..."
                                        >
                                    </div>
                                    <div class="col-sm-4 pl-1 pr-1">
                                        <select v-model='filters.status' 
                                            class="form-control form-control-sm"
                                        >
                                            <option value="">All Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="in-progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                        </select> 
                                    </div>
                                    <div class="col-sm-2 pl-1">
                                        <button class="btn btn-secondary btn-block btn-sm" 
                                            @click="getList(1)" 
                                            type="button"
                                        >
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{url('listings/new')}}" class="btn btn-primary btn-sm btn-block">Add</a>
                            </div>
                        </div> 
                    </div>

                    <ul v-cloak class="list-group list-group-flush"  v-if="listings.total">
                        <li v-for="(listing, index) in listings.data" class="list-group-item clearfix">
                            <div class="float-right" role="group">
                                <a :href="'/listings/'+listing.hash" class="btn-sm btn btn-info">View</a>
                                <a :href="'/listings/'+listing.hash+'/edit'" class="btn-sm btn btn-primary">Edit</a>
                                <a :href="'/listings/'+listing.hash+'/delete'" class="btn-sm btn btn-danger">Delete</a>
                            </div>
                            <span class="mr-3">@{{listing.name}} </span>
                            <small class="text-muted mr-3">@{{listing.user.name}}</small>
                            <small class="text-muted mr-3">@{{listing.status}}</small>
                        </li> 
                    </ul> 

                    <ul v-cloak class="list-group list-group-flush" v-if="!listings.total && !isLoading">
                        <li class="list-group-item clearfix text-center">
                            There are no listings found. 
                        </li> 
                    </ul> 

                    <ul class="list-group list-group-flush" v-if="!listings.total && isLoading">
                        <li class="list-group-item clearfix text-center">
                            loading...
                        </li> 
                    </ul> 
                </div>

                <pagination :data="listings" @pagination-change-page="getPage"></pagination>
            </div>
        </div>
    </div>
</listings-list>
@endsection
