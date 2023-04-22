<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="{{route('createShop')}}" method="post">
            <input type="text" name="brand" placeholder="brand" value="nokia"><br>
            <input type="text" name="description" placeholder="description" value="nokia"><br>
            <input type="text" name="facebook_account" placeholder="facebook_account" value="nokia"><br>
            <input type="text" name="instagram_account" placeholder="instagram_account" value="nokia"><br>
            <input type="text" name="youtube_channel" placeholder="youtube_channel" value="nokia"><br>
            <button type="submit">create</button>
        </form>
    </div>
</body>
</html>