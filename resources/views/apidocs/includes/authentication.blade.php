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
    "full_name": "User1 One",
    "first_name": "User1",
    "last_name": "One",
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
                    <td>contact_num</td>
                    <td>optional</td>
                    <td>Contact number</td>
                    <td></td>
                    <td>john@doe.com</td>
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
                  <tr> 
                    <td>type</td>
                    <td>optional</td>
                    <td>Choose from <strong>home_owner</strong> or <strong>agent</strong></td>
                    <td></td>
                    <td>home_owner</td>
                  </tr>
                  <tr> 
                    <td>agent_state</td>
                    <td>optional</td>
                    <td>This is <strong>required</strong> only if <strong>type = agent</strong></td>
                    <td></td>
                    <td>Texas</td>
                  </tr>
                  <tr> 
                    <td>agent_license</td>
                    <td>optional</td>
                    <td>This is <strong>required</strong> only if <strong>type = agent</strong></td>
                    <td></td>
                    <td>asdf1234-zxcv-09876</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "status": "success",
    "message": "Account Created! Check your email and verify your account", 
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTU5OTkxODY4NCwibmJmIjoxNTk5OTE4Njg0LCJqdGkiOiJrTGRFTXd6U1dQWm9pbVVkIiwic3ViIjo1NSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.ESmd-0EBn1KotWqwKcgh8P9QGI8gvbVO9AZ0YgyDvmE",
    "token_type": "bearer",
    "profile": {
        "hash": "xjn4x",
        "full_name": "ff ff",
        "first_name": "ff",
        "last_name": "ff",
        "email": "ff7@f.f",
        "contact_num": null,
        "avatar": null,
        "slug": "ffff.xjn4x",
        "is_verified": false,
        "fb_profile": null,
        "type": "agent",
        "agent_state": "Texas",
        "agent_license": "qwer-1233-gddssx-9086"
    }
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
        ],
        "type": [
            "The selected type is invalid."
        ]
        "agent_state": [
            "The agent state field is required when type is agent."
        ],
        "agent_license": [
            "The agent license field is required when type is agent."
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
      <div class="card ">
        <div class="card-header px-2 py-1" id="headingAuthVerifyCode">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthVerifyCode" aria-expanded="false" aria-controls="collapseAuthVerifyCode">
              Verify Account
            </button>
          </h2>
        </div>
        <div id="collapseAuthVerifyCode" class="collapse" aria-labelledby="headingAuthVerifyCode" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/register/verify</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint to verify account</p>
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
                    <td>code</td>
                    <td>required</td>
                    <td>String, generated code and sent in the email of the user upon registration</td>
                    <td></td>
                    <td>P4PY42</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Account has been verified",
    "status": "success",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Missing fields",
    "errors": {
        "code": [
            "The code field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre>  

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Unable to verify account",
    "errors": {
        "code": [
            "The code is invalid or expired"
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
        <div class="card-header px-2 py-1" id="headingVerifyResendCode">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseVerifyResendCode" aria-expanded="false" aria-controls="collapseVerifyResendCode">
              Re-send Verification Code
            </button>
          </h2>
        </div>
        <div id="collapseVerifyResendCode" class="collapse" aria-labelledby="headingVerifyResendCode" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/register/verify/resend</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint to request another verification code. When success, it will send the verify code to the user's email</p>
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
                    <td>email</td>
                    <td>required</td>
                    <td>String, the user's email</td>
                    <td></td>
                    <td>one@user.com</td>
                  </tr> 
                </tbody>
              </table>
            </div>
            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>
            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Code sent! Check your email and verify your account",
    "status": "success"
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Error. Email not found or the account is already verified",
    "status": "error",
    "status_code": 422
}
</pre>  

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not resend verification code.",
    "errors": {
        "email": [
            "The email field is required."
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
              Facebook Login 
            </button>
          </h2>
        </div>
        <div id="collapseAuthFB" class="collapse" aria-labelledby="headingAuthFB" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/login/facebook</p> 
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
                    <td>id</td>
                    <td>required</td>
                    <td>String, user's facebook id</td>
                    <td></td>
                    <td>12334456778844</td>
                  </tr>
                  <tr> 
                    <td>name</td>
                    <td>required</td>
                    <td>User's facebook name</td>
                    <td></td>
                    <td>John Doe</td>
                  </tr>
                  <tr> 
                    <td>email</td>
                    <td>required</td>
                    <td>User's facebook email</td>
                    <td></td>
                    <td>john@doe.com</td>
                  </tr> 
                  <tr> 
                    <td>access_token</td>
                    <td>optional</td>
                    <td>User's facebook access_token</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr> 
                    <td>picture</td>
                    <td>optional</td>
                    <td>Url of user's facebook avatar</td>
                    <td></td>
                    <td>https://graph.facebook.com/123131312/picture</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpblwvZmFjZWJvb2siLCJpYXQiOjE1OTkyMzk1OTEsIm5iZiI6MTU5OTIzOTU5MSwianRpIjoiVmZmTTNjVjFKRFV0RmRibSIsInN1YiI6NTEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.ROjbIyHjACelCaiTy_ro7i6j1l_DndcO4lr3rRtqMxs",
    "token_type": "bearer",
    "profile": {
        "hash": "rkv4l",
        "full_name": "kk kamote",
        "first_name": "kk",
        "last_name": "kamote",
        "email": "kk@kk.kk",
        "contact_num": null,
        "avatar": null,
        "fb_profile": {
            "fb_id": "1233",
            "fb_token": "abbbb",
            "fb_avatar": "http://localhost:8000/img/user1.png",
            "fb_email": "kk@kk.kk",
            "fb_name": "kk kamote"
        },
        "slug": ".rkv4l",
        "is_verified": true
    }
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Login to facebook failed.",
    "errors": {
        "access_token": [
            "The access token field is required."
        ],
        "id": [
            "The id field is required."
        ],
        "email": [
            "The email field is required."
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
      <div class="card d-none">
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
              Forgot Password
            </button>
          </h2>
        </div>
        <div id="collapseAuthForgotPass" class="collapse" aria-labelledby="headingAuthForgotPass" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/password/email</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for requesting a password reset. When request is success, it will send an email to the user with the CODE. This endpoint does not reset his password immediately, please refer to the <strong class="text-primary">Reset Password</strong> section.</p>
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
                    <td>email</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>one@user.com</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Reset code was sent to ff1@f.f",
    "status": "success",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Missing field.",
    "errors": {
        "email": [
            "The email field is required."
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
        <div class="card-header px-2 py-1" id="headingAuthResetPass">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthResetPass" aria-expanded="false" aria-controls="collapseAuthResetPass">
              Reset Password
            </button>
          </h2>
        </div>
        <div id="collapseAuthResetPass" class="collapse" aria-labelledby="headingAuthResetPass" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/password/reset</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for the actual changing of password. This endpoint requires a token CODE which was emailed to the user. Please refer to <strong class="text-primary">Forgot Password</strong> section on how to request for CODE</p>
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
                    <td>email</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>one@user.com</td>
                  </tr> 
                  <tr> 
                    <td>code</td>
                    <td>required</td>
                    <td>Token code which was email to the user</td>
                    <td></td>
                    <td>a12bc3</td>
                  </tr> 
                  <tr> 
                    <td>password</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>secretpass</td>
                  </tr> 
                  <tr> 
                    <td>password_confirmation</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>secretpass</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Password has been reset",
    "status": "success",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Missing field.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "code": [
            "The code field is required."
        ],
        "password": [
            "The password field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre>  

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Unable to reset password",
    "errors": {
        "code": [
            "The code is invalid or expired"
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
        <div class="card-header px-2 py-1" id="headingAuthLogout">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAuthLogout" aria-expanded="false" aria-controls="collapseAuthLogout">
              Logout
            </button>
          </h2>
        </div>
        <div id="collapseAuthLogout" class="collapse" aria-labelledby="headingAuthLogout" data-parent="#accordionExample">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">GET base_url/api/logout</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="m-0">Endpoint to logout and invalidate token</p> 
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
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Successfully logged out",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "error": "Invalid Session",
    "status_code": 401
}
</pre>  
            </div>
          </div>
        </div>
      </div>
    </div>
</div>