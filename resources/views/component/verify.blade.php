<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-md-10">
                {{--  --}}
                <div class="card mt-lg-0">
                    <form id="contact-form">
                      <div class="card-body">
                        <div>
                          <label>Verify OTP Code</label>
                          <div class="input-group">
                            <input type="text" name="code" id="code" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <button onclick="Verify()" type="submit" class="btn bg-gradient-info mt-3">Confirm</button>
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
    async function Verify()
    {
        let code = document.getElementById('code').value;
        let email = sessionStorage.getItem('email');

        if(code.length == 0)
        {
            errorToast("Code Required");
        }
        else
        {
            let response = await axios.get(`/VerifyLogin/${email}/${code}`);

            if(response.status == 200)
            {
                if(sessionStorage.getItem('last_location'))
                {
                    // window.location.href= sessionStorage.getItem("last_location")
                    window.location.href="/";
                }
                else
                {
                    window.location.href="/"
                }
            }
            else
            {
                errorToast("Request Failed");
            }
        }
    }
</script>
