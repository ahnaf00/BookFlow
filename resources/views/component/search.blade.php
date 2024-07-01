<div class="container">
    <div class="row bg-white shadow mt-n5 border-radius-lg pb-4 p-3 position-relative w-75 mx-auto">
        <div class="col-lg-8">
            {{-- <label>Search</label> --}}
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input class="form-control" id="search" placeholder="Search by book title , author or publisher" type="text">
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-center mt-lg-auto mt-2">
            <button type="button" onclick="getSearchResult()" class="btn bg-gradient-primary w-100 mb-0">Search</button>
        </div>
    </div>
</div>


<div class="container mt-4" id="searchResultsContainer">
    <div class="row" id="searchResults"></div>
</div>


<script>

    async function getSearchResult()
    {
        let word = document.getElementById('search').value.trim()
        let searchResultsContainer = document.getElementById('searchResults');

        if (word === '') {
            document.getElementById('searchResultsContainer').innerHTML = '';
            return; // Exit function early
        }

        // Clear previous search results
        searchResultsContainer.innerHTML = '';

        try {
            let response = await axios.post(`/search/${word}`);

            if (response.status == 200) {
                response.data.forEach((item) => {
                    searchResultsContainer.innerHTML += `
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
                });
            } else {
                searchResultsContainer.innerHTML = '<p>No results found.</p>';
            }
        } catch (error) {
            console.error('Error fetching search results:', error);
            searchResultsContainer.innerHTML = '<p>Failed to fetch search results.</p>';
        }
    }

    // getCleared()
    // function getCleared()
    // {
    //     let word = document.getElementById('search').value.trim();
    //     if (word.length == 0) {
    //         document.getElementById('searchResultsContainer').innerHTML = '';
    //         return; // Exit function early
    //     }
    // }

</script>
{{-- <h3 class="text-center mt-4">Search Results</h3> --}}
