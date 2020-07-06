<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>App Name -Cabinet @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
       
        </head>
    <body>
      <div class="page-wrap" id="example">
       
     <example-component2></example-component2>
        
            <p>test test</p>
          <section>
          {{-- <div class="reg_form" id="app">
            <input type="text" id="login">
            <label for="login">Введите ваш логин</label>
            <input type="text" id="password">
            <label for="password">Введите ваш пароль</label>
            <input type="text" id="name">
            <label for="name">Введите ваше имя</label>
            <input type="hidden" id="role" value="guest">
            <button id="reg">Зарегистрироваться</button>
          </div> --}}

        </section>
     <?php 
     
      ?>
        
       
          @foreach($users as $user)
          
            <div>{{$user->name}}</div>
          
        @endforeach
          testestesadsadasdasd;
        <div class="map"> ----------</div>
       
      
    
    
    
    
    </div>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->


<script>
// $( document ).ready(function() {
//     $( "#reg" ).click(function() {
//         var login = $('#login').val();
//         var password = $('#password').val();
//         var name = $('#name').val();
//         var role = $('#role').val();

// $.ajax({
// url: '{{ route('registration') }}',
// type: "POST",
// data: {login:login,
//         password: password,
//         name: name,
//         role: role
//      },
// headers: {
// 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
// },
// success: function (data) {
//     console.log(data)


// }
// });
// });
// });

</script>
<script src="{{ mix('js/app.js') }}"></script>
