<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration from</title>
</head>
<body>
    <div>
        <form action="{{route('certificate')}}" method="post">
            @csrf
            <label for="name">User Name</label>
            <input type="text" name="name" id ="name">
            <label for="course">Course Instructor</label>
            <input type="text" name="course" id="course">
            <input type="submit" name="Download">
        </form>
        
    </div>
</body>
</html>