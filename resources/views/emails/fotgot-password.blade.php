<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ Library::companyProfile()[0]->company_name }} - Reset Password</title>
  <style>
  .wrap-box{
    border : 1px solid #CCCCCC;
    border-radius: 10px;
    padding: 20px;
  }
  .button {
    background-color: #222222;
    border-radius: 15px;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }
</style>
</head>
<body>
  <div class="wrap-box" style="width:90%; text-align:center">
    <img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive m-bottom-20">
    <h2>Reset Password</h2>
    <div style="margin-top:20px; margin-bottom:20px">
      <p>
        We heard that you lost your password. Sorry about that! <br>
        But don’t worry! You can use the following link to reset your password :
      </p>
    </div> 
    <a class="button" href="{{ route('reset.password.form',['lang'=>$lang,'id'=>$id,'token'=>$token]) }}" target="_blank"><strong style="color:white;">Reset Password</strong></a> 
    <p>
      If you don’t use this link within 3 hours, it will expire. <br>
      To get a new password reset link, visit {{ url('/') }}
      <br>Thanks,
      <br>{{ Library::companyProfile()[0]->company_name }} Teams.
    </p>
  </div>
</body>
</html>