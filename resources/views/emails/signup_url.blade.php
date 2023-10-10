<!DOCTYPE html>
<html>

<head>
    <title>{{config('app.name')}}</title>
</head>

<body>
    <p style="font-family:calibri;color:black">Hi {{$mailData['name']}}, <br /> 
      Thank you so much for your purchase of Storify {{$mailData['product_type']}} <br /> 
      Please <a href="{{$mailData['signup_url']}}" style="text-decoration: underline;">click here</a>
      <br/>
      <br/>
      <br/>
    </p>
    <p style="font-family:calibri;color:black">In case you have any questions, feel free to reach out at:
        <a href="mailto:max@maxgerstenmeyer.com" style="text-decoration: underline;">max@maxgerstenmeyer.com</a>
    </p>
    <p style="font-family:calibri;color:black">Best,
        <br /> Max from Storify
    </p>




</body>

</html>
