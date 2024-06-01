<!-- Created by: Nurul 'Iffah binti Che Ismail -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kira Elektrik</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Penggunaan Elektrik Calculator</h1>
        <form method="post" action="">
            <!-- User Input -->
            <div class="form-group">
                <label for="voltage">Voltage (V)</label>
                <input type="number" step="any" class="form-control" id="voltage" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A)</label>
                <input type="number" step="any" class="form-control" id="current" name="current" required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (sen/kWh)</label>
                <input type="number" step="any" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Declare variables
            $voltage = $_POST['voltage'];
            $current = $_POST['current'];
            $rate = $_POST['rate'];

            // Kira kuasa dalam kW
            $power = ($voltage * $current) / 1000;

            // Untuk display result dlm array
            $results = [];

            // Kira penggunaan tenaga dan kos keseluruhan untuk setiap jam dalam 24 jam,
            for ($hour = 1; $hour <= 24; $hour++) {
                // Formula
                $energy = $power * $hour;
                $totalCost = $energy * ($rate / 100);
                $results[] = ['hour' => $hour, 'energy' => $energy, 'total' => $totalCost];
            }

            echo "<div class='mt-4'>";
            // Display POWER and RATE
            echo "<h4>Power: " . number_format($power, 5) . " kW</h4>";
            echo "<h4>Rate: " . number_format($rate / 100, 4) . " RM</h4>";
            echo "<table class='table table-bordered'>";
            // Table - Heading
            echo "<thead><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>TOTAL (RM)</th></tr></thead><tbody>";
            foreach ($results as $result) {
                // Table - No | Hour | Energy(kWh) | Total(RM)
                echo "<tr><td>{$result['hour']}</td><td>{$result['hour']}</td><td>" . number_format($result['energy'], 5) . "</td><td>" . number_format($result['total'], 2) . "</td></tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>