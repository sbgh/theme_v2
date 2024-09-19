<!DOCTYPE html>
<html lang="en">

<head>

    <!-- main Header -->
    <title><?php the_field('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php the_field('title'); ?>">
    <link rel="icon" type="image/png" href="<?php getMyImage(get_field('icon_image'), "thumbnail"); ?>">

    <?php wp_head(); ?>

    <style>
        body {
            --mainColor: <?php the_field('main_color'); ?>;
            --offWhite: <?php the_field('off_white_color'); ?>;
            background-color: <?php the_field('main_color'); ?>;
        }
    </style>

</head>

<body class='home'>

    <header>

    </header>


    <script>
        jQuery(document).ready(function($) {

            const templateName = '<?php $template = get_template();
                                    echo "$template" ?>'

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            var svgloader = new THREE.SVGLoader();
            var floader = new THREE.FileLoader()

            //load all the icons
            floader.load(
                '/wp-content/themes/' + templateName + '/images/icon1.svg',
                function(data) {
                    initIconEffect(data)
                }
            )

            function initIconEffect(data) {
                //--------------3d icons effect-----------------------------
                let scene = new THREE.Scene();

                //Lights
                let light = new THREE.DirectionalLight(0xffffff, 1);
                light.position.set(3, 10, 10);
                scene.add(light, new THREE.AmbientLight(0xffffff, .6));

                //Camara
                let camera = new THREE.PerspectiveCamera(50, innerWidth / innerHeight, 1, 1000);
                camera.position.set(0, 8, -50).setLength(120);
                camera.lookAt(scene.position);
                let renderer = new THREE.WebGLRenderer({
                    antialias: true,
                    alpha: true
                });

                renderer.setSize(innerWidth, innerHeight);

                var container = document.getElementById("cHolder");
                container.appendChild(renderer.domElement);

                //Create array of icons
                var Iconpaths = data.split("\n")
                var icons = []
                for (let idx in Iconpaths) {
                    if (Iconpaths[idx].length > 20) {
                        var pathsHolder = svgloader.parse(Iconpaths[idx])
                        var s = pathsHolder.paths[0].toShapes(true)
                        icons.push(s)
                    }
                }

                const loader = new THREE.CubeTextureLoader()
                loader.setPath('/wp-content/themes/' + templateName + '/images/textureCube/');
                const textureCube = loader.load([
                    'px.png', 'nx.png',
                    'py.png', 'ny.png',
                    'pz.png', 'nz.png'
                ]);

                let mat = new THREE.MeshStandardMaterial({
                    color: <?php the_field('icon_color'); ?>,
                    envMap: textureCube,
                    metalness: .2,
                    roughness: 0.0
                });

                var objects = []
                //make 60 icon objects
                for (let i = 0; i < 60; i++) {
                    let deg = Math.random() * 360
                    var shapes = icons[Math.floor(Math.random() * icons.length)]; //pick rand icon
                    //Each icon may have multiple shapes
                    for (let q in shapes) {
                        //Create 3d geometry out of the 2d icon
                        var shape = shapes[q]
                        let g = new THREE.ExtrudeGeometry(shape, {
                            depth: 5,
                            bevelEnabled: true,
                            bevelThickness: .2,
                            bevelSize: .2,
                            bevelSegments: 20,
                            curveSegments: 20
                        });

                        g.scale(.45, .45, .45);
                        g.rotateY(-Math.PI);
                        g.rotateX(-Math.PI * .5);
                        let xslot = Math.floor(i / 8) - 2
                        let zslot = (i % 8) - 4
                        g.translate(-xslot * 14 - 30, 10, zslot * 13)
                        g.rotateX(Math.PI * -0.5);
                        g.rotateY(Math.PI * -0.2);

                        //create new 3d object with our geometry and material
                        let o = new THREE.Mesh(g, mat);
                        o.material.transparent = true
                        o.material.opacity = 0.0

                        //Add the deg attribute to track the motion of this object. Random 0-360.
                        o.deg = deg

                        //Add to scene
                        scene.add(o)
                        //Add to objects array
                        objects.push(o)
                    }

                }

                var rTime = 0 //init render count
                renderer.setAnimationLoop(_ => {

                    //count the render calls
                    rTime++
                    //only move and render objects every third frame and only if canvas is on screen
                    if (rTime % 3 == 0 && canvasFocus) {
                        renderer.render(scene, camera);
                        rTime = 0
                        for (let x in objects) {
                            let obj = objects[x]
                            obj.position.z = Math.sin(obj.deg) * 50
                            obj.deg += .004
                            obj.deg = obj.deg > 360 ? obj.deg -= 360 : obj.deg

                            obj.material.opacity = obj.material.opacity >= 1 ? obj.material.opacity = 1 : obj.material.opacity + 0.0001;
                        }
                    }
                })

                function onWindowResize() {

                    renderer.setSize(innerWidth, innerHeight);
                    camera.aspect = innerWidth / innerHeight;
                    camera.updateProjectionMatrix();

                }
                window.addEventListener('resize', onWindowResize, false);

                //dbl-click icon background to turn on mouse controls (zoom etc) on rendered scene
                $("canvas").on("dblclick", function() {
                    let controls = new THREE.OrbitControls(camera, renderer.domElement);
                });

                //Opserve canvas and turn off animations when not on screen
                let options = {
                    root: null,
                    threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.00],
                    rootMargin: '-8% 0% -10% 0%',
                };
                var canvasFocus = true
                let showCanvas = function(entries, observer) {
                    entries.forEach(entry => {

                        const ratio = entry.intersectionRatio //entry.isIntersecting
                        if (ratio < .10) {
                            canvasFocus = false
                        } else {
                            canvasFocus = true
                        }
                    })
                }

                let observeShowCanvas = new IntersectionObserver(showCanvas, options)

                setTimeout(function() {

                    let target = '#cHolder';
                    document.querySelectorAll(target).forEach((i) => {
                        if (i) {
                            observeShowCanvas.observe(i);
                        }
                    });
                }, 1000)

            }



            //--------------Observe text effect-----------------------------

            const inputText = `<?php the_field('second_header_text'); ?>`
            for (let n in inputText.split(" ")) {
                x = Math.random() * 2 - 1
                y = Math.random() * 2 - 1
                r = Math.random() * 2 - 1
                let wrd = inputText.split(" ")[n]
                wrd = wrd + "&nbsp;"

                var addClass = ""
                if (wrd.substring(0, 1) == "~") {
                    addClass = "mainColor"
                    wrd = wrd.substring(1)
                }
                $(".secondHeaderText").append('<div class="secondHeaderWord flutter ' + addClass + '" data-x=' + x + ' data-y=' + y + ' data-r=' + r + '><span>' + wrd + '</span></div>')
            }


            //Observe
            //setup observe on second header
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

                let target = '.secondHeaderWord';
                document.querySelectorAll(target).forEach((i) => {
                    if (i) {
                        observeShowMain.observe(i);
                    }
                });

            }, 1000)

            //-------------------------------------------

            //----------Populate third/fourth_moto text------------
            const third_motoTxt = "<?php the_field('third_moto'); ?>"

            for (let n in third_motoTxt.split(" ")) {
                let wrd = third_motoTxt.split(" ")[n]
                wrd = wrd + "&nbsp;"

                var addClass = ""
                if (wrd.substring(0, 1) == "~") {
                    addClass = "mainColor"
                    wrd = wrd.substring(1)
                }
                $("#whyItemsLText").append('<div class="thirdMotoWord ' + addClass + '"><span>' + wrd + '</span></div>')
            }
            $("#whyItemsLText2").text("<?php the_field('fourth_moto'); ?>")

            //----------Populate why cards------------
            const why_usTxt = `<?php the_field('why_us'); ?>`
            let txtArr = why_usTxt.split("\n")
            if (txtArr.length > 5) {
                $("#customCard1").find(".customCardSubtitle").text(txtArr[0])
                $("#customCard1").find(".customCardText").text(txtArr[1])
                $("#customCard2").find(".customCardSubtitle").text(txtArr[2])
                $("#customCard2").find(".customCardText").text(txtArr[3])
                $("#customCard3").find(".customCardSubtitle").text(txtArr[4])
                $("#customCard3").find(".customCardText").text(txtArr[5])
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

            //Populate servises list
            const servicesList = `<?php the_field('services'); ?>`
            const servicesArr = servicesList.split("\n")

            let twoDeeArr = [];
            while (servicesArr.length) twoDeeArr.push(servicesArr.splice(0, 3));

            if (servicesArr.length % 3 == 0) {
                for (let x in twoDeeArr) {

                    let sName = twoDeeArr[x][0]
                    let sDesc = twoDeeArr[x][1]
                    let sImg = twoDeeArr[x][2]

                    const itemHTML = "<div class='row serviceItem'><div class='col col-12 col-md-6 col-lg-4 mx-auto serviceItemText'><div class='serviceItemName'></div><h3 class='serviceItemDesc'></h3></div></div>"
                    
                    const itemEle = $($.parseHTML(itemHTML))
                    itemEle.find(".serviceItemName").text(sName)
                    itemEle.find(".serviceItemDesc").text(sDesc)

                    const itemImgHTML = "<div class='col col-12 col-md-6 col-lg-4 mx-auto serviceItemImg'></div>"
                    if (x % 2 === 0) {
                        itemEle.append(itemImgHTML)
                    } else {
                        itemEle.prepend(itemImgHTML)
                    }

                    itemEle.find(".serviceItemImg").css({

                        "background-image": "url(" + sImg + ")"
                    })

                    $("#servicesList").append(itemEle)

                }
            }


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