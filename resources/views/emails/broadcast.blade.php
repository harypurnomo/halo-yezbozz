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
  h1, h2, h3, h4, h5, h6{
    font-family: Arial, Helvetica, sans-serif;
  }
  h1, h2, h3, h4, h5, h6{
    display: block;
  }
  .wrap-box{
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
          <div style="margin-top:20px; margin-bottom:20px">
            <h3>Halo Kakak {{ $row['name'] }}, <br> Cobain deh, Belanja Sayur Online dengan penjual terpercaya di <a href="https://www.tokopedia.com/yezbozz" target="_blank">tokopedia.com/yezbozz</a></h3>
            <p>
              {!! $row['message'] !!}
              {{-- <br>Thanks,
              <br>{{ Library::companyProfile()[0]->company_name }} Teams. --}}
              <h3 style="margin: 10px 0px;">"YEZBOZZ Sahabat Para Pedagang" "Pasti Ada Diskon Diantara KITA"</h3>
              <h3 style="margin: 10px 0px;">Klik <a href="https://www.tokopedia.com/yezbozz/etalase/discount">disini</a></h3>
              ---------------
              <h3 style="margin: 10px 0px;">Ikuti Sosial Media Kami, Agar Kamu Dapat Info Harga Sayuran TERKINI</h3>
              <h3 style="margin: 10px 0px;">klik link dibawah ini ya. 🔽</h3>
              <h3><a href="https://www.tokopedia.com/yezbozz" target="_blank">✨Tokped : tokopedia.com/yezbozz</a></h3>
              <h3><a href="https://www.facebook.com/yezbozz.id" target="_blank">✨Facebook : facebook.com/yezbozz.id</a></h3>
              <h3><a href="https://www.instagram.com/yezbozz.oss/" target="_blank">✨Instagram : instagram.com/yezbozz.oss/</a></h3>
              <h3><a href="https://yezbozz.id/" target="_blank">✨Website : yezbozz.id</a></h3>
              <h3>😍Belanja makin murah makin mudah. Happy
                shopping kakak😍</h3>
            </p>
            <div>
              <a href="https://forms.gle/8Rsu57NwfwPEMifz9" target="_blank" style="color: grey;">Manage your email preferences or unsubscribe</a> 
            </div>
          </div> 
    </div>
</body>
</html>