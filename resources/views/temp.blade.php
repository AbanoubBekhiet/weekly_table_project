<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortableJS Example</title>
    <style>
        ul {
            list-style-type: none;
            padding: 0;
            width: 300px;
        }
        li {
            padding: 10px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            cursor: grab;
            text-align: center;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>Drag & Drop List</h2>
<ul id="sortable-list">
    <li>Item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
    <li>Item 4</li>
    <li>Item 5</li>
</ul>

<script>
    new Sortable(document.getElementById('sortable-list'), {
        animation: 150,
        ghostClass: 'blue-background'
    });
</script>

</body>
</html>
