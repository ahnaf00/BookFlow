<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Subcategory Name *</label>
                                    <input type="text" class="form-control" id="subCategoryName">
                                </div>

                                <div class="col-12 p-1">
                                    <label class="form-label">Category Description</label>
                                    <input type="text" class="form-control" id="subCategoryDescription">
                                </div>

                                <div class="col-12 p-1">
                                    <label class="form-label">Select Category</label>
                                    <select class="form-select" aria-label="Default select example" id="categoryList">
                                        <option selected>Open this select menu</option>
                                    </select>
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

<script>

    FillList()
    async function FillList()
    {
        let categoryList = $('#categoryList');

        let categoryResponse = await axios.get('/category-list')

        categoryResponse.data.forEach((item, index)=>{
            let row =`<option value="${item['id']}">${item['name']}</option>`
            categoryList.append(row)
        })
    }

    async function Save()
    {
        let subCategoryName         = document.getElementById('subCategoryName').value
        let subCategoryDescription  = document.getElementById('subCategoryDescription').value
        let categoryListID          = document.getElementById('categoryList').value

        if(subCategoryName.length == 0)
        {
            errorToast('Subcategory name is required')
        }
        else if(categoryListID.length == 0)
        {
            errorToast('Category must be selected')
        }
        else
        {
            document.getElementById('modal-close').click()

            let response = await axios.post('/subcategory-create', {
                name:subCategoryName,
                description:subCategoryDescription,
                category_id:categoryListID
            })

            if(response.status == 200)
            {
                successToast("Subcategory created successfully")
                document.getElementById('save-form').reset();
                await getList();
            }
            else
            {
                errorToast("Something went wrong")
            }
        }
    }


</script>
