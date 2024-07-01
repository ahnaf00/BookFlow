<section class="pt-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Book</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loaned On</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                                <!-- Rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        bookingList();
    });

    async function bookingList() {
        let tableList = document.getElementById('tableList');
        try {
            let response = await axios.get('/booking-list');
            let data = response.data.data;

            tableList.innerHTML = '';  // Clear existing rows

            data.forEach((item, index) => {
                let statusBadgeClass = '';
                switch (item['status']) {
                    case 'pending':
                        statusBadgeClass = 'badge-warning';
                        break;
                    case 'lent':
                        statusBadgeClass = 'badge-success';
                        break;
                    case 'returned':
                        statusBadgeClass = 'badge-primary';
                        break;
                    case 'overdue':
                        statusBadgeClass = 'badge-danger';
                        break;
                    default:
                        statusBadgeClass = 'badge-secondary';
                        break;
                }
                let row = `
                    <tr>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${index + 1}</p>
                        </td>
                        <td>
                            <p class="text-xs text-center font-weight-bold mb-0">${item['book']['title']}</p>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">${item['book']['author']}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm ${statusBadgeClass}">${item['status']}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bold">${item['quantity']}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">${item['loaned_on'] ? item['loaned_on'] : 'N/A'}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">${item['due_date'] ? item['due_date'] : 'N/A'}</span>
                        </td>
                    </tr>
                `;
                tableList.innerHTML += row;
            });
        } catch (error) {
            console.error('Error fetching booking list:', error);
        }
    }
</script>
