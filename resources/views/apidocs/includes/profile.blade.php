<div class="card-header">
  <h4 class="m-0">Profile API</h4>
</div>


<div class="card-body">
    <div class="accordion" id="accordionRegisterAPIs">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingProfileInfo">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left btn-block" type="button" data-toggle="collapse" data-target="#collapseProfileInfo" aria-expanded="false" aria-controls="collapseProfileInfo">
              Profile Info
            </button>
          </h2>
        </div>

        <div id="collapseProfileInfo" class="collapse" aria-labelledby="headingProfileInfo" data-parent="#accordionRegisterAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/profile</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Returns the loggedin user's details. This endpoint requires the <strong>TOKEN</strong> acquired in login.</p>
              <p>Note: User's details is also acquired during the login.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <p>None</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
<h4 class="m0">Example Response: Success</h4> 
<pre class="text-danger mb-5">
{
    "hash": "4n5qn",
    "full_name": "User1 One",
    "first_name": "User1",
    "last_name": "One",
    "email": "one@user.com",
    "contact_num": "+1.828.451.2447",
    "avatar": myavatar.jpg,
    "avatar_full": "http://upstage.test/image/avatars/myavatar.jpg",
    "avatar_thumbnail": "http://upstage.test/image/avatars/300/300/myavatar.jpg",
    "slug": "orvallakin.4n5qn",
    "fb_profile": {
        "fb_id": "",
        "fb_token": "",
        "fb_avatar": "",
        "fb_email": "",
        "fb_name": ""
    },
    "type": "agent",
    "agent_state": "Texas",
    "agent_license": "qwer-1233-gddssx-9086",
    "is_verified": false
}
</pre>  
            </div>

            <div class="mb-5">
<h4 class="m0">Example Response: Error</h4> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingProfileUpdate">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseProfileUpdate" aria-expanded="false" aria-controls="collapseProfileUpdate">
              Profile Update
            </button>
          </h2>
        </div>
        <div id="collapseProfileUpdate" class="collapse" aria-labelledby="headingProfileUpdate" data-parent="#accordionRegisterAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/profile</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for updating profile details.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <table class="table table-bordered table-hover font12">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Required</th>
                    <th>Description</th>
                    <th>Default Value</th>
                    <th>Example</th>
                  </tr>
                </thead>
                <tbody>
                  <tr> 
                    <td>first_name</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>John</td>
                  </tr> 
                  <tr> 
                    <td>last_name</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>John</td>
                  </tr> 
                  <tr> 
                    <td>contact_num</td>
                    <td>optional</td>
                    <td>String, conntact number in any format</td>
                    <td></td>
                    <td>+639235410000 or 02-1111-2222</td>
                  </tr>
                  <tr> 
                    <td>type</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>home_owner | agent</td>
                  </tr> 
                  <tr> 
                    <td>agent_state</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>Texas</td>
                  </tr> 
                  <tr> 
                    <td>agent_license</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>absc123</td>
                  </tr> 
                  <tr> 
                    <td>avatar</td>
                    <td>optional</td>
                    <td>File Image</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Account Created! Check your email and verify your account",
    "status": "success"
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not register.",
    "errors": {
        "email": [
            "The email has already been taken."
        ],
        "name": [
            "The name field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre>  
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingProfileAvatar">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseProfileAvatar" aria-expanded="false" aria-controls="collapseProfileAvatar">
              Avatar
            </button>
          </h2>
        </div>
        <div id="collapseProfileAvatar" class="collapse" aria-labelledby="headingProfileAvatar" data-parent="#accordionRegisterAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/profile/avatar</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="m-0">You can also upload the avatar when updating user details but use this API when you need to update the avatar only.</p>
              <p>When success, it will return the updated user's info</p>
            </div>

            <div class="mb-5">
              <h5 class="m0">Displaying Avatar</h5>
              <p class="m-0">The avatar filename is in the user info and you need to use the image server when displaying it.</p>
              <p>http://base_url/image/avatars/<strong class="text-primary">{width}</strong>/<strong class="text-primary">{height}</strong>/<strong class="text-primary">{avatar_filename}</strong></p>

              <ul>
                <li><strong>width</strong>: the desired width of image in PIXEL</li>
                <li><strong>height</strong>: the desired height of image in PIXEL</li>
                <li><strong>avatar_filename</strong>: value of "avatar" in user info</li>
                <li>You may remove the <strong>/width/height/</strong> to get the full size without cropping the image</li>
              </ul>

              <p class="m-0">Ex of cropped: http://localhost/image/avatars/100/100/avatar.png</p>
              <p>Ex of fullsize: http://localhost/image/avatars/avatar.png</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <table class="table table-bordered table-hover font12">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Required</th>
                    <th>Description</th>
                    <th>Default Value</th>
                    <th>Example</th>
                  </tr>
                </thead>
                <tbody>
                  <tr> 
                    <td>avatar</td>
                    <td>required</td>
                    <td>file</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "hash": "4n5qn",
    "full_name": "User1 One",
    "first_name": "User1",
    "last_name": "One",
    "email": "one@user.com",
    "contact_num": "+1.828.451.2447",
    "avatar": "1597759699_avatar_screen-shot-2020-08-13-at-13526-pmpng.png"
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not upload avatar.",
    "errors": {
        "avatar": [
            "The avatar field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre>  
            </div>
          </div>
        </div>
      </div>
    </div>
</div>