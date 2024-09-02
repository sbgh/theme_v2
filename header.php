<!DOCTYPE html>
<html lang="en" style="background-color:black; color:white;" data-bs-theme="dark">

<head>

    <!-- main Header -->
    <title><?php the_field('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php the_field('title'); ?>">
    <!-- <link rel="icon" type="image/png" href="<?php getMyImage(get_field('icon_image'), "thumbnail"); ?>"> -->

    <?php wp_head(); ?>

</head>

<body class='home'>

    <header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a id="whyBtn" class="nav-link " aria-current="page" href="#">Why Choose Us</a>
                        </li>
                        <li class="nav-item">
                            <a id="servicesBtn" class="nav-link" href="#">Our Services</a>
                        </li>
                        <li class="nav-item">
                            <a id="industriesBtn" class="nav-link" href="#">Industries</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <li><a id="contactBtn" class="dropdown-item" href="#">Contact</a></li>
                                <li><a id="loginBtn" class="dropdown-item" href="#">Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <script>
        jQuery(document).ready(function($) {
            // console.log("ready")

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }


            $("#splashTitle").css({
                "transform": "translateX(0px)"
            });
            $("#splashMoto").css({
                "transform": "translateY(0px)"
            });

            let target = '.key'
            document.querySelectorAll(target).forEach((i) => {
                if (i) {

                    let x = Math.random(),
                        y = Math.random(),
                        z = Math.random()
                    let x2 = Math.random(),
                        y2 = Math.random(),
                        z2 = Math.random()

                    let scopeX = $(window).width(),
                        scopeY = $(window).height(),
                        scopeZ = $(window).width()

                    let maxRotationsDeg = 3500

                    $(i).css({
                        "transition": 'transform 0s',
                        "transform": 'perspective(1000px) rotate3d(' + (x).toString() + ', ' + (y).toString() + ', ' + (z).toString() + ', ' + (x2 * maxRotationsDeg).toString() + 'deg) translate3d(' + ((x - .5) * scopeX).toString() + 'px, ' + ((y - .5) * scopeY).toString() + 'px, ' + ((z - .5) * scopeZ).toString() + 'px) rotate3d(' + (x2).toString() + ', ' + (y2).toString() + ', ' + (z2).toString() + ', ' + (x * maxRotationsDeg / 5).toString() + 'deg)'
                    });
                }
            });
            setTimeout(function() {
                let target = '.key'

                document.querySelectorAll(target).forEach((i) => {
                    if (i) {
                        $(i).addClass("inPlace")
                    }
                });

            }, 3000)

            setTimeout(function() {
                $("#keyboard-base").addClass("inPlace")
            }, 13000)

            function shiftBackground() {
                x = Math.random()
                y = Math.random()
                r = Math.random()
                $("#glassback").css({

                    "backdrop-filter": "blur(0px) brightness(" + (x + .5).toString() + ") contrast(1) grayscale(" + r + ") hue-rotate(0deg) invert(0%) opacity(1) sepia(0) saturate(1)"

                })
            }

            function keyPunch() {

                let target = '.key'
                document.querySelectorAll(target).forEach((i) => {
                    if (i) {
                        setTimeout(function(i) {

                            $(i).css({
                                "background-color": "white"
                            })

                            setTimeout(function(i) {

                                $(i).css({
                                    "background-color": "black"
                                })

                            }, 50, i)

                        }, 2000 + 4000 * Math.random(), i)

                    }
                });
                setTimeout(function() {
                    shiftBackground()
                    keyPunch()
                }, 30000)

            }
            setTimeout(function() {
                keyPunch()
            }, 13000)

            setTimeout(function() {
                $("#imageback").css({
                    "transition": "opacity 6s",
                    "opacity": "1"
                })
            }, 16000)


            const whyUsText = `<?php the_field('why_us'); ?>`
            for (let n in whyUsText.split(" ")) {
                x = Math.random() * 2 - 1
                y = Math.random() * 2 - 1
                r = Math.random() * 2 - 1
                let wrd = whyUsText.split(" ")[n]
                wrd = wrd + "&nbsp;"
                $("#whyUsWords").append('<div class="whyUsWord flutter" data-x=' + x + ' data-y=' + y + ' data-r=' + r + '><span>' + wrd + '</span></div>')
            }


            //Observe
            //setup observe on about and contactForm
            let options = {
                root: null,
                threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.00],
                rootMargin: '-8% 0% -10% 0%',
            };

            let showMain = function(entries, observer) {
                entries.forEach(entry => {

                    const ratio = entry.intersectionRatio //entry.isIntersecting
                    entry.target.style.opacity = ratio

                    let ele = entry.target
                    if ($(ele).hasClass("flutter")) {
                        const x = $(ele).attr("data-x")
                        const y = $(ele).attr("data-y")
                        const r = $(ele).attr("data-r")

                        var eWidth = $(window).width() * x / 10 * (1 - ratio)
                        var eHeight = $(window).height() * y / 10 * (1 - ratio)
                        var rotate = r * 180 * (1 - ratio)

                        $(ele).find("span").css({
                            "transform": "translate(" + (eWidth).toString() + "px, " + (eHeight).toString() + "px) scale(" + ratio + ")  rotate3d(" + (Math.abs(x)).toString() + ", " + (Math.abs(y)).toString() + ", " + (Math.abs(r)).toString() + ", " + (rotate).toString() + "deg)",
                            "opacity": ratio
                        })

                        if (entry.intersectionRatio > .90) {
                            let x = Math.random() * 2 - 1
                            let y = Math.random() * 2 - 1
                            $(ele).attr("data-x", x)
                            $(ele).attr("data-y", y)
                        }

                    }
                });
            }

            let observeShowMain = new IntersectionObserver(showMain, options)

            setTimeout(function() {

                let target = '.whyUsWord';
                document.querySelectorAll(target).forEach((i) => {
                    if (i) {
                        observeShowMain.observe(i);
                    }
                });

            }, 1000)


            $("#whyBtn").on("click", function() {

                $("#main").animate({
                    scrollTop: $("#whyUs").offset().top
                }, 1000);
                $("#whyBtn").addClass("active");
                $("#servicesBtn").removeClass("active");
                $("#industryBtn").removeClass("active");
            });

            $("#servicesBtn").on("click", function() {

                $("#main").animate({
                    scrollTop: $("#services").offset().top
                }, 1500);
                $("#servicesBtn").addClass("active");
                $("#whyBtn").removeClass("active");
                $("#industryBtn").removeClass("active");
            });

            $("#industriesBtn").on("click", function() {

                $("#main").animate({
                    scrollTop: $("#industries").offset().top
                }, 1000);
                $("#industryBtn").addClass("active");
                $("#whyBtn").removeClass("active");
                $("#industryBtn").removeClass("active");
            });

            $("#contactBtn").on("click", function() {

                $("#main").animate({
                    scrollTop: $("#contactBuffer").offset().top
                }, 1000);
                $("#industryBtn").removeClass("active");
                $("#whyBtn").removeClass("active");
                $("#industryBtn").removeClass("active");
            });

            $("#loginBtn").on("click", function() {

               $("#loginModal").modal("show")
                
                $("#industryBtn").removeClass("active");
                $("#whyBtn").removeClass("active");
                $("#industryBtn").removeClass("active");
            });

            const servicesList = `<?php the_field('services'); ?>`
            const servicesArr = servicesList.split("\n")

            let twoDeeArr = [];
            while (servicesArr.length) twoDeeArr.push(servicesArr.splice(0, 2));

            if (servicesArr.length % 2 == 0) {
                for (let x in twoDeeArr) {

                    let sName = twoDeeArr[x][0]
                    let sDesc = twoDeeArr[x][1]

                    const itemHTML = "<div class='serviceItem'><div class='serviceItemName'>" + sName + "</div><div class='serviceItemDesc'>" + sDesc + "</div></div>"
                    const itemEle = $($.parseHTML(itemHTML))

                    $("#serviceList").append(itemEle)

                }
            }

            const industriesList = `<?php the_field('industries'); ?>`
            const industriesArr = industriesList.split("\n")

            if (industriesArr.length % 3 == 0) {

                let threeDeeArr = [];
                while (industriesArr.length) threeDeeArr.push(industriesArr.splice(0, 3));
                for (let x in threeDeeArr) {

                    let sName = threeDeeArr[x][0]
                    let sDesc = threeDeeArr[x][1]
                    let simg = threeDeeArr[x][2]

                    const itemHTML = "<div class='industriesItem'><div class='industriesItemName'>" + sName + "</div><div class='industriesItemDesc'>" + sDesc + "</div></div>"
                    const itemEle = $($.parseHTML(itemHTML))

                    itemEle.css({

                        "background-image": "linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.5) ), url(" + simg + ")"
                    })

                    $("#industriesList").append(itemEle)


                }
            } else {
                $("#industriesList").append("problem with industries list. Needs to be 3 lines per industry. name, description, image_url.")
            }


            $(".mdi-linkedin").on("click", function() {
                window.open("<?php the_field('li_link'); ?>", "_new");
            })
            $(".mdi-twitter").on("click", function() {
                window.open("<?php the_field('tw_link'); ?>", "_new");
            })
            $(".mdi-facebook").on("click", function() {
                window.open("<?php the_field('fa_link'); ?>", "_new");
            })

            //Contact

            $("#contactSubmit").on("click", function() {

                focus = focus | 1;
                $(".loader").fadeIn(200);
                postForm();
            })

            var focus = 0;

            function postForm() {
                let target = 'input'
                document.querySelectorAll(target).forEach((i) => {
                    if (i) {
                        $(i).prop("readonly", true).attr("disabled", true);
                    }

                })

                $('textarea').prop("readonly", true).attr("disabled", true);

                $(".formError").text('');
                $("#nameError").text('');
                $("#emailError").text('');
                $("#messageError").text('')

                $.ajax({
                    type: "POST",
                    url: "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'post_contact',
                        contactName: $('#contactName').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        message: $('#message').val()
                    },
                    success: function(data) {
                        var cObj = JSON.parse(data);
                        $(".loader").fadeOut(0);

                        if (cObj.hasError) {
                            $(".formError").text("Sorry, an error occured.");

                            if (cObj.hasOwnProperty("nameError")) {
                                $("#nameError").text(cObj.nameError)
                            }
                            if (cObj.hasOwnProperty("emailError")) {
                                $("#emailError").text(cObj.emailError)
                            }
                            if (cObj.hasOwnProperty("messageError")) {
                                $("#messageError").text(cObj.messageError)
                            }

                            $('input').prop("readonly", false).attr("disabled", false);
                            $('textarea').prop("readonly", false).attr("disabled", false);

                        } else if (cObj.emailSent) {

                            $(".formError").text("");
                            $("#contactText").fadeOut(500);

                            setTimeout(function() {
                                $(".thanksContactMessage").fadeIn(500);
                            }, 1000)
                        } else {
                            $('input').prop("readonly", false).attr("disabled", false);
                            $('textarea').prop("readonly", false).attr("disabled", false);
                        }
                    }
                });
            }
        });
    </script>