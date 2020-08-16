@extends('layouts.app')

@section('content')
<listings-show 
    :objlisting="{{$listing}}"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/listings/'" class="btn-sm btn btn-secondary">Back</a>
                            <a :href="'/listings/'+listing.hash+'/edit'" class="btn-sm btn btn-primary">Edit</a>
                            <a :href="'/listings/'+listing.hash+'/delete'" class="btn-sm btn btn-danger">Delete</a>
                        </div> 
                        <span v-html="listing.name"></span>
                    </div>

                    <div class="card-body">
                        <div> 
                            <p class='m-0'><strong>Description:</strong></p>
                            <p v-html='listing.description || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Status:</strong></p>
                            <p v-html='listing.status || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>User:</strong></p>
                            <p v-if="listing.user" v-cloak>
                                <a href="{{url('users/'.$listing->user->hash)}}">
                                    @{{listing.user.name}}
                                    <small>
                                        (@{{listing.user.email}}) 
                                    </small>
                                </a>
                            </p>
                            <p v-else>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Editor:</strong></p>
                            <p v-if="listing.editor">
                                @{{listing.editor.name}}
                                <small>(@{{listing.editor.email}})</small>
                            </p>
                            <p v-else>N/A</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</listings-show>
@endsection
