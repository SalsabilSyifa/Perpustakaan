const searchInput = document.getElementById("searchInput");
const showEntries = document.getElementById("showEntries");
const table = document.getElementById("anggotaTable");
const rows = table.querySelectorAll("tbody tr");

function filterTable() {
    let search = searchInput.value.toLowerCase();
    let limit = parseInt(showEntries.value);
    let visibleCount = 0;

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        if (text.includes(search) && visibleCount < limit) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });
}

searchInput.addEventListener("keyup", filterTable);
showEntries.addEventListener("change", filterTable);

// init
filterTable();
