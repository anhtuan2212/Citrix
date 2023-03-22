class Pagination {
    perPage = 5;
    currentPage = 1;
    lastPage = 0;

    ViewPageLink = (lastPage, active, idElement) => {
        let html = "";
        for (let index = 1; index <= lastPage; index++) {
            html += " <li class='page-item " + (index == active ? "active" : "") + "'><a style='cursor: pointer' class='page-link' id='btnRedirect'>" + (index) +
                "</a></li>";
        }
        $('#' + idElement).html(html);
    }

    Next = (OnGet) => {
        if (this.currentPage < this.lastPage) {
            this.currentPage++
            OnGet();
        } else {
            this.currentPage = 1;
            OnGet();
        }
    }

    Previous = (OnGet) => {
        if (this.currentPage > 1) {
            this.currentPage--;
            OnGet();
        } else {
            this.currentPage = this.lastPage;
            OnGet();
        }
    }

    Redirect = (index, OnGet) => {
        this.currentPage = index;
        OnGet();
    }
}

export default Pagination;