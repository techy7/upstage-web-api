
<div class="row">
    <div class="col-md-12 mb-3">
        <label class='clearfix d-block'>
            <small class='float-right'>* required</small>
            Name
        </label>
        <input type='text' 
            v-model='user.name' 
            class='form-control' 
            :class="{'is-invalid': errors.name}"
        >
        <small v-cloak 
            class='text-danger' 
            v-if='errors.name' 
            v-for='err in errors.name'
        >
            @{{err}}
        </small>
    </div>

    <div class="col-md-12 mb-3">
        <label class='clearfix d-block'>
            <small class='float-right'>* required</small>
            Email
        </label>
        <input type='text' 
            v-model='user.email' 
            class='form-control' 
            :class="{'is-invalid': errors.email}"
        >
        <small v-cloak 
            class='text-danger' 
            v-if='errors.email' 
            v-for='err in errors.email'
        >
            @{{err}}
        </small>
    </div>

    <div class="col-md-12 mb-3" v-if="action == 'post'">
        <label class='clearfix d-block'>
            <small class='float-right'>* required</small>
            Password
        </label>
        <input type='password' 
            v-model='user.password' 
            class='form-control' 
            :class="{'is-invalid': errors.password}"
        >
        <small v-cloak 
            class='text-danger' 
            v-if='errors.password' 
            v-for='err in errors.password'
        >
            @{{err}}
        </small>
    </div>

    <div class="col-md-12 mb-3" v-if="action == 'post'">
        <label class='clearfix d-block'>
            Confirm Password
        </label>
        <input type='password' 
            v-model='user.password_confirmation' 
            class='form-control' 
            :class="{'is-invalid': errors.password_confirmation}"
        >
        <small v-cloak 
            class='text-danger' 
            v-if='errors.password_confirmation' 
            v-for='err in errors.password_confirmation'
        >
            @{{err}}
        </small>
    </div>

    <div class="col-md-12 mb-3">
        <label class='clearfix d-block'>
            Contact Number
        </label>
        <input type='number' 
            v-model='user.contact_num' 
            class='form-control' 
            :class="{'is-invalid': errors.contact_num}"
        >
        <small v-cloak 
            class='text-danger' 
            v-if='errors.contact_num' 
            v-for='err in errors.contact_num'
        >
            @{{err}}
        </small>
    </div>

    <div class="col-md-12 mb-3">
        <div class='clearfix'>
            Avatar
        </div>
        <div class='alert border clearfix'>
            <img v-if="user.avatar" 
                id='preview_img_upload_avatar' 
                :src="'/image/apps/100/100/'+user.avatar" 
                width='40' 
                class='float-right' 
            />
            <img v-else id='preview_img_upload_avatar' src='/img/photo.png' width='40' class='float-right' />
            <input type='file' 
                @change='updateImage($event, "img_upload_avatar", "avatar")' 
                id='img_upload_avatar'
                class="float-left" 
            > 
        </div>
    </div>

    <div class="col-md-6 mb-3"> 
        <label class='clearfix d-block'>
            Role
        </label>
        <select v-model='user.role' 
            class="form-control"
        >
            <option value="user">User</option>
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
        </select> 
        <small v-cloak 
            class='text-danger' 
            v-if='errors.role' 
            v-for='err in errors.role'
        >
            @{{err}}
        </small> 
    </div>

    <div class="col-md-6 mb-3">
        <label class='clearfix d-block'>
            Plan
        </label> 

        <select v-model='user.plan_id' 
            class="form-control"
        >
            <option value="">Select a Plan</option>
            @foreach($plans as $plan)
                <option value="{{$plan->id}}">
                    {{$plan->name}}
                </option> 
            @endforeach
        </select> 

        <small v-cloak 
            class='text-danger' 
            v-if='errors.price' 
            v-for='err in errors.price'
        >
            @{{err}}
        </small>
    </div>
</div>

<div v-cloak v-if="msgError" class="alert alert-danger">
    @{{msgError}}
</div>
<div v-cloak v-if="msgSuccess" class="alert alert-success">
    @{{msgSuccess}}
</div>

<p class="text-center mt-3">
    <button class="btn btn-primary" 
        :disabled="isLoading" 
        @click="submitUser"
    >Submit</button>
</p>