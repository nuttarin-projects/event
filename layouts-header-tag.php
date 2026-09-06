<?php
require_once "classes/Constants.php";
$rand = Constants::$rand;
?>

<!-- Basic Meta -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Title Tag -->
<title>DEMO OPEN HOUSE 2025 !!</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<!-- Canonical URL -->
<link rel="canonical" href="">

<!-- Open Graph / Facebook / Line / LinkedIn -->
<meta property="og:title" content="">
<meta property="og:description" content="">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="">

<!-- Favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico?ver=<?= $rand ?>">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400;500;600;700&display=swap" rel="stylesheet">

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Tailwind Custom Config -->
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          'kanit': ['Kanit', 'sans-serif'],
        },
        colors: {
          'dpu-primary': '#4C51BF',
          'dpu-secondary': '#4338ca',
          'dpu-third': '#e4daf7',
          'dpu-fourth': '#e8dff9',
          'dpu-fifth': '#f2edfb',
          'dpu-sixth': '#7a76ff',
          'dpu-seventh': '#d1d0f8',
          'dpu-gray': '#d1d5db',
          'dpu-checkbox': '#01b9dd',
        }
      }
    }
  }
</script>

<link rel="stylesheet" href="assets/css/style.css?ver=<?= $rand ?>">

<!-- SwiperJS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css?ver=<?= $rand ?>">

<!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css?ver=<?= $rand ?>" rel="stylesheet">

<!-- Font Awesome 6 CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css?ver=<?= $rand ?>">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css?ver=<?= $rand ?>">

