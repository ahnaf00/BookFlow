<section>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                <h3 class="text-center">User Profile</h3>
                <form role="form" id="contact-form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" id="first_name">
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label>Last Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="last_name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 ps-2">
                                <label>Phone</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="phone">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label>Address</label>
                            <textarea name="address" class="form-control border-radius-lg" id="address" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button onclick="createOrUpdateUser()" type="submit" class="btn bg-gradient-dark w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    // document.addEventListener('DOMContentLoaded', function() {
    // });
    userDetails();
    async function userDetails()
    {
        let response = await axios.get('/ReadProfile')
        if(response.status == 200)
        {

            document.getElementById('first_name').value     = response.data.data['first_name']
            document.getElementById('last_name').value      = response.data.data['last_name']
            document.getElementById('email').value          = response.data.data['user']['email']
            document.getElementById('phone').value          = response.data.data['phone']
            document.getElementById('address').value        = response.data.data['address']
        }
        else
        {
            errorToast("Something went wrong")
        }
    }

    async function createOrUpdateUser()
    {
        let first_name  = document.getElementById('first_name').value
        let last_name   = document.getElementById('last_name').value
        let phone       = document.getElementById('phone').value
        let address     = document.getElementById('address').value

        let postBody = {
            "first_name":first_name,
            "last_name":last_name,
            "phone":phone,
            "address":address
        }


        let response = await axios.post('/CreateProfile', postBody)

        if(response.status == 200)
        {
            successToast("User data saved")
            await userDetails()
        }
        else
        {
            errorToast("Something went wrong")
        }
    }
</script>
