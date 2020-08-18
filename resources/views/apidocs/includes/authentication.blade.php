<div class="card-header">
  <h4 class="m-0">Authentication API</h4>
</div>

<div class="card-body">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingAuthLogin">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left btn-block" type="button" data-toggle="collapse" data-target="#collapseAuthLogin" aria-expanded="false" aria-controls="collapseAuthLogin">
              Login
            </button>
          </h2>
        </div>

        <div id="collapseAuthLogin" class="collapse" aria-labelledby="headingAuthLogin" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/login</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for login. When login is success, it will return a fresh token and profile info.</p>
              <p class="mb-1">All dummy users has a default password of <strong class="text-primary">password</strong></p>
              <p class="mb-1">Some test emails are:</p> 
                <ul>
                  <li><strong class="text-primary">one@user.com</strong> (verified)</li>
                  <li><strong class="text-primary">two@user.com</strong> (unverified)</li>
                </ul>
            </div>

            <div class="mb-5">
              <h5 class="m0">Parameters</h5>
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
                    <td>email</td>
                    <td>required</td>
                    <td>Should be email format</td>
                    <td></td>
                    <td>john@doe.com</td>
                  </tr>
                  <tr> 
                    <td>password</td>
                    <td>required</td>
                    <td>Minimum of 6 characters</td>
                    <td></td>
                    <td>password</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjksImlzcyI6Imh0dHA6XC9cL2...",
  "token_type": "bearer",
  "profile": {
      "hash": "4n5qn",
      "name": "User1 One",
      "email": "one@user.com",
      "contact_num": "+1.828.451.2447",
      "avatar": null,
      "slug": "orvallakin.4n5qn",
      "is_verified": true
  }
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
  "error": "Invalid credentials",
  "status_code": 422
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger">
{
  "error": "Email not verified",
  "status_code": 401
}
</pre> 
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingAuthRegister">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthRegister" aria-expanded="false" aria-controls="collapseAuthRegister">
              Register
            </button>
          </h2>
        </div>
        <div id="collapseAuthRegister" class="collapse" aria-labelledby="headingAuthRegister" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/register</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for registration. When registration is success, a success status and verification email will be sent to the User's email.</p>
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
                    <td>name</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>John</td>
                  </tr>
                  <tr> 
                    <td>email</td>
                    <td>required</td>
                    <td>Should be email format</td>
                    <td></td>
                    <td>john@doe.com</td>
                  </tr>
                  <tr> 
                    <td>password</td>
                    <td>required</td>
                    <td>Minimum of 8 characters</td>
                    <td></td>
                    <td>secretpassword</td>
                  </tr>
                  <tr> 
                    <td>password_confirmation</td>
                    <td>required</td>
                    <td>Should be the same as <strong>password</strong>'s value</td>
                    <td></td>
                    <td>secretpassword</td>
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
        <div class="card-header px-2 py-1" id="headingAuthFB">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthFB" aria-expanded="false" aria-controls="collapseAuthFB">
              Facebook Login (soon)
            </button>
          </h2>
        </div>
        <div id="collapseAuthFB" class="collapse" aria-labelledby="headingAuthFB" data-parent="#accordionExample">
          <div class="card-body">
            Soon...
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingAuthGoogle">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthGoogle" aria-expanded="false" aria-controls="collapseAuthGoogle">
              Google Login (soon)
            </button>
          </h2>
        </div>
        <div id="collapseAuthGoogle" class="collapse" aria-labelledby="headingAuthGoogle" data-parent="#accordionExample">
          <div class="card-body">
            Soon...
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingAuthForgotPass">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthForgotPass" aria-expanded="false" aria-controls="collapseAuthForgotPass">
              Forgot Password (soon)
            </button>
          </h2>
        </div>
        <div id="collapseAuthForgotPass" class="collapse" aria-labelledby="headingAuthForgotPass" data-parent="#accordionExample">
          <div class="card-body">
            Soon...
          </div>
        </div>
      </div>
    </div>
</div>