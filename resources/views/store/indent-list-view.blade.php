<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Indent List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .date {
            text-align: right;
            font-size: 18px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .item-list li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="date">
        Date: August 28, 2024
    </div>
    <h2>Indent List</h2>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Item 1</td>
            <td>10</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Item 2</td>
            <td>5</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Item 3</td>
            <td>20</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
