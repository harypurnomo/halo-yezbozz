<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ Library::companyProfile()[0]->company_name }} - Change Password Activation</title>
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
    <h2>Please confirm your request</h2>
    <div style="margin-top:20px; margin-bottom:20px">
      <p>
        A password reset was requested for your user account, please<br>
        confirm your email address by clicking the button below :
      </p>
    </div> 
    <a class="button" href="{{ $link }}/activate-user/{{ $id }}/{{ $code }}" target="_blank"><strong style="color:white;">Change Password Activation</strong></a> 
    <div style="margin-top:20px; margin-bottom:20px">
      <p>
        Button not working? Try using this link:
      </p>
    </div> 
    <a href="{{ $link }}/activate-user/{{ $id }}/{{ $code }}" target="_blank" style="text-decoration: none;">{{ $link }}/activate-user/{{ $id }}/{{ $code }}</a>
    <p>
      If you did not make this request please contact <a href="{{ route('lang.contactus',['lang'=>'en']) }}">Support</a>.
      <br>Thanks,
      <br>{{ Library::companyProfile()[0]->company_name }} Teams.
    </p>
  </div>
</body>
</html>