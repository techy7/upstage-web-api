@extends('layouts.app')

@section('content')
<users-form 
    :objuser="{{$user}}"
    url="{{url('/admin_api/users/'.$user->hash.'?_method=PUT')}}"
    action="put"
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
                        Edit user
                    </div>

                    <div class="card-body">
                        @include('users.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</users-form>
@endsection
