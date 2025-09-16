  <?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);


  $init = parse_ini_file("satusehat.ini");
  $client_id = $init["client_id"];
  $client_secret = $init["client_secret"];
  $auth_url = $init["auth_url"];
  $api_url = $init["api_url"];
  $environment = $init["environment"];

  include('auth.php');
  include('function.php');

  // nama petugas/operator Fasilitas Pelayanan Kesehatan (Fasyankes) yang akan melakukan validasi
  $agent_name = 'RSD Kalisat Jember';

  // NIK petugas/operator Fasilitas Pelayanan Kesehatan (Fasyankes) yang akan melakukan validasi
  $agent_nik ='100026014';

  // auth to satusehat
  $auth_result = authenticateWithOAuth2($client_id, $client_secret, $auth_url);

  // Example usage
  $json = generateUrl($agent_name, $agent_nik , $auth_result, $api_url, $environment);

  $validation_web = json_decode($json, TRUE);

  ?><html>
  <head>
    <script type="text/javascript">

      const url = "<?php echo $validation_web["data"]["url"]?>"

      function loadFormPopup() {
        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=100,top=100`;
        window.open(url,"KYC",params)
      }

      function loadFormNewTab() {
        window.open(url,"_blank")
      }

    </script>
  </head>
  <!-- <body>
    <button onclick="loadFormPopup()">KYC Pasien Popup</button>
    <button onclick="loadFormNewTab()">KYC Pasien New Tab</button>
  </body> -->
  </html>

  <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Satu Sehat - RSD Kalisat Jember</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a936f 0%, #2ecc71 100%);
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 500px;
            text-align: center;
            padding: 40px 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #2ecc71, #1a936f, #3498db);
        }
        
        .header {
            margin-bottom: 30px;
        }
        
        .logo {
            width: 150px;
            height: 150px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 5px solid #f8f9fa;
        }
        
        .logo img {
            width: 60%;
            height: 70%;
            object-fit: cover;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 700;
            font-size: 28px;
        }
        
        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 25px;
        }
        
        .hospital-info {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .hospital-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            margin-right: 15px;
        }
        
        .hospital-details {
            text-align: left;
        }
        
        .hospital-name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 18px;
        }
        
        .hospital-location {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .kyc-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px 25px;
            background: linear-gradient(135deg, #2ecc71 0%, #1a936f 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }
        
        .kyc-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.6);
        }
        
        .kyc-button:active {
            transform: translateY(1px);
            box-shadow: 0 3px 10px rgba(46, 204, 113, 0.4);
        }
        
        .kyc-button .icon {
            margin-right: 12px;
            font-size: 20px;
        }
        
        .kyc-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(1);
            opacity: 0;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
        
        .kyc-button:active::after {
            transform: translate(-50%, -50%) scale(30);
            opacity: 0;
            transition: 0s;
        }
        
        .button-secondary {
            background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .button-secondary:hover {
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.6);
        }
        
        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            min-width: 100px;
            margin-bottom: 15px;
        }
        
        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2ecc71;
            font-size: 20px;
            margin-bottom: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
        }
        
        .feature-text {
            font-size: 14px;
            color: #7f8c8d;
            font-weight: 500;
            text-align: center;
        }
        
        .footer {
            margin-top: 30px;
            color: #95a5a6;
            font-size: 12px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background: #2ecc71;
            color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
            
            .logo {
                width: 120px;
                height: 120px;
            }
            
            .kyc-button {
                padding: 16px 20px;
                font-size: 16px;
            }
            
            .features {
                flex-direction: column;
                gap: 20px;
            }
            
            .hospital-info {
                flex-direction: column;
                text-align: center;
            }
            
            .hospital-icon {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .hospital-details {
                text-align: center;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <!-- Ganti dengan path logo RSD Kalisat yang sesuai -->
                <img src="RSD KALISAT PIN.png" alt="Logo RSD Kalisat">
            </div>
            <h1>KYC Satu Sehat</h1>
            <p class="subtitle">Verifikasi Identitas Pasien Terintegrasi</p>
        </div>
        
        <div class="hospital-info">
            <div class="hospital-icon">
                <i class="fas fa-hospital"></i>
            </div>
            <div class="hospital-details">
                <div class="hospital-name">RSD Kalisat Jember</div>
                <div class="hospital-location">Jember, Jawa Timur</div>
            </div>
        </div>
        
        <div class="button-container">
            <button class="kyc-button" onclick="loadFormPopup()">
                <i class="fas fa-id-card icon"></i> KYC Pasien Popup
            </button>
            
            <button class="kyc-button button-secondary" onclick="loadFormNewTab()">
                <i class="fas fa-external-link-alt icon"></i> KYC Pasien New Tab
            </button>
        </div>
        
        <div class="features">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="feature-text">Aman</div>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="feature-text">Cepat</div>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="feature-text">Terverifikasi</div>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="feature-text">Privasi</div>
            </div>
        </div>
        
        <div class="footer">
            IT RSD Kalisat 2025 - Layanan Resmi Kementerian Kesehatan RI
        </div>
    </div>

    <div class="notification" id="notification">
        <i class="fas fa-spinner fa-spin"></i>
        <span>Membuka jendela KYC Satu Sehat...</span>
    </div>

    <script type="text/javascript">
        // PHP-generated URL
        const url = "<?php echo $validation_web['data']['url']; ?>";
        
        // Fungsi untuk menampilkan notifikasi
        function showNotification() {
            const notification = document.getElementById('notification');
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
        
        // Fungsi untuk membuka popup
        function loadFormPopup() {
            showNotification();
            let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=800,height=600,left=100,top=100`;
            window.open(url, "KYC", params);
        }

        // Fungsi untuk membuka tab baru
        function loadFormNewTab() {
            showNotification();
            window.open(url, "_blank");
        }
    </script>
</body>
</html>