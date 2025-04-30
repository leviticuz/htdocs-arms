document.addEventListener("DOMContentLoaded", function () {
    // 🔍 Search button click event
    document.body.addEventListener("click", function (event) {
        if (event.target.id === "searchButton") {
            searchPersonnel();
        }

        // 🧩 Dynamic modal loader trigger
        if (event.target.matches('[data-bs-target="#addPersonnelModal"]')) {
            const modal = document.getElementById("addPersonnelModal");
            const modalContent = document.getElementById("modalContent");

            if (!modal || !modalContent) return;

            // Show spinner while loading
            modalContent.innerHTML = `
                <div class="modal-body text-center p-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Loading form...</p>
                </div>
            `;

            fetch("../pages/modals/personnel_form.php")
                .then(response => {
                    if (!response.ok) throw new Error("Failed to load modal content");
                    return response.text();
                })
                .then(html => {
                    modalContent.innerHTML = html;
                })
                .catch(err => {
                    modalContent.innerHTML = `<div class="modal-body text-danger text-center">Error loading content.</div>`;
                    console.error(err);
                });
        }
    });

    // ⌨️ Search input "Enter" key event
    document.body.addEventListener("keypress", function (event) {
        if (event.target.id === "searchInput" && event.key === "Enter") {
            searchPersonnel();
        }
    });

    function searchPersonnel() {
        const searchInput = document.getElementById("searchInput")?.value.toLowerCase();
        const tableBody = document.getElementById("tableBody");
        if (!tableBody) return;

        const rows = tableBody.getElementsByTagName("tr");

        for (let row of rows) {
            const nameCell = row.getElementsByTagName("td")[2];
            const afpsnCell = row.getElementsByTagName("td")[1];

            if (nameCell && afpsnCell) {
                const nameText = nameCell.textContent.toLowerCase();
                const afpsnText = afpsnCell.textContent.toLowerCase();
                row.style.display = (nameText.includes(searchInput) || afpsnText.includes(searchInput)) ? "" : "none";
            }
        }
    }

    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const modal = new bootstrap.Modal(document.getElementById('personnelDetailsModal'));
            fetch(`modals/personnel_details.php?id=${id}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('personnelDetailsContent').innerHTML = html;
                    modal.show();
                })
                .catch(err => {
                    document.getElementById('personnelDetailsContent').innerHTML = "<div class='modal-body text-danger'>Error loading details.</div>";
                    modal.show();
                });
        });
    });
});
