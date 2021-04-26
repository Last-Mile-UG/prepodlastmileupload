<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/site/css/main.css') }}">
  <title>{{__('msg.orderFailed')}}</title>
</head>
<body>
  <div class="order-response__page">
    <img src="{{asset('assets/site/img/logo.png')}}" alt="" class="img-fluid">
    <h3>
      {{__('msg.orderFailed')}}
    </h3>
    <p>{{__('msg.orderFailedMessage')}}</p>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(() => {
      setTimeout(() => {
        login = `{{auth()->check()}}`
        window.location.replace('/cart');
      }, 3000)
    })
  </script>
</body>
</html>
