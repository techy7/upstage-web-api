<div class="card-header">
  <h4 class="m-0 clearfix">
    Registration Version2 Requirements API
  </h4>
</div>


<div class="card-body"> 
    <p>
      <i class="fa fa-exclamation-triangle text-danger"></i> 
      Note: These are the requirement APIs for the new regitration process. <strong class="text-danger">type, agent_state, agent_license</strong> are now OPTIONAL in the registration. You can include this in the regitration or register first and update the profile
    </p>
    <div class="accordion" id="accordionTemplate">
       
      <div class="card">
        <div class="card-header px-2 py-1" id="headingCheckEmail">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCheckEmail" aria-expanded="false" aria-controls="collapseCheckEmail">
              Check Email API
            </button>
          </h2>
        </div>
        <div id="collapseCheckEmail" class="collapse" aria-labelledby="headingCheckEmail" data-parent="#accordionTemplate">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/v2/login/check_email</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for checking if email exists. If not, it will send an <strong class="text-danger">Activation Code</strong> to the email address</p> 

              <p>Please check the status code, it returns <strong class="text-danger">404</strong> and <strong class="text-danger">200</strong>. The <strong class="text-danger">404</strong> means email not found and email was sent. You can use this to determine if user will login or register</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>n/a</p>
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
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Email found</h5> 
<pre class="text-danger">
{
    "message": "Email found",
    "status": "success",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : If email not found</h5> 
<pre class="text-danger mb-5">
{
    "message": "Email not found. Activation code was sent to email",
    "status": "not_found",
    "status_code": 404
}
</pre>  
            </div>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-header px-2 py-1" id="headingCheckEmail">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCheckEmail" aria-expanded="false" aria-controls="collapseCheckEmail">
              Check Activation Code API
            </button>
          </h2>
        </div>
        <div id="collapseCheckEmail" class="collapse" aria-labelledby="headingCheckEmail" data-parent="#accordionTemplate">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/v2/login/check_code</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for checking if activation code is valid</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>n/a</p>
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
                    <td>code</td>
                    <td>required</td>
                    <td>Should be the email sent from <strong class="text-danger">check_email</strong></td>
                    <td></td>
                    <td>OY84ZNWX</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger">
{
    "message": "Code found",
    "status": "success",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Invalid email and code combination",
    "status": "error",
    "status_code": 404
}
</pre>  
            </div>
          </div>
        </div>
      </div>
       
    </div>
</div>