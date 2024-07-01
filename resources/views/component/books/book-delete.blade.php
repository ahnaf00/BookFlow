<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID"/>
                <input class="d-none" id="deleteFilePath"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="Delete()" type="button" id="confirmDelete" class="btn bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function Delete()
    {
        let deleteID = document.getElementById('deleteID').value
        let deleteFilePath = document.getElementById('deleteFilePath').value

        document.getElementById('delete-modal-close').click()

        let response = await axios.post('/book-delete', {
            id      :   deleteID,
            image   :   deleteFilePath
        })

        if(response.status == 200)
        {
            successToast("Book Deleted Successfully")
            await getList()
        }
        else
        {
            errorToast("Book delete request failed")
        }
    }
</script>
