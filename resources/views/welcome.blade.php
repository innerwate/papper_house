<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Laravel</title>

      

    </head>
    <body>
        <div class="page-wrap" id="example">
       
            <example-component2></example-component2>
               
                 
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
            
               
              
                 {{-- @foreach($users as $user)
                 
                   <div>{{$user->name}}</div>
                 
               @endforeach --}}
                
              
              
             
           
           
           
           
           </div>



        <script src="{{ mix('js/app.js') }}"></script>
        {{-- <script>
            $( document ).ready(function() {
                $( "#reg" ).click(function() {
                    var login = $('#login').val();
                    var password = $('#password').val();
                    var name = $('#name').val();
                    var role = $('#role').val();
            
            $.ajax({
            url: '{{ route('registration') }}',
            type: "POST",
            data: {login:login,
                    password: password,
                    name: name,
                    role: role
                 },
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data)
            
            
            }
            });
            });
            });
            
            </script> --}}
    </body>
</html>
