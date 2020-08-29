<div class="m-portlet"> 
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-6 mb-3"> 
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Name
                </label>
                <input type='text' 
                    v-model='listing.name' 
                    class='form-control' 
                    :class="{'is-invalid': errors.name}"
                >
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.name' 
                    v-for='err in errors.name'
                >@{{err}}</small>
            </div>

            <div class="col-md-6 mb-3"> 
                <label class='clearfix d-block'>
                    Status
                </label>
                <select v-model='listing.status' 
                    class="form-control"
                >
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select> 
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.status' 
                    v-for='err in errors.status'
                >
                    @{{err}}
                </small> 
            </div>
            
            <div class="col-md-6 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    User
                </label>
                <select v-model='listing.user_id' 
                    class="form-control"
                >
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">
                            {{$user->full_name}} ({{$user->email}})
                        </option> 
                    @endforeach
                </select> 
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.user_id' 
                    v-for='err in errors.user_id'
                >
                    @{{err}}
                </small> 
            </div>

            <div class="col-md-6 mb-3">
                <label class='clearfix d-block'>
                    <small class='float-right'>* required</small>
                    Editor
                </label>
                <select v-model='listing.editor_id' 
                    class="form-control"
                >
                    <option value="">Select a Editor</option>
                    @foreach($editors as $editor)
                        <option value="{{$editor->id}}">
                            {{$editor->full_name}} ({{$editor->email}})
                        </option> 
                    @endforeach
                </select> 
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.editor_id' 
                    v-for='err in errors.editor_id'
                >
                    @{{err}}
                </small> 
            </div>

            <div class="col-md-12 mb-3"> 
                <label class='clearfix d-block'>
                    Description
                </label>
                <textarea v-model='listing.description' 
                    class='form-control' 
                    :class="{'is-invalid': errors.description}" 
                    rows="3"
                ></textarea>
                <small v-cloak 
                    class='text-danger' 
                    v-if='errors.description' 
                    v-for='err in errors.description'
                >@{{err}}</small>
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

<p class="text-center mt-5">
    <button class="btn btn-primary" 
        :disabled="isLoading" 
        @click="submitListing"
    >Submit</button>
</p>