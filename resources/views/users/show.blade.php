@extends('layouts.app')

@section('content')
<users-show 
    :objuser="{{$user}}"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/users/'" class="btn-sm btn btn-secondary">Back</a>
                            <a :href="'/users/'+user.hash+'/edit'" class="btn-sm btn btn-primary">Edit</a>
                            <a :href="'/users/'+user.hash+'/delete'" class="btn-sm btn btn-danger">Delete</a>
                        </div> 
                        <span v-html="user.full_name"></span>
                    </div>

                    <div class="card-body">
                        <div> 
                            <p class='m-0'><strong>First Name:</strong></p>
                            <p v-html='user.first_name || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Last Name:</strong></p>
                            <p v-html='user.last_name || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Email:</strong></p>
                            <p v-html='user.email || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Contact Number:</strong></p>
                            <p v-html='user.contact_num || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Avatar:</strong></p>
                            <p v-if='user.avatar'>
                                <img :src="'/image/avatars/100/100/'+user.avatar" width='100' />
                            </p>
                            <p v-else>
                                <img src='/img/photo.png' width='100' />
                            </p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Role:</strong></p>
                            <p v-html='user.role || "n/a"'>N/A</p>
                        </div> 

                        <div> 
                            <p class='m-0'><strong>Plan:</strong></p>
                            <p v-if="user.plan">@{{user.plan.name}}</p>
                            <p v-else>N/A</p>
                        </div> 


                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group"> 
                            <a :href="'/listings/new?u='+user.id" class="btn-sm btn btn-primary">Add</a> 
                        </div> 
                        User Listings
                    </div>

                
                    <ul v-cloak class="list-group list-group-flush aaa"  v-if="user.listings && user.listings.length">
                        <li v-for="(list, index) in user.listings" class="list-group-item clearfix">
                            <div class="float-right" role="group">
                                <a :href="'/listings/'+list.hash" class="btn-sm btn btn-info">View</a> 
                            </div>
                            <span class="mr-3">@{{list.name}} </span>
                        </li> 
                    </ul> 
                    <ul v-cloak class="list-group list-group-flush eeeee" v-else>
                        <li class="list-group-item clearfix text-center">
                            This user has no listings
                        </li> 
                    </ul>  
                </div>
            </div>
        </div>
    </div>
</users-show>
@endsection
