@extends('layouts.metronic.classic.app')

@section('content')
<users-form 
    :objuser="{{$user}}"
    url="{{url('/admin_api/users/'.$user->hash.'?_method=PUT')}}"
    action="put"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-users"></i> Edit User
                </h3>
            </div>
            <div>
                <a :href="'/users/'+user.hash"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-secondary">Cancel</span>
                        <span class="btn btn-secondary m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="flaticon-close m--font-secondary"></i>
                        </span> 
                    </span>
                </a>  
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                @include('users.form')
            </div>
        </div>
    </div>
</div>  
</users-form>
@endsection
