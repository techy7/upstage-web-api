@extends('layouts.metronic.classic.app')

@section('content')
<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Dashboard
                </h3>
            </div>
             
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col-md-12"> 
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-widget1"> 

                            <div class="m-widget1__item">
                                <a href="{{url('apidocs')}}">Check the API docs</a>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div> 



 
@endsection
