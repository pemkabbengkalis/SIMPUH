<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIMPUH</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/frontend/assets/images/favicon.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700|Roboto:400,400i,700&display=swap" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="/frontend/assets/fontawesome/js/all.min.js"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="/frontend/assets/css/theme.css">
		<style>
			body {
				background-image: url('{{ asset('frontend') }}/assets/images/bg-simpuh.png');
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
			}
		</style>

</head>

<body>
    <header class="header">
        <div class="branding">
            <div class="container-fluid position-relative py-3">
                <div class="logo-wrapper">
	                <div class="site-logo"><a class="navbar-brand" href="/"><img class="logo-icon me-2" src="{{ asset('frontend') }}/assets/images/site-logo.png" alt="logo" style="width: 3%;"><span class="logo-text">SIMPUH</span></a></div>
                </div><!--//docs-logo-wrapper-->

            </div><!--//container-->
        </div><!--//branding-->
    </header><!--//header-->

    <section class="hero-section">
	    <div class="container">
		    <div class="row">
			    <div class="col-12 col-md-7 pt-5 mb-5 align-self-center">
				    <div class="promo pe-md-3 pe-lg-5">
					    <h1 class="headline mb-3">
						    SIMPUH
					    </h1><!--//headline-->
					    <div class="subheadline mb-4">
						    Sistem Informasi Monitoring Program Unggulan Daerah Kab. Bengkalis
					    </div><!--//subheading-->

					    <div class="cta-holder row gx-md-3 gy-3 gy-md-0">
						    <div class="col-12 col-md-auto">
						        <a class="btn btn-primary w-100" href="/admsimpuh">Login</a>
						    </div>
						    <div class="col-12 col-md-auto">
						        <a class="btn btn-secondary scrollto w-100" href="#">Manual Book</a>
						    </div>
					    </div><!--//cta-holder-->

					    <div class="hero-quotes mt-5">
						    <div id="quotes-carousel" class="quotes-carousel carousel slide carousel-fade mb-5" data-bs-ride="carousel" data-bs-interval="8000">
								<ol class="carousel-indicators">
									<li data-bs-target="#quotes-carousel" data-bs-slide-to="0" class="active"></li>
									<li data-bs-target="#quotes-carousel" data-bs-slide-to="1"></li>
								</ol>

							    <div class="carousel-inner">
								    <div class="carousel-item active">
								        <blockquote class="quote p-4 theme-bg-light">
									        "Saya Yakin Dengan Adanya Aplikasi ini memudahkan bagi para Perangkat Daerah dalam Memonitoring Program Unggulan Khususnya di Kabupaten Benglalis guna Terwujudnya Bengkalis BERMASA."
								        </blockquote><!--//item-->
								        <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
									        <div class="col-12 col-md-auto text-center text-md-start">
									            <img class="source-profile" src="{{ asset('frontend') }}/assets/images/profiles/profile-1.png" alt="image" >
									        </div><!--//col-->
									        <div class="col source-info text-center text-md-start">
										        <div class="source-name">Kasmarni, S.Sos., MMP</div>
										        <div class="soure-title">Bupati Bengkalis</div>
										    </div><!--//col-->
								        </div><!--//source-->
								    </div><!--//carousel-item-->
								    <div class="carousel-item">
								        <blockquote class="quote p-4 theme-bg-light">
									        "Mudah-mudahan Sistem Informasi Monitoring Program Unggulan Daerah Kab. Bengkalis atau SIMPUH Terus Memberikan Yang Terbaik Dalam Monitoring Program Unggulan Daerah Kabupaten Bengkalis dalam mendukung terwujudnya Kabupaten Bengkalis Yang BERMASA."
								        </blockquote><!--//item-->
								        <div class="source row gx-md-3 gy-3 gy-md-0 align-items-center">
									        <div class="col-12 col-md-auto text-center text-md-start">
									            <img class="source-profile" src="{{ asset('frontend') }}/assets/images/profiles/profile-2.png" alt="image" >
									        </div><!--//col-->
									        <div class="col source-info text-center text-md-start">
										        <div class="source-name">H. Bagus Santoso</div>
										        <div class="soure-title">Wakil Bupati Bengkalis</div>
										    </div><!--//col-->
								        </div><!--//source-->
								    </div><!--//carousel-item-->
								</div><!--//carousel-inner-->
							</div><!--//quotes-carousel-->

					    </div><!--//hero-quotes-->
				    </div><!--//promo-->
			    </div><!--col-->
			    <div class="col-12 col-md-5 mb-5 align-self-center">
				    <div class="book-cover-holder">
					    <img id="optionalstuff" class="img-fluid book-cover" src="{{ asset('frontend') }}/assets/images/orang-simpuh.png" alt="book cover" >
					    <div class="book-badge d-inline-block">
								<img id="optionalstuff2" class="img-fluid book-cover" src="{{ asset('frontend') }}/assets/images/bermasa-logo.png" alt="book cover" >
					    </div>
				    </div><!--//book-cover-holder-->
			    </div><!--col-->
		    </div><!--//row-->
	    </div><!--//container-->
    </section><!--//hero-section-->

    <!-- Javascript -->
		<script>
			function noScroll(){
			window.scrollTo(0,0);
		}
		window.addEventListener('scroll', noScroll);
		</script>
    <script src="{{ asset('frontend') }}/assets/plugins/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/plugins/smoothscroll.min.js"></script>

    <script src="{{ asset('frontend') }}/assets/js/main.js"></script>

</body>
</html>
