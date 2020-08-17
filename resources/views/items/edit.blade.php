@extends('layouts.app')

@section('content')
<plans-form 
    :objplan="{{$plan}}"
    url="{{url('/admin_api/plans/'.$plan->hash.'?_method=PUT')}}"
    action="put"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/plans/'" class="btn-sm btn btn-secondary">Back</a> 
                        </div>
                        Edit plan
                    </div>

                    <div class="card-body">
                        @include('plans.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</plans-form>
@endsection
