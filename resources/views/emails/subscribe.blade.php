<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ Library::companyProfile()[0]->company_name }} - Email Subscription Request</title>
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
        @if($lang=='id')
        <div style="margin-top:20px; margin-bottom:20px">
          <p>
            Permintaan Berlangganan. <br>
            Terima kasih atas permintaan Anda. 
            <br>{{ Library::companyProfile()[0]->company_name }} Tim.
          </p>
        </div> 
        @else
        <div style="margin-top:20px; margin-bottom:20px">
          <p>
            Email Subscription Request. <br>
            Thank you for your request.  
            <br>{{ Library::companyProfile()[0]->company_name }} Teams.
          </p>
        </div>
        @endif
    </div>
</body>
</html>