<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body style="background-color:black">

    <div class="container" style="margin-top:20% ; margin-left:40%">
        <a href="{{ route('import') }}" type="button" class="btn btn-primary " >import Contact</a>
        <a href="{{ url('contact_view') }}" type="button" class="btn btn-success " >Create Contact</a>
    </div>

</body>

</html>
