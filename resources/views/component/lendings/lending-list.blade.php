<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between">
                    <div class="align-items-center col">
                        <h4>Lendings</h4>
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
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Loaned On</th>
                                <th>Due Date</th>
                                <th>Book</th>
                                <th>Author</th>
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

        let response = await axios.get('/lending-list')

        let tableData = $('#tableData')
        let tableList = $('#tableList')

        tableData.DataTable().destroy();
        tableList.empty();

        response.data.data.forEach((item, index) => {
            let loanedOn = item['loaned_on'] ? new Date(item['loaned_on']).toLocaleDateString() : 'N/A';
            let dueDate = item['due_date'] ? new Date(item['due_date']).toLocaleDateString() : 'N/A';

            let userFirstName = item['user'] && item['user']['first_name'] ? item['user']['first_name'] : 'N/A';
            let bookTitle = item['book'] && item['book']['title'] ? item['book']['title'] : 'N/A';
            let bookAuthor = item['book'] && item['book']['author'] ? item['book']['author'] : 'N/A';

            let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${userFirstName}</td>
                    <td>${item['status']}</td>
                    <td>${loanedOn}</td>
                    <td>${dueDate}</td>
                    <td>${bookTitle}</td>
                    <td>${bookAuthor}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn btn-outline-success lendingEditBtn">Edit</button>
                        <button data-id="${item['id']}" class="btn btn-outline-danger lendingDeleteBtn">Delete</button>
                    </td>
                </tr>`;
            tableList.append(row);
        });

        $('.lendingEditBtn').on('click', async function () {
            let id = $(this).data('id');
            await FillUpdatedLendingForm(id)
            $("#lending-update-modal").modal("show")
        })

        $('.lendingDeleteBtn').on('click', function () {
            let id = $(this).data('id');
            $("#lending-delete-modal").modal("show")
            $("#deleteID").val(id)
        })

        tableData.DataTable({
            order: [[0, 'asc']],
            lengthMenu: [5, 10, 15, 20]
        })
    }
</script>
