@extends('layouts.app')

@section('content')
<plans-show 
    :objplan="{{$plan}}"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/plans/'" class="btn-sm btn btn-secondary">Back</a>
                            <a :href="'/plans/'+plan.hash+'/edit'" class="btn-sm btn btn-primary">Edit</a>
                            <a :href="'/plans/'+plan.hash+'/delete'" class="btn-sm btn btn-danger">Delete</a>
                        </div> 
                        <span v-html="plan.name"></span>
                    </div>

                    <div class="card-body">
                        <div> 
                            <p class='m-0'><strong>Plan Identifier:</strong></p>
                            <p v-html='plan.plan_identifier || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Listings Limit:</strong></p>
                            <p v-html='plan.limit_list || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Storage Space Limit:</strong></p>
                            <p v-html='plan.limit_space || "n/a"'>N/A</p>
                        </div>

                        <div> 
                            <p class='m-0'><strong>Price:</strong></p>
                            <p v-html='plan.price || "n/a"'>N/A</p>
                        </div> 


                    </div>
                </div>
            </div>
        </div>
    </div>
</plans-show>
@endsection
