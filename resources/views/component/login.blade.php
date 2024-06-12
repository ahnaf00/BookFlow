<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-md-10">
                {{--  --}}
                <div class="card mt-lg-0">
                    <form id="contact-form">
                      <div class="card-body">
                        <div>
                          <label>Email address</label>
                          <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="will@creative-tim.com">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" onclick="Login()" name="login" class="btn bg-gradient-info mt-3">Next</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                {{--  --}}
            </div>
        </div>
    </div>
</div>


<script>
    async function Login() {
        let email = document.getElementById('email').value;

        if (email.length == 0)
        {
            errorToast('Email required');
        } else
        {
            try {
                let response = await axios.get(`/UserLogin/${email}`);
                if (response.status == 200 && response.data.status == 'success')
                {
                    sessionStorage.setItem('email', email);
                    if(response.data.role === 'user')
                    {
                        window.location.href="{{route('HomePage')}}"
                    }
                    else if(response.data.role === 'admin')
                    {
                        window.location.href="{{route('admin.dashboard')}}";
                    }

                    successToast("User Login Successful");
                }
            } catch (error) {
                if (error.response && error.response.status == 401) {
                    window.location.href="/register";
                } else {
                    errorToast("An error occurred. Please try again.");
                }
            }
        }
    }
</script>
