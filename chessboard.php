<html>
<head>
    <title>Chess</title>
</head>
<body>
<table width="300">
    <?php
    for ($row = 0; $row < 8; $row++) {
        echo "<tr>";
        for ($cols = 0; $cols < 8; $cols++) {
            if (($row + $cols) % 2 == 0) {
                echo "<td height=35px width=35px bgcolor=white></td>";
            } else {
                echo "<td height=35px width=35px bgcolor=black></td>";
            }
        }
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>