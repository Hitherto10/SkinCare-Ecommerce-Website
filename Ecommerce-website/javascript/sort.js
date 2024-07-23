// sorting by name and price with respect to table values
// colIndex specifies index of column used 
function sortTable(colIndex) {
    // declare variables
    var table, rows, isSwitching, i, x, y, shouldSwitch;
    // retrive table element and its respective rows
    table = document.getElementById("search-table");
    isSwitching = true;
    // loop through rows and swaps them until they're in the respective order
    while (isSwitching) {
        isSwitching = false;
        rows = table.rows;
        // compare the values in specifed column of adjacent rows
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            // retrieve cells in selected column and compares values to determine correct order
            x = rows[i].getElementsByTagName("td")[colIndex];
            y = rows[i + 1].getElementsByTagName("td")[colIndex];
            
            // isNaN method checks if values are numbers
            // toLowerCase method is used to ignore case when sorting name
            // if values is string, it is compared as strings 
            if (isNaN(x.innerHTML) || isNaN(y.innerHTML)) {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            // otherwise compared numerically
            } else {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        // swap rows when needed by calling insertBefore method
        if (shouldSwitch) {
            // continues looping until no further switches needed
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            isSwitching = true;
        }
    }
}

