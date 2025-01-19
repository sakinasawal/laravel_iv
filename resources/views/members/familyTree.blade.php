<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Tree</title>
    <style>
        /* Simple styling for the family tree */
        .family-tree ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .family-tree li {
            margin: 10px 0;
            padding-left: 20px;
            position: relative;
        }

        .family-tree li::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #000;
        }
    </style>
</head>
<body>

<h1>Family Tree</h1>

</body>
</html>
