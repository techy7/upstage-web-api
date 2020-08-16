@extends('layouts.app')

@section('content')
<users-delete 
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
                        </div> 
                        <span v-html="user.name"></span>
                    </div>

                    <div class="card-body">
                        <div v-cloak v-if="!msgSuccess" class="alert alert-danger text-center">
                            <h4>Are you sure you want to delete this user?</h4>
                            <button class="btn-danger btn" :disabled="isLoading" @click="deleteUser">Yes, Delete</button>
                        </div>

                        <div v-cloak v-if="msgSuccess" class="alert alert-success text-center">
                            <h4>@{{msgSuccess}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</users-delete>
@endsection
