@extends('layouts.app')

@section('content')
<items-delete 
    :objitem="{{$item}}"
    listing_hash="{{$listing->hash}}"
    redirect_url="{{url('/listings/'.$listing->hash)}}"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/items/'" class="btn-sm btn btn-secondary">Back</a> 
                        </div> 
                        <span v-html="item.label"></span>
                    </div>

                    <div class="card-body">
                        <div v-cloak v-if="!msgSuccess" class="alert alert-danger text-center">
                            <h4>Are you sure you want to delete this item?</h4>
                            <button class="btn-danger btn" :disabled="isLoading" @click="deleteItem">Yes, Delete</button>
                        </div>

                        <div v-cloak v-if="msgSuccess" class="alert alert-success text-center">
                            <h4>@{{msgSuccess}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</items-delete>
@endsection
