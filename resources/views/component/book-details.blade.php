<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="bookDetails">

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        getBookDetails();
    });

    async function getBookDetails()
    {
        // const urlParams = new URLSearchParams(window.location.search)
        // const bookID = urlParams.get('id')
        const pathArray = window.location.pathname.split('/');
        const bookID = pathArray[pathArray.length - 1];

        if(!bookID)
        {
            document.getElementById('bookDetails').innerHTML = 'No Book Details Found'
            return
        }

        try
        {
            let response = await axios.post('/book-by-id', {id:bookID})
            let book = response.data.data

            if(response.status == 200)
            {
                const baseURL = "{{ asset('/') }}";
                let data = `
                    <div class="col-lg-4 justify-content-center d-flex flex-column">
                        <div class="card rounded-3">
                            <div class="d-block blur-shadow-image d-flex justify-content-center py-2">
                                <img src="${baseURL}${book['image']}" alt="img-blur-shadow-blog-2"
                                    class="img-fluid shadow rounded-3 text-center">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 justify-content-center d-flex flex-column ps-lg-5 pt-lg-0 pt-3">
                        <h3>
                            <a href="javascript:;" class="text-dark text-decoration-underline-hover">${book['title']}</a>
                        </h3>
                        <p>
                            ${book['description']}
                        </p>
                        <p class="author">
                            by <a href="#" class="ms-1"><span class="font-weight-bold text-info">${book['author']}</span></a>
                        </p>
                        <p class="category d-inline">
                            <span class="d-inline">Category: </span>
                            <span class="d-inline font-weight-bold">${book['category']['name']}</span>
                        </p>

                        <p class="category d-inline">
                            <span class="d-inline">Quantity: </span>
                            <span class="d-inline font-weight-bold" id="mainQty">${book['quantity']}</span>
                        </p>

                        <div class="quantity">
                            <input type="button" value="-" class="minus" onclick="decrement()">
                            <input id="p_qty" type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                            <input type="button" value="+" class="plus" onclick="increment()">
                        </div>

                        @if(Cookie::get('token') !== null)
                            <div class="card-footer pt-0">
                                <button class="btn w-50 bg-gradient-dark mb-0" onclick="handleBookNow('${book['id']}')">Book Now</button>
                            </div>
                        @else
                            <a href="{{ route('loginView') }}" class="btn w-50 bg-gradient-dark mb-0"
                                role="button">Login to Book</a>
                        @endif
                    </div>
                `
                document.getElementById('bookDetails').innerHTML = data;
            }
        }
        catch(error)
        {
            console.log(error);
        }
    }

    function increment()
    {
        let quantityInput       = document.getElementById('p_qty')
        let quantity            = parseInt(quantityInput.value)

        quantityInput.value     = quantity+1
    }

    function decrement()
    {
        let quantityInput       = document.getElementById('p_qty')
        let quantity            = parseInt(quantityInput.value)

        if(quantity > 1)
        {
            quantityInput.value = quantity-1
        }
    }

    async function handleBookNow(bookID) {
        try {
            let p_qty = parseInt(document.getElementById('p_qty').value);
            let mainQty = parseInt(document.getElementById('mainQty').textContent);

            if(p_qty > mainQty) {
                errorToast("Requested quantity exceeds available stock");
                return;
            }
            let newQuantity = mainQty - p_qty;

            let response = await axios.post('/landing-create', {
                book_id: bookID,
                quantity: p_qty
            });

            let quantityResponse = await axios.post('/bookquantity-update', {
                book_id: bookID,
                quantity: newQuantity
            });

            if(response.status == 200 && quantityResponse.status == 200)
            {
                successToast("Your Book lending request is pending. Contact the librarian inperson")
            }
        } catch (error) {
            errorToast("Lending request failed")
        }
    }
</script>
