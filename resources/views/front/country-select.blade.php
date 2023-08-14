<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ICARJAPAN | Country Select</title>

  <!-- css -->
  <link rel="stylesheet" href="{{asset('front/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('front/css/single.css')}}" />
  <!-- Bootsrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <!-- Bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
  <!-- Font Awesome 6.0 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
  <style>
    body,
    html {
      height: 100%;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="m-0 text-primary">Welcome To ICARJAPAN</h1>
        <p class="text-danger m-0"><strong>We Can Not Detect Your Country Please Select Your Country First.</strong></p>
        <form action="{{route('countrySelectpost')}}" method="post">
          @csrf

          <div class="col-md-12 col-12 ">
            <div class="form-group">
             
              <select name="code" class="form-control" required>
                <option value="">Select Country</option>
                @if(count($countries))
                @foreach($countries as $c)
                <option value="{{ $c->code}}">{{$c->name}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn bg-primary m-2 text-white">Select Country</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap 5.3 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- fb page js -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=425979584449354&autoLogAppEvents=1" nonce="lQcO9Eh9"></script>
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="{{ asset('front/js/jquery-ui.min.js') }}"></script>
</body>

</html>