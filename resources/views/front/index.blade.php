<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin zone 123</title>
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    {{--    <link href="/css/admin.css" rel="stylesheet"/>--}}
</head>
<body>
<div id="app">
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <th scope="col">Описание</th>
                <th scope="col">Изображение</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Дата</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($model as $k => $v)
                <tr>
                    <th scope="row">{{$v->id}}</th>
                    <td>{{$v->title}}</td>
                    <td>{{$v->description}}</td>
                    <td><img src="{{env('APP_URL')."/image/{$v->images()->first()->sha256}"}}" alt="..." style="width: 100px; height: 100px;"></td>
                    <td>{{$v->cost}}
                    </td>
                    <td>{{$v->created_at}}</td>
                </tr>
            @endforeach



            </tbody>
        </table>
        {{ $model->links() }}

    </div>
</div>

<script>
    function sort() {

    }
</script>




{{--<script src="/js/admin.js"></script>--}}
</body>
</html>
