<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="edit-post" method="post">
        <div>
            <input type="text" name="title" id="title" placeholder="title">
        </div>

        <div>
            <textarea name="body" id="body" cols="30" rows="10" placeholder="body"></textarea>
        </div>

        <div>
            <input type="file" name="img" id="img">
        </div>

        <div>
            <select name="show-author" id="showAuthor">
                <option value="0">Anonymous</option>
                <option value="1">Username</option>
            </select>
        </div>

        <div>
            <input type="submit" value="Update" name="update-post">
        </div>
    </form>
</body>
</html>