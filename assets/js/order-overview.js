function addTable(response) {
    var myTableDiv = document.getElementById("order-overview-table");
    myTableDiv.innerHTML = "";

    var table = document.createElement('TABLE');

    var tableHead = document.createElement('THEAD');
    table.appendChild(tableHead); //is this right?

    var tableRow = document.createElement('TR');
    tableHead.appendChild(tableRow);

    for (var responseKey in response[0]) {
        var th = document.createElement('TH');
        th.textContent = responseKey;
        tableRow.appendChild(th);
    }

    //header done

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody); // to tableBody or TableHead?

    for (var i = 0; i < response.length; i++) {

        var tableRow = document.createElement('TR');
        tableBody.appendChild(tableRow);

    for (var responseKey in response[1]) {
        var td = document.createElement('TD');
        td.textContent = responseKey;
        tableRow.appendChild(td);
    }
    }

   


    for (var i = 0; i < response.length; i++) {
    var tr = document.createElement('TR');
    tableBody.appendChild(tr);

    for ( var j = 0; j < response.data[i].length; j++) {

    var td = document.createElement("td");

    var div1 = document.createElement("div");
    div1.textContent = response.data[i][j] ?? "";

    var div2 = document.createElement("div");
    div2.textContent = "placeholder";

    td.appendChild(div1);
    td.appendChild(div2);
        
        tr.appendChild(td);
        }
    }
    myTableDiv.appendChild(table);
}

function renderTable() {  //POST not neccesary, no error handling.
    fetch("order-overview.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
        })
    })
    .then(response => response.json())
    .then(addTable)
}

renderTable();