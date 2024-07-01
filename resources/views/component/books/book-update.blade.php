<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">Book Title *</label>
                                <input type="text" class="form-control" id="updateBookTitle">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" id="updateBookAuthor">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Publisher</label>
                                <input type="text" class="form-control" id="updateBookPublisher">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Quantity</label>
                                <input type="text" class="form-control" id="updateBookQuantity">
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Select Category</label>
                                <select class="form-select" aria-label="Default select example" id="updateBookCategory">
                                    <option selected>Open this select menu</option>
                                </select>
                            </div>
                            <div class="col-6 p-1">
                                <label class="form-label">Select SubCategory</label>
                                <select class="form-select" aria-label="Default select example" id="updateBookSubCategory">
                                    <option selected>Open this select menu</option>
                                </select>
                            </div>

                            <div class="col-6 p-1">
                                <label class="form-label">Description</label>
                                {{-- <input type="text" class="form-control" id="updateBookDescription"> --}}
                                <textarea class="form-control" name="updateBookDescription" id="updateBookDescription" rows="3"></textarea>
                            </div>

                            <div class="col-6 my-2">
                                <label class="form-label my-2">Image</label><br>
                                <img class="w-50 my-3" id="oldImg" src="{{asset('images/default.jpg')}}" />
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="updateBookImage">
                            </div>
                            <input type="text" class="d-none" id="updateID">
                            <input type="text" class="d-none" id="filePath">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>



<script>
    async function FillUpdatedForm(id, filePath)
    {
        document.getElementById('updateID').value   = id
        document.getElementById('filePath').value   = filePath
        document.getElementById('oldImg').src       = filePath

        let response = await axios.post('/book-by-id', {
            id:id
        })


        document.getElementById('updateBookTitle').value          = response.data.data['title']
        document.getElementById('updateBookAuthor').value         = response.data.data['author']
        document.getElementById('updateBookPublisher').value      = response.data.data['publisher']
        document.getElementById('updateBookDescription').value    = response.data.data['description']
        document.getElementById('updateBookQuantity').value       = response.data.data['quantity']

        await fetchCategories(response.data.data['category_id']);
        await fetchSubcategories(response.data.data['category_id'], response.data.data['subcategory_id']);
    }

    async function fetchCategories(selectedCategoryId = null) {
        let updateBookCategory = $('#updateBookCategory');
        updateBookCategory.empty();

        let categoryResponse = await axios.get('/category-list');

        categoryResponse.data.forEach((item) => {
            let row = `<option value="${item['id']}">${item['name']}</option>`;
            updateBookCategory.append(row);
        });

        if (selectedCategoryId) {
            updateBookCategory.val(selectedCategoryId);
        }

        updateBookCategory.on('change', async () => {
            await fetchSubcategories(updateBookCategory.val());
        });
    }

    async function fetchSubcategories(categoryId, selectedSubcategoryId = null) {
        let updateBookSubCategory = $('#updateBookSubCategory');
        updateBookSubCategory.empty();

        if (categoryId) {
            let response = await axios.post('/category-by-id',{ id: categoryId });

            if (response.data.msg === "success") {
                response.data.data.subcategories.forEach((item) => {
                    let row = `<option value="${item['id']}">${item['name']}</option>`;
                    updateBookSubCategory.append(row);
                });

                if (selectedSubcategoryId) {
                    updateBookSubCategory.val(selectedSubcategoryId);
                }
            }
        }
    }

    async function Update() {
        let updateID                = document.getElementById('updateID').value
        let updateBookTitle         = document.getElementById('updateBookTitle').value;
        let updateBookAuthor        = document.getElementById('updateBookAuthor').value;
        let updateBookPublisher     = document.getElementById('updateBookPublisher').value;
        let updateBookDescription   = document.getElementById('updateBookDescription').value;
        let updateBookQuantity      = document.getElementById('updateBookQuantity').value;
        let updateBookCategory      = document.getElementById('updateBookCategory').value;
        let updateBookSubCategory   = document.getElementById('updateBookSubCategory').value;
        let updateBookImage         = document.getElementById('updateBookImage').files[0];

        if (updateBookTitle.length == 0) {
            errorToast("Book title is required!");
        } else if (updateBookAuthor.length == 0) {
            errorToast("Book author name is required!");
        } else if (updateBookPublisher.length == 0) {
            errorToast("Book publisher name is required!");
        } else if (updateBookDescription.length == 0) {
            errorToast("Book description is required!");
        } else if (updateBookQuantity.length == 0) {
            errorToast("Book quantity is required!");
        } else if (updateBookCategory.length == 0) {
            errorToast("Book category is required!");
        } else if (updateBookSubCategory.length == 0) {
            errorToast("Book subcategory is required!");
        } else if (!updateBookImage) {
            errorToast("Book image is required!");
        } else {
            document.getElementById('update-modal-close').click();

            let updateFormData = new FormData();
            updateFormData.append('id', updateID);
            updateFormData.append('title', updateBookTitle);
            updateFormData.append('author', updateBookAuthor);
            updateFormData.append('publisher', updateBookPublisher);
            updateFormData.append('description', updateBookDescription);
            updateFormData.append('img', updateBookImage);
            updateFormData.append('quantity', updateBookQuantity);
            updateFormData.append('category_id', updateBookCategory);
            updateFormData.append('subcategory_id', updateBookSubCategory);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };

            let response = await axios.post('/book-update', updateFormData, config);

            if (response.status == 200) {
                successToast("Book updated successfully");
                document.getElementById("update-form").reset();
                await getList();
            } else {
                errorToast("Book update request failed");
            }
        }
    }
</script>
