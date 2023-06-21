<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ Library::companyProfile()[0]->company_name }} - Broadcast</title>
  <style>
  body{
    background-color: #ffffff !important;
  }
  .wrap-box{
    border : 1px solid #CCCCCC;
    border-radius: 10px;
    padding: 20px;
    background-color: #ffffff;
  }
  .button {
    background-color: #A87D57;
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
      {{-- <img src="{{ url('uploads/logo') }}/{{ Library::companyProfile()[0]->logo }}" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive m-bottom-20"> --}}
      {{-- <img src="https://halo.yezbozz.id/uploads/logo/1667223693pt-yezbozz-inovasi-digital.png" alt="{{ Library::companyProfile()[0]->company_name }} Logo" width="100" class="img-responsive m-bottom-20"> --}}
          {{-- <h2>Hello, {{ $row['name'] }}</h2> --}}
          <div style="margin-top:20px; margin-bottom:20px">
            <p>
              {!! $row['message'] !!}
              {{-- <br>Thanks,
              <br>{{ Library::companyProfile()[0]->company_name }} Teams. --}}
              <br><br><br>Harga termurah dan penjual terpercaya hanya di www.tokopedia.com/yezbozz
              <br>---------------
              <br>"Sahabat Para Pedagang" "Pasti Ada Diskon Diantara KITA"
              <br>www.tokopedia.com/yezbozz/etalase/discount
              <br>---------------
              <br>Untuk yang masih penasaran ada apa aja sih,
              <br>klik link dibawah ini ya. 🔽
              <br>✨Website : yezbozz.id
              <br>✨Tokopedia : www.tokopedia.com/yezbozz
              <br>✨Facebook : www.facebook.com/yezbozz.id
              <br>✨Instagram : www.instagram.com/yezbozz.oss/
              <br>---------------
              <br>😍Belanja makin murah makin mudah geys. Happy
              shopping kakak😍
            </p>
          </div> 
    </div>
</body>
</html>