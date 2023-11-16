<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/entry.css">
</head>
<body> -->
<div class="container">
 <form method="post" action="hr_payroll.php">
        <p>Enter Your Employee Id :</p>
            <input type="text" name="emp_id" required>
            <p>Enter Year :</p>
            <input type="text" name="year" required>
            <p>Enter Month :</p>
            <select name="month">
                    <option value="Jan">January</option>
                    <option value="Feb">February</option>
                    <option value="Mar">March</option>
                    <option value="Apr">April</option>
                    <option value="May">May</option>
                    <option value="Jun">June</option>
                    <option value="Jul">July</option>
                    <option value="Aug">August</option>
                    <option value="Sep">September</option>
                    <option value="Oct">October</option>
                    <option value="Nov">November</option>
                    <option value="Dec">December</option>
                </select>
            <button name="submit" type="submit">Submit</button>
        </form>
    </div>
<!-- </body>
</html> -->