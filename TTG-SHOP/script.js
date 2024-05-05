function sortTable(tableId, columnIndex, th) {
    if(th.classList.contains("desc"))
        var ascending = true;
    else if(th.classList.contains("asc"))
        var ascending = false;
    else
        var ascending = true;
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById(tableId);
    switching = true;

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("td")[columnIndex];
            y = rows[i + 1].getElementsByTagName("td")[columnIndex];

            if (ascending) {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
    var headers = table.getElementsByTagName("th");
    for (var j = 0; j < headers.length; j++) {
        if (headers[j] != th) {
            headers[j].classList.remove("asc", "desc");
        }
    }

    th.classList.remove("asc", "desc");
    if(ascending === true)
        th.classList.add("asc");
    else
        th.classList.add("desc");
}
