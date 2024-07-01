<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between">
                    <div class="align-items-center col">
                        <h4>All Books</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary"/>
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getList()
    async function getList() {

        let response = await axios.get('/book-list')

        let tableData = $('#tableData')
        let tableList = $('#tableList')

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.data.forEach((item, index) => {
            let row = `<tr>
                    <td>${index + 1}</td>
                    <td><img class="w-100" alt="" src="${item['image']}"></td>
                    <td>${item['title']}</td>
                    <td>${item['author']}</td>
                    <td>${item['publisher']}</td>
                    <td>${item['description']}</td>
                    <td>${item['quantity']}</td>
                    <td>${item['category']['name']}</td>
                    <td>${item['subcategory']['name']}</td>
                    <td>
                        <button data-path="${item['image']}" data-id="${item['id']}" class="btn btn-outline-success editBtn">Edit</button>
                        <button data-path="${item['image']}" data-id="${item['id']}" class="btn btn-outline-danger deleteBtn">Delete</button>
                    </td>
                </tr>`
            tableList.append(row);
        });

        $(".editBtn").on('click', async function(){
            let id = $(this).data('id')
            let filePath = $(this).data('path')
            await FillUpdatedForm(id, filePath)
            $("#update-modal").modal("show")
        })

        $('.deleteBtn').on('click', function(){
            let id = $(this).data('id')
            let path = $(this).data('path')
            $("#deleteID").val(id)
            $("#deleteFilePath").val(path)
            $("#delete-modal").modal("show")
        })

        tableData.DataTable({
            order: [[0, 'asc']],
            lengthMenu: [5, 10, 15, 20]
        })
    }
</script>
