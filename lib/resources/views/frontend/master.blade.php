<!DOCTYPE html>
<html>
<head>
	<base href="{{ asset('public/layout/frontend') }}/"
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title> News - @yield('title')</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
        <style>
           .logout-btn {
                position: absolute;
                right: 107px;
                top: 15px;
                font-size: 17px;
                color: aliceblue;
            }
            .logout-btn  a{
                font-size: 17px;
                color: aliceblue;
                text-decoration: none;
            }
            .contact-icon {
                font-size: 31px;
                position: fixed;
                right: 51px;
                bottom: 88px;
                padding: 9px;
                background: #ffc107;
                border-radius: 50%;
                color: #fff;
                cursor: pointer;
            }
            .contact {
                width: 260px;
                position: fixed;
                right: 52px;
                bottom: 140px;
                padding: 9px;
                background: #fff;
                border-radius: 7px;
                cursor: pointer;
                border: 1.5px solid #ffc107 !important;
                box-sizing: border-box !important;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15) !important;
                border-radius: 7px !important;
            }
            .contact-title {
                font-size: 17px;
				margin-top: 7px;
            }
            .contact label {
                margin: 0;
            }
            .contact input {
				border: none;
                width: 100%;
                border: 1px solid #d8d8d8;
                border-radius: 3px ;
                padding: 3px;
                margin-bottom: 4px;
            }
            .contact input:focus {
                border: 1px solid #ffc107 ;
				outline: #ffc107;
            }
            .submit-contact-btn {
                padding: 4px 17px;
                border: none;
                border-radius: 5px;
                background: #ffc107;
                color: #fff;
                cursor: pos;
                cursor: pointer;
                margin-top: 6px;
                float: right;
            }
			.close-btn {
				position: absolute;
				right: 9px;
				top: 6px;
				font-size: 21px;
				color: #ffc107;
			}
            .hidden {
                display: none;
            }
			a:hover{
				text-decoration: none !important;
			}
			.subnav li {
                color: black;
                padding: 10px;
                font-size: 17px;
        	}

			.user {
				position: relative;
				padding: 0 20px;
			}
			.icon {
				font-size: 35px;
				padding: 27px;
				color: white;
				cursor: pointer;
                margin-left: 7px;
			}
			.subnav li:hover {
				background-color: rgba(184, 166, 146, 0.2);
			}
            .subnav a {
                color: #ff7b07;
            }

			.user:hover .subnav {
				display: block;
			}

			.user .subnav {
				display: none;
				top: 81px;
				position: absolute;
				list-style-type: none;
				background-color: white;
				box-shadow: 0 0 5px #333;
				border-radius: 3px;
				width: 175px;
				z-index: 1;
			}

			#logo img {
                width: 212px;
        	}

			input {
                padding: 10px;
                border: none;
                cursor: pointer;
                border-radius: 3px;
			}

			.input {
				width: 550px;
				margin-top: 34px;
			}

			.submit {
				background-color: #fff;
			}
            .login-btn {
                position: absolute;
                top: 35px;
                right: 182px;
                color: #fff;
                font-size: 17px;
                height: fit-content;
                padding: 6px 4px;
                border-radius: 5px;
            }
            .register-btn {
                position: absolute;
                top: 35px;
                right: 108px;
                color: #fff;
                font-size: 17px;
                height: fit-content;
                padding: 6px 10px;
                border-radius: 5px;
            }
            .login-btn:hover {
                color: #fff;
                opacity: 0.8;
            }
            .register-btn:hover {
                color: #fff;
                opacity: 0.8;
            }
            .container {
                max-width: 1200px !important;
            }
            .product-item {
                max-width: 223px;
            }
            #header, #footer-t {
                background: linear-gradient(-180deg,#f53d2d,#f63) !important;
            }
            .menu-head {
                background: linear-gradient(-180deg,#f53d2d,#f63) !important;
                color: #fff;
            }
            .menu-item:hover {
                background: #f63;
            }
            .menu-item a:hover {
                color: #fff;
            }
            /* Style chung */
            .news-container {
                margin-bottom: 20px;
            }
            .news-title {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 15px;
                color: #222;
            }
            .news-title a {
                color: #222;
                text-decoration: none;
            }
            .news-title a:hover {
                color: #2f3192;
            }
            .news-description {
                font-size: 14px;
                color: #555;
                margin-bottom: 10px;
            }
            .news-meta {
                font-size: 12px;
                color: #888;
            }
            .news-thumb {
                position: relative;
                overflow: hidden;
                margin-bottom: 10px;
            }
            .news-thumb img {
                width: 100%;
                height: auto;
                transition: transform 0.3s;
            }
            .news-thumb:hover img {
                transform: scale(1.05);
            }
            .news-category {
                display: inline-block;
                padding: 2px 8px;
                background: #2f3192;
                color: #fff;
                font-size: 12px;
                border-radius: 3px;
                margin-bottom: 5px;
            }
            .news-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
            .news-item {
                border-bottom: 1px solid #eee;
                padding-bottom: 15px;
            }
            .news-item:last-child {
                border-bottom: none;
            }
        </style>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
	<!-- header -->
	<header id="header">
		<div class="container">
			<div style="flex-wrap: unset !important;" class="row">
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<a style="text-decoration: none;" href="{{ asset('/') }}">
					    <img style="width: 60px !important; margin-top: 15px;" src="img/home/logo-news.png" alt="">
					</a>
				</div>

				<div>
					<form action="{{ route('search') }}" method="get">
						<input class="input" type="text" name="result" placeholder="Nhập tiêu đề tin tức ..." required>
						<input class="submit"type="submit" name="submit" value="Tìm Kiếm">
					</form>
				</div>

				<div @if(Auth::check()) class="user icon">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					<ul class="subnav">
                        <li><a style="color: #f53d2d;" href="{{ asset('change-password') }}">Đổi mật khẩu</a></li>
                        <li><a style="color: #f53d2d;" href="{{ asset('logout') }}">Đăng xuất</a></li>
					</ul>
                    @endif
        		</div>
			</div>
            @if(!Auth::check())
             <a href="{{ asset('/login') }}" class="login-btn">Đăng nhập |</a>
             <a href="{{ asset('/register') }}" class="register-btn">Đăng ký</a>
            @endif
		</div>
	</header><!-- /header -->
	<!-- endheader -->

	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-3">
					<nav id="menu">
						<ul style="margin-bottom: 0px;">
							<li class="menu-item menu-head">Danh mục tin tức</li>
							@foreach($categories as $category)
							<li class="menu-item"><a style="text-decoration: none;" href="{{ route('category', $category->cate_id) }}">{{ $category->cate_name }}</a></li>
							@endforeach
						</ul>
					</nav>
				</div>
				<div id="main" class="col-md-9">
					@yield('main')
				</div>
			</div>
		</div>
	</section>
        <!-- endmain -->

        <!-- footer -->
        <footer id="footer">
            <div id="footer-t">
                <div class="container">
                    <div class="row">
                        <div id="logo" class="col-md-3 col-sm-12 col-xs-12">
							<a style="text-decoration: none;" href="{{ asset('/') }}">
                                <img style="width: 80px !important;" src="img/home/logo-news.png" alt="">
                            </a>
                        </div>
                        <div id="about" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>About us</h3>
                            <p class="text-justify"> News là nơi cung cấp tin tức nhanh chóng, chính xác và đầy đủ nhất.</p>
                        </div>
                        <div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>Hotline</h3>
                            <p>Phone1: (+84) 934155611</p>
                            <p>Phone2: (+84) 523514521</p>
                            <p>Email: news@gmail.com</p>
                        </div>
                        <div id="contact" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>Contact Us</h3>
                            <p>Address 1: Số 12/9 - Cầu Giấy - TPHCM</p>
                            <p>Address 2: Số 401/123 - Xuân Đỉnh - TPHCM</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- endfooter -->

		<script>
			var openBtn = document.querySelector('.contact-icon');
            var closeBtn = document.querySelector('.close-btn');
            var contactModal = document.querySelector('.contact');


            function toggleModal() {
                contactModal.classList.toggle('hidden');
            }

            openBtn.addEventListener('click', toggleModal);
            closeBtn.addEventListener('click', toggleModal);
		</script>
    </body>
    </html>
