<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Lending</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-6 p-1">
                                <label class="form-label">User Name *</label>
                                <input type="text" class="form-control" id="lendingUserNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>

                            <div class="col-6 p-1">
                                <label class="form-label">Status *</label>
                                <select class="form-select" aria-label="Default select example" id="lendingStatusUpdate">
                                    <option value="pending">Pending</option>
                                    <option value="lent">Lent</option>
                                    <option value="returned">Returned</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                            </div>

                            <div class="col-6 p-1">
                                <label class="form-label">Due Date *</label>
                                <input type="text" class="form-control" id="lendingDueDateUpdate">
                            </div>

                            <div class="col-6 p-1">
                                <label class="form-label">Book *</label>
                                <select class="form-select" aria-label="Default select example" id="lendingBookUpdate">
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
    $( function() {
        $( "#lendingDueDateUpdate" ).datepicker();
    } );
    async function FillUpdatedForm(id)
    {
        document.getElementById('updateID').value   = id

        let response = await axios.post('/getlanding-by-id', {
            landing_id:id
        })


        document.getElementById('lendingUserNameUpdate').value          = response.data.data['user']['first_name']
        // document.getElementById('lendingStatusUpdate').value            = response.data.data['status']
        document.getElementById('lendingDueDateUpdate').value           = response.data.data['due_date']

        await fetchBooks(response.data.data['book']['id']);
    }

    async function fetchBooks(selectedBookId = null) {
        let lendingBookUpdate = $('#lendingBookUpdate');
        lendingBookUpdate.empty();

        let booksResponse = await axios.get('/book-list');

        booksResponse.data.data.forEach((item) => {
            let row = `<option value="${item.id}">${item.title}</option>`;
            lendingBookUpdate.append(row);
        });

        if (selectedBookId) {
            lendingBookUpdate.val(selectedBookId);
        }
    }


    async function Update() {
        let id                      = document.getElementById('updateID').value;
        let lendingStatusUpdate     = document.getElementById('lendingStatusUpdate').value;
        let lendingDueDateUpdate    = document.getElementById('lendingDueDateUpdate').value;
        let lendingBookUpdateID     = document.getElementById('lendingBookUpdate').value

        if (!lendingStatusUpdate || !lendingDueDateUpdate || !lendingBookUpdateID) {
            errorToast("Please fill all required fields!");
            return;
        }
        else
        {
            document.getElementById('update-modal-close').click();

            let response = await axios.post('/landings-update', {
                landing_id: id,
                book_id: lendingBookUpdateID,
                status: lendingStatusUpdate,
                due_date: lendingDueDateUpdate
            });

            if (response.status == 200) {
                successToast("Lending updated successfully!");
                document.getElementById("update-form").reset();
                await getList();

            } else {
                alert("Failed to update lending!");
            }
        }
    }
</script>
