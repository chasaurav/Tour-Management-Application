<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tour Packages for Darjeeling, Sikkim</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- FAVICON -->
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <!-- FONT AWESOME -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- CUSTOM STYLE -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="headerWrapper">
                <div class="nav">
                    <div class="logoBrand">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="logo"
                                style="width: 20%; height: auto;  margin-top: 20px;">
                        </a>
                    </div>
                </div>
                <div class="textContent">
                    <h2>Get Ready!!!</h2>
                    <p>Sikkim & Darjeeling season B2B ready packages. <br> Valid till June 2019 - August 2019</p>
                    <ul class="contactItems">
                        <li>Reach Us at:</li>
                        <li><a href="tel:+919832098320" style="font-size: 1em;"><i class="fa fa-phone-square"
                                    aria-hidden="true"></i> 083 89 89 89 89</a></li>
                        <li><a href="javascript:void()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="javascript:void()"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void()"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:void()"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                    </ul>
                    <p>
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/home') }}">Home</a>
                        @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                        @endif
                        @endauth
                        @endif
                    </p>
                    <a href="#popularTourPackages" style="margin-top: 25px;">
                        <svg width="28px" height="100%" viewBox="0 0 247 390" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;">
                            <path id="wheel" d="M123.359,79.775l0,72.843"
                                style="fill:none;stroke:#fff;stroke-width:20px;" />
                            <path id="mouse"
                                d="M236.717,123.359c0,-62.565 -50.794,-113.359 -113.358,-113.359c-62.565,0 -113.359,50.794 -113.359,113.359l0,143.237c0,62.565 50.794,113.359 113.359,113.359c62.564,0 113.358,-50.794 113.358,-113.359l0,-143.237Z"
                                style="fill:none;stroke:#fff;stroke-width:20px;" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="bodyWrapper">
                <h1 id="popularTourPackages" class="sectionHeader">
                    Popular Tour Packages <br>
                    <small class="sectionSubHeader">We are Expert in Sikkim and Darjeeling Tour Package</small>
                </h1>
                <div class="cardContainer">
                    @include('packageData');
                </div>
            </div>
            <div class="ajax-loader" style="text-align: center; display: none;">
                <img src="{{ asset('images/loader.gif') }}" alt="Ajax Loader">
            </div>
        </div>
        <div class="modalContainerHidden">
            <h1 class="modalHead">Enquiry Modal</h1>
        </div>
        <div class="modalContainerVisible" style="display: none;">
            <i id="closeModal" class="fa fa-times" aria-hidden="true"
                style="font-size: 2em; float: right; cursor: pointer;"></i>
            <form>
                <input type="text" class="custInput" id="name" placeholder="Enter Your Name">
                <input type="number" class="custInput" id="phone" placeholder="Enter Your Phone No.">
                <input type="email" class="custInput" id="email" placeholder="Enter Your Email">
                <button type="submit" class="enquiryBtn">
                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Plan my trip
                </button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            $(document).ready(function () {
                $('.modalHead').on('click', function() {
                    $('.modalContainerVisible').fadeIn('slow');
                    $('.modalContainerHidden').fadeOut('slow');
                });

                $('#closeModal').on('click', function() {
                    $('.modalContainerVisible').fadeOut('slow');
                    $('.modalContainerHidden').fadeIn('slow');
                });

                $('.enquiryBtn').on('click', function(e) {
                    e.preventDefault();

                    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    let name = $('#name');
                    let phone = $('#phone');
                    let email = $('#email');

                    if (name.val() == '') {
                        alertMsg('Error!!!', 'Enter Name', 'error');
                        return false;
                    }
                    if (phone.val() == '') {
                        alertMsg('Error!!!', 'Enter Phone No', 'error');
                        return false;
                    }
                    if (!isEmail(email.val())) {
                        alertMsg('Error!!!', 'Invalid Email', 'error');
                        return false;
                    }

                    $.ajax({
                        type: "POST",
                        url: "/saveEnquiry",
                        dataType: "JSON",
                        data: {
                            _token: CSRF_TOKEN,
                            name: name.val(),
                            phone: phone.val(),
                            email: email.val()
                        },
                        success: function (data) {
                            if (data) {
                                alertMsg('Success', 'Enquiry Submitted', 'success');
                                name.val('');
                                phone.val('');
                                email.val('');
                                $('.modalContainerVisible').fadeOut('slow');
                                $('.modalContainerHidden').fadeIn('slow');
                            }
                        }
                    });
                })
            });

            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }

            function alertMsg(titleText, textText, iconText) {
                Swal.fire({
                    title: titleText,
                    text: textText,
                    icon: iconText,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay'
                });
            }

            function loadMoreDate(page) {
                $.ajax({
                    type: "get",
                    url: `?page=${page}`,
                    beforeSend: function(){
                        $('.ajax-loader').show();
                    }
                }).done(function(data){
                    if (data.html == "") {
                        $('.ajax-loader').html("No more packages to load.");
                        return false;
                    }
                    $('.cardContainer').append(data.html);
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding.");
                });
            }

            var page = 1;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 5) {
                    page++;
                    loadMoreDate(page);
                }
            });
        </script>
    </body>

</html>
