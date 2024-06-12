<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-md-10">
                {{--  --}}
                <h2>User Registration</h2>
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
                            <button type="submit" onclick="Register()" name="register" class="btn bg-gradient-info mt-3">Next</button>
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
    async function Register()
    {
        let email = document.getElementById('email').value;

        if(email.length == 0)
        {
            errorToast('Email required');
        }
        else
        {
            let response = await axios.get(`/UserRegistration/${email}`);
            if(response.status == 200)
            {
                sessionStorage.setItem('email', email);
                window.location.href="/verify";
                successToast("A 6 difit OTP code has been sent to you email address");
            }
            else
            {
                errorToast('Something went wrong');
            }
        }
    }
</script>
