<div class="m-portlet"> 
    <div class="m-portlet__body">
        
        <p>
            <label class='clearfix d-block'>
                <small class='float-right'>* required</small>
                Plan Name
            </label>
            <input type='text' v-model='plan.name' class='form-control' :class="{'is-invalid': errors.name}">
            <small v-cloak class='text-danger' v-if='errors.name' v-for='err in errors.name'>@{{err}}</small>
        </p>

        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Plan Identifier 
                    <small>(plan name in billing provider)</small>
                </label>
                <input type='text' 
                    v-model='plan.plan_identifier' 
                    class='form-control' 
                    :class="{'is-invalid': errors.plan_identifier}"
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.plan_identifier' 
                    v-for='err in errors.plan_identifier'
                >
                    @{{err}}
                </small>
            </div>

            <div class="col-md-6 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Listings Limit
                </label>
                <input type='number' 
                    v-model='plan.limit_list' 
                    class='form-control' 
                    :class="{'is-invalid': errors.limit_list}"
                    min="0" 
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.limit_list' 
                    v-for='err in errors.limit_list'
                >
                    @{{err}}
                </small>
            </div>

            <div class="col-md-6 mb-3"> 
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Storage Space Limit <small>(in MB)</small>
                </label>
                <input type='number' 
                    v-model='plan.limit_space' 
                    class='form-control' 
                    :class="{'is-invalid': errors.limit_space}"
                    min="0" 
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.limit_space' 
                    v-for='err in errors.limit_space'
                >
                    @{{err}}
                </small> 
            </div>

            <div class="col-md-6 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Price
                </label> 

                <div class="input-group">
                    <span class="input-group-addon w-50">
                        $
                    </span>
                    <input type='number' 
                        v-model='plan.price' 
                        class='form-control' 
                        :class="{'is-invalid': errors.price}"
                        min="0" 
                    >  
                </div> 

                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.price' 
                    v-for='err in errors.price'
                >
                    @{{err}}
                </small>
            </div>
        </div>

        
    </div>
</div>
 



<div v-cloak v-if="msgError" class="alert alert-danger">
    @{{msgError}}
</div>
<div v-cloak v-if="msgSuccess" class="alert alert-success">
    @{{msgSuccess}}
</div>

<p class="text-center">
    <button class="btn btn-primary" 
        :disabled="isLoading" 
        @click="submitPlan"
    >
        <span v-if="isLoading"><i class="fa fa-cog fa-spin"></i> Submitting...</span>
        <span v-else>Submit</span>
    </button>
</p>