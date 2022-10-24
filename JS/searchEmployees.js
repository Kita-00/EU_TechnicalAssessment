document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".searchInput").forEach(InputF => {
        const tableR = InputF.closest("table").querySelectorAll("tbody tr");
        const headerC = InputF.closest("th");
        const otherHeaderC = InputF.closest("tr").querySelectorAll("th");
        const colIndex = Array.from(otherHeaderC).indexOf(headerC);
        const searchableC = Array.from(tableR)
            .map(row => row.querySelectorAll("td")[colIndex]);

        InputF.addEventListener("input",() => {
            const searchQ = InputF.value.toLowerCase();

            for(const tableC of searchableC) {
                const r = tableC.closest("tr");
                const val = tableC.textContent
                    .toLowerCase()
                    .replace(".","");

                r.style.visibility = null;

                if(val.search(searchQ) === -1) {
                    r.style.visibility = "collapse";
                }
            }
        });

    });
});     