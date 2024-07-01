<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Book</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                        <div class="container">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12 p-1">
                                            <label class="form-label">Book Title *</label>
                                            <input type="text" class="form-control" id="bookTitle">
                                        </div>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Author</label>
                                            <input type="text" class="form-control" id="bookAuthor">
                                        </div>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Publisher</label>
                                            <input type="text" class="form-control" id="bookPublihser">
                                        </div>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Description</label>
                                            <input type="text" class="form-control" id="bookDescription">
                                        </div>


                                    </div>
                                    <div class="col-12">
                                        <div class="col-12 p-1">
                                            <label class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="bookQuantity">
                                        </div>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Select Category</label>
                                            <select class="form-select" aria-label="Default select example" id="bookCategory">
                                                <option selected>Open this select menu</option>
                                            </select>
                                        </div>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Select SubCategory</label>
                                            <select class="form-select" aria-label="Default select example" id="bookSubCategory">
                                                <option selected>Open this select menu</option>
                                            </select>
                                        </div>

                                        <br/>
                                            <img class="w-25" id="newImg" src="{{asset('uploads/default.jpg')}}"/>
                                        <br/>

                                        <div class="col-12 p-1">
                                            <label class="form-label">Image</label>
                                            <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="bookImage">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>

{{-- <script>
    fetchCategories()
    async function fetchCategories()
    {
        let bookCategory = $('#bookCategory')

        let categoryResponse = await axios.get('/category-list')

        categoryResponse.data.forEach((item, index)=>{
            let row = `<option value="${item['id']}">${item['name']}</option>`
            bookCategory.append(row)
        })

        bookCategory.on('change', fetchSubcategories);

    }

    async function fetchSubcategories() {
        let bookCategory = document.getElementById('bookCategory').value;
        let bookSubCategory = $('#bookSubCategory');
        bookSubCategory.empty();  // Clear previous options

        if (bookCategory) {
            let response = await axios.post('/category-by-id', {id:bookCategory});
            if (response.data.msg === "success") {
                response.data.data.subcategories.forEach((item, index) => {
                    let row = `<option value="${item['id']}">${item['name']}</option>`;
                    bookSubCategory.append(row);
                });
            }
        }
    }

    async function Save(id)
    {
        let bookTitle           = document.getElementById('bookTitle').value
        let bookAuthor          = document.getElementById('bookAuthor').value
        let bookPublihser       = document.getElementById('bookPublihser').value
        let bookDescription     = document.getElementById('bookDescription').value
        let bookQuantity        = document.getElementById('bookQuantity').value
        let bookCategory        = document.getElementById('bookCategory').value
        let bookSubCategory     = document.getElementById('bookSubCategory').value
        let bookImage           = document.getElementById('bookImage').files[0]

        if(bookTitle.length == 0)
        {
            errorToast("Book title is required!")
        }
        else if(bookAuthor.length == 0)
        {
            errorToast("Book author name is required!")
        }
        else if(bookPublihser.length == 0)
        {
            errorToast("Book publisher name is required!")
        }
        else if(bookDescription.length == 0)
        {
            errorToast("Book description is required!")
        }
        else if(bookQuantity.length == 0)
        {
            errorToast("Book quantity is required!")
        }
        else if(bookCategory.length == 0)
        {
            errorToast("Book category is required!")
        }
        else if(bookSubCategory.length == 0)
        {
            errorToast("Book subcategory is required!")
        }
        else if(!bookImage)
        {
            errorToast("Book title is required!")
        }
        else
        {

            document.getElementById('modal-close').click()

            let formData = new FormData();
            formData.append('title', bookTitle)
            formData.append('author', bookAuthor)
            formData.append('publisher',bookPublihser )
            formData.append('description', bookDescription)
            formData.append('img', bookImage)
            formData.append('quantity', bookQuantity)
            formData.append('category_id', bookCategory)
            formData.append('subcategory_id', bookSubCategory)


            const config = {
                headers:{
                    'content-type':'multipart/form-data'
                }
            }

            let response = await axios.post('/book-create', formData, config)

            if(response.status == 200)
            {
                successToast("Book added successfully")
            }
            else
            {
                errorToast("Book add request failed")
            }
        }

    }
</script> --}}


<script>
    let categories = [];

    document.addEventListener('DOMContentLoaded', async () => {
        await fetchCategoriesAndSubcategories();
        setupCategoryChangeHandler();
    });

    async function fetchCategoriesAndSubcategories() {
        let response = await axios.get('/category-list');
        categories = response.data;
        populateCategoryDropdown();
    }

    function populateCategoryDropdown() {
        let bookCategory = $('#bookCategory');
        bookCategory.empty();
        categories.forEach(category => {
            let row = `<option value="${category.id}">${category.name}</option>`;
            bookCategory.append(row);
        });
    }

    function setupCategoryChangeHandler() {
        $('#bookCategory').on('change', populateSubcategoryDropdown);
    }

    function populateSubcategoryDropdown() {
        let bookCategory = $('#bookCategory').val();
        let bookSubCategory = $('#bookSubCategory');
        bookSubCategory.empty();

        let selectedCategory = categories.find(category => category.id == bookCategory);
        if (selectedCategory) {
            selectedCategory.subcategories.forEach(subcategory => {
                let row = `<option value="${subcategory.id}">${subcategory.name}</option>`;
                bookSubCategory.append(row);
            });
        }
    }

    async function Save()
    {
        let bookTitle           = document.getElementById('bookTitle').value
        let bookAuthor          = document.getElementById('bookAuthor').value
        let bookPublihser       = document.getElementById('bookPublihser').value
        let bookDescription     = document.getElementById('bookDescription').value
        let bookQuantity        = document.getElementById('bookQuantity').value
        let bookCategory        = document.getElementById('bookCategory').value
        let bookSubCategory     = document.getElementById('bookSubCategory').value
        let bookImage           = document.getElementById('bookImage').files[0]

        if(bookTitle.length == 0)
        {
            errorToast("Book title is required!")
        }
        else if(bookAuthor.length == 0)
        {
            errorToast("Book author name is required!")
        }
        else if(bookPublihser.length == 0)
        {
            errorToast("Book publisher name is required!")
        }
        else if(bookDescription.length == 0)
        {
            errorToast("Book description is required!")
        }
        else if(bookQuantity.length == 0)
        {
            errorToast("Book quantity is required!")
        }
        else if(bookCategory.length == 0)
        {
            errorToast("Book category is required!")
        }
        else if(bookSubCategory.length == 0)
        {
            errorToast("Book subcategory is required!")
        }
        else if(!bookImage)
        {
            errorToast("Book title is required!")
        }
        else
        {
            document.getElementById('modal-close').click()

            let formData = new FormData();
            formData.append('title', bookTitle)
            formData.append('author', bookAuthor)
            formData.append('publisher',bookPublihser )
            formData.append('description', bookDescription)
            formData.append('img', bookImage)
            formData.append('quantity', bookQuantity)
            formData.append('category_id', bookCategory)
            formData.append('subcategory_id', bookSubCategory)


            const config = {
                headers:{
                    'content-type':'multipart/form-data'
                }
            }

            let response = await axios.post('/book-create', formData, config)

            if(response.status == 200)
            {
                successToast("Book added successfully")
                document.getElementById('save-form').reset()
                await getList()
            }
            else
            {
                errorToast("Book add request failed")
            }
        }

    }
</script>
