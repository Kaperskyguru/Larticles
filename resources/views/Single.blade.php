<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script  >window.laravel = { csrfToken: '{{csrf_token()}}' }</script>
        <title>Larticles App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
        
    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
                <div class="container">
                    <a href="#" class="navbar-brand">Larticles</a>
                </div>
        </nav>
        <div class="card card-body mb-2">
            <h3>{{ $data['articles']->title }}</h3>
            <p>{{ $data['articles']->body }}</p>
            <hr>
            <br>
            
            <h3> Comments </h3>
            <form action="{{ url('/api/comment') }}" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" class="" name="title" placeholder="Enter name">
                    <input class="form-control" type="hidden" value="{{$data['articles']->id}}" name="article_id">
                </div>
                    <br />
                <div class="form-group">
                    <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"  name="" id="">Comment</button>
                </div>
            </form>
 
            <div class="container">
            @foreach($data['comments'] as $comment)
                <div class="jumbotron">
                    <h3>{{ $comment->title }}</h3>
                    <p>{{ $comment->body }}</p>
                </div>
            @endforeach
            </div>
        </div>
    </body>
</html>