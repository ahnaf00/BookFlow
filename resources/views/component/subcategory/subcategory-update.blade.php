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
                            <div class="col-12 p-1">
                                <label class="form-label">Subcategory Name *</label>
                                <input type="text" class="form-control" id="subCategoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Subcategory Description</label>
                                <input type="text" class="form-control" id="subCategoryDescriptionUpdate">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Select Category</label>
                                <select class="form-select" aria-label="Default select example" id="updateCategoryList">
                                    <option selected>Open this select menu</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>

    async function FillUpdatedForm(id)
    {
        document.getElementById('updateID').value = id

        let response = await axios.post('/subcategory-by-id', {
            id:id
        })

        document.getElementById('subCategoryNameUpdate').value = response.data.data['name']
        document.getElementById('subCategoryDescriptionUpdate').value = response.data.data['description']

        categoryId = response.data.data['category_id'];
        FillList(categoryId)

    }
    FillList();
    async function FillList(categoryId = null)
    {
        let updateCategoryList = $('#updateCategoryList');
        updateCategoryList.empty();

        let categoryList = await axios.get('/category-list')

        categoryList.data.forEach((item, index)=>{
            let isSelected = item['id'] === categoryId ? 'selected' : '';
            let row =`<option value="${item['id']}" ${isSelected}>${item['name']}</option>`
            updateCategoryList.append(row)
        })
    }

    async function Update()
    {
        let id = document.getElementById('updateID').value
        let subCategoryNameUpdate = document.getElementById('subCategoryNameUpdate').value
        let subCategoryDescriptionUpdate = document.getElementById('subCategoryDescriptionUpdate').value
        let updateCategoryListID = document.getElementById('updateCategoryList').value

        if(id.length == 0)
        {
            errorToast("Id is required")
        }
        else if(subCategoryNameUpdate.length == 0)
        {
            errorToast("Subactegory name is required")
        }
        else if(updateCategoryListID.length == 0)
        {
            errorToast("Category Id is required")
        }
        else
        {
            document.getElementById('update-modal-close').click()
            let response = await axios.post('/subcategory-update',{
                id:id,
                name:subCategoryNameUpdate,
                description:subCategoryDescriptionUpdate,
                category_id:updateCategoryListID
            })

            if(response.status == 200)
            {
                document.getElementById('update-form').reset()
                successToast("Subcategory updated successfull")
                await getList()
            }
            else
            {
                errorToast("Something went wrong")
            }
        }
    }


</script>
