<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Test Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            height: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            color: #333;
        }

        .report-details {
            margin-bottom: 20px;
        }

        .patient-info, .test-results {
            margin-bottom: 20px;
        }

        .patient-info h2, .test-results h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        footer {
            text-align: center;
        }

        footer button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        footer button:hover {
            background-color: #0056b3;
        }

        @media print {
            .print-report {
                display: none;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Medical Test Report</h1>
    </header>

    <section class="report-details">
        <div class="patient-info">
            <h2>Patient Information</h2>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Patient ID:</strong> 123456</p>
            <p><strong>Date of Birth:</strong> January 1, 1980</p>
            <p><strong>Test Date:</strong> August 24, 2024</p>
        </div>

        <div class="test-results">
            <h2>Test Results</h2>
            <table>
                <thead>
                <tr>
                    <th>Test Name</th>
                    <th>Result</th>
                    <th>Normal Range</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Hemoglobin</td>
                    <td>14.5 g/dL</td>
                    <td>13.0 - 17.0 g/dL</td>
                </tr>
                <tr>
                    <td>White Blood Cell Count</td>
                    <td>6,500 cells/µL</td>
                    <td>4,000 - 11,000 cells/µL</td>
                </tr>
                <tr>
                    <td>Blood Pressure</td>
                    <td>120/80 mmHg</td>
                    <td>90/60 - 120/80 mmHg</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <button onclick="window.print()" class="print-report">Print Report</button>
    </footer>
</div>
</body>
</html>
