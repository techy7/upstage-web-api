<div class="m-portlet"> 
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    First Name
                </label>
                <input type='text' 
                    v-model='editor.first_name' 
                    class='form-control' 
                    :class="{'is-invalid': errors.first_name}"
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.first_name' 
                    v-for='err in errors.first_name'
                >
                    @{{err}}
                </small>
            </div>

            <div class="col-md-12 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Last Name
                </label>
                <input type='text' 
                    v-model='editor.last_name' 
                    class='form-control' 
                    :class="{'is-invalid': errors.last_name}"
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.last_name' 
                    v-for='err in errors.last_name'
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
                    v-model='editor.email' 
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
                    v-model='editor.password' 
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
                    v-model='editor.password_confirmation' 
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
                <input type='text' 
                    v-model='editor.contact_num' 
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
                    <img v-if="editor.avatar" 
                        id='preview_img_upload_avatar' 
                        :src="'/image/avatars/100/100/'+editor.avatar" 
                        width='40' 
                        class='float-right' 
                    />
                    <img v-else id='preview_img_upload_avatar' src='/img/photo.png' width='40' class='float-right' />
                    <input type='file' 
                        @change='updateImage($event, "img_upload_avatar", "avatar")' 
                        id='img_upload_avatar'
                        class="float-left mt-2" 
                    > 
                </div>
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

<p class="text-center mt-3">
    <button class="btn btn-primary" 
        :disabled="isLoading" 
        @click="submitEditor"
    >
        <span v-if="isLoading"><i class="fa fa-cog fa-spin"></i> Submitting...</span>
        <span v-else>Submit</span>
    </button>
</p>