<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    $month = $input["month"];
    $year = $input["year"];
    $dateString = $year . "-" . $month;
    $firstDay = (new DateTime($dateString))->format("w");
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $response = [
    "success" => true,
    "month" => $month,
    "year" => $year,
    "data" => []
    ];
    $dayCount = 1;
    $week = [];

    for ($i = 1; $i <= 7; $i++) {
        if ($i < $firstDay) {
            $week[] = null;
        } else {
            $week[] = $dayCount;
            $dayCount++;
        }
    }
    $response["data"][] = $week;

    while ($dayCount <= $daysInMonth) {
        $week = [];
        for ($i = 1; $i <= 7; $i++) {
            if ($dayCount <= $daysInMonth) {
                $week[] = $dayCount;
                $dayCount++;
            } else {
                $week[] = null;
            }
        }
        $response["data"][] = $week;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="calendar.css?v=1">
</head>
<body>
    <header>
        <H1>Calendar</H1>
    </header>
    <main>
        <div class="dateselector">
            <button id="previousMonth"></button>
            <div id="month">
                <p></p>
            </div>
            <button id="nextMonth"></button>
        </div>
        <div id="calendar"></div>
    </main>
</body>
</html>

<script>
    const d = new Date();
    let currentMonth = d.getMonth();
    let currentYear = d.getFullYear();
    const months = [
    "januari", "februari", "maart", "april",
    "mei", "juni", "juli", "augustus",
    "september", "oktober", "november", "december"
    ];
    function renderName() {
        let monthName = months[currentMonth];
        let yearNumber = currentYear;
        document.getElementById("month").innerHTML = `${monthName} ${yearNumber}`;
    }

    document.getElementById("previousMonth").addEventListener("click", previousMonth);
    function previousMonth() {
    currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
    renderCalendar();
}

    document.getElementById("nextMonth").addEventListener("click", nextMonth);
     function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
    renderCalendar();
}

    function addTable(response) {
    var myTableDiv = document.getElementById("calendar");
    myTableDiv.innerHTML = "";

    var table = document.createElement('TABLE');

    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);

    for (var i = 0; i < response.data.length; i++) {
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

function renderCalendar() {
    renderName();

    fetch("index.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            month: currentMonth +1,
            year: currentYear
        })
    })
    .then(response => response.json())
    .then(addTable)
}

renderCalendar();
</script>