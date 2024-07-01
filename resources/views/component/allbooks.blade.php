<section class="py-7">
    <div class="container">
        <div class="row align-items-center" id="allBooks">
            <h3 class="my-5 d-flex justify-content-center">All Books</h3>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        allBookList();
    });

    async function allBookList() {
        let allBooks = $('#allBooks');

        let response = await axios.get('/book-list');

        response.data.data.forEach((item) => {
            let row = `
                <div class="col-lg-3 col-6 mb-lg-0 mb-1">
                    <div class="card shadow-lg">
                        <div class="card-body px-0 pt-0 text-center border-radius-lg bg-white">
                            <a href="javascript:;">
                                <img class="w-100 border-radius-lg border-radius-bottom-end-0 border-radius-bottom-start-0"
                                    src="${item['image']}" alt="card image">
                            </a>
                            <h5 class="mt-3 mb-1 d-md-block d-none">${item['title']}</h5>
                            <p class="mb-1 d-md-none d-block text-sm font-weight-bold text-darker">${item['author']}</p>
                            <a href="/book-details/${item['id']}" type="button" class="btn bg-gradient-white w-80 mt-3" style="border-radius: 0px;">View Details</a>
                        </div>
                    </div>
                </div>
            `;
            allBooks.append(row);
        });
    }
</script>
