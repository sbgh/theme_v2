<!DOCTYPE html>
<html lang="en">

<head>

    <!-- main Header -->
    <title><?php the_field('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php the_field('title'); ?>">
    <!-- <link rel="icon" type="image/png" href="<?php getMyImage(get_field('icon_image'), "thumbnail"); ?>"> -->

    <?php wp_head(); ?>

    <style>
        .main {
            --mainColor: <?php the_field('main_color'); ?>;
            background-color: <?php the_field('main_color'); ?>;
        }
    </style>

</head>

<body class='home'>

    <header>

    </header>


    <script>
        jQuery(document).ready(function($) {
            // console.log("ready")

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }



            let scene = new THREE.Scene();
            let camera = new THREE.PerspectiveCamera(50, innerWidth / innerHeight, 1, 1000);
            camera.position.set(0, 8, -50).setLength(120);
            camera.lookAt(scene.position);
            let renderer = new THREE.WebGLRenderer({
                antialias: true,
                alpha: true
            });
            renderer.setSize(innerWidth, innerHeight);
            // renderer.setClearColor(0xd12020);
            var container = document.getElementById("cHolder");
            container.appendChild(renderer.domElement);

            // let controls = new THREE.OrbitControls(camera, renderer.domElement);

            let light = new THREE.DirectionalLight(0xffffff, 1);
            light.position.setScalar(.5);
            scene.add(light, new THREE.AmbientLight(0xffffff, 0.5));

            // let shape = new THREE.Shape();
            // let angleStep = Math.PI * 0.5;
            // let radius = 1;

            var svgloader = new THREE.SVGLoader();

            var obj = {};

            obj.colors = [0xc07000];
            obj.center = {
                x: 150,
                y: 150
            };
            obj.paths = svgloader.parse('<svg  xmlns:dc="http://purl.org/dc/elements/1.1/"  xmlns:cc="http://creativecommons.org/ns#"  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"  xmlns:svg="http://www.w3.org/2000/svg"  xmlns="http://www.w3.org/2000/svg"  version="1.1"  id="svg5332"  viewBox="0 0 256.00007 256.00002"  height="72.248894mm"  width="72.248909mm"> <g   transform="translate(-362.5464,-406.21469)"   id="layer1">  <path    id="path10000"    d="m 465.83684,466.9869 c -18.8823,0 -37.6499,7.7751 -51.0017,21.127 -8.4122,8.4121 -14.6043,18.9734 -18.0383,30.3583 -8.2539,1.5581 -16.0492,5.5866 -21.9931,11.5304 -7.7473,7.7473 -12.2573,18.6331 -12.2573,29.5895 0,10.9565 4.51,21.8458 12.2573,29.5931 7.7474,7.7473 18.6367,12.2573 29.5931,12.2573 l 187.4365,0 c 6.9935,0 13.9453,-2.8775 18.8904,-7.8224 4.9452,-4.9451 7.8227,-11.8971 7.8227,-18.8906 0,-6.9935 -2.8775,-13.9417 -7.8227,-18.8868 -4.9147,-4.9149 -11.8119,-7.784 -18.7617,-7.8193 -1.3562,-12.6709 -7.0967,-24.867 -16.1148,-33.8851 -10.3847,-10.3847 -24.9798,-16.4314 -39.666,-16.4314 -3.5656,0 -7.1233,0.3656 -10.6192,1.0539 -2.5582,-3.8175 -5.4715,-7.3951 -8.7235,-10.6469 -13.3518,-13.3519 -32.1193,-21.127 -51.0017,-21.127 z"    style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;color-interpolation:sRGB;color-interpolation-filters:linearRGB;fill:#808080;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1px;marker:none;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" /> </g></svg>')

            var shape = obj.paths.paths[0].toShapes(true)[0];
            // shape.absarc(2, 2, radius, angleStep * 0, angleStep * 1);
            // shape.absarc(-2, 2, radius, angleStep * 1, angleStep * 2);
            // shape.absarc(-2, -2, radius, angleStep * 2, angleStep * 3);
            // shape.absarc(2, -2, radius, angleStep * 3, angleStep * 4);

            const loader = new THREE.CubeTextureLoader();
            loader.setPath('https://threejs.org/examples/textures/cube/pisa/');

            const textureCube = loader.load([
                'px.png', 'nx.png',
                'py.png', 'ny.png',
                'pz.png', 'nz.png'
            ]);

            let mesh = new THREE.MeshStandardMaterial({
                color: 0xb21414,
                envMap: textureCube,
                metalness: .2,
                roughness: 0.0
            });

            var objects = []
            for (let i = 0; i < 60; i++) {
                let g = new THREE.ExtrudeGeometry(shape, {
                    depth: 50,
                    bevelEnabled: true,
                    bevelThickness: 5,
                    bevelSize: 5,
                    bevelSegments: 20,
                    curveSegments: 20
                });
                g.scale(.05, .05, .05);
                g.center();
                g.rotateX(-Math.PI * .5);
                let xslot = Math.floor(i / 8) - 2
                let zslot = (i % 8) - 4
                g.translate(-xslot * 14 - 30, 10, zslot * 13 );
                // g.rotateZ(Math.PI * 0.1);
                g.rotateX(Math.PI * -0.5);
                g.rotateY(Math.PI * -0.2);
                o = new THREE.Mesh(g, mesh);
                o.deg=Math.random() * 360
                scene.add(o);
                objects.push(o)

            }

            renderer.setAnimationLoop(_ => {
                renderer.render(scene, camera);

                for (let x in objects) {
                    let obj = objects[x]
                    obj.position.z -= Math.sin(obj.deg) * .05
                    obj.deg += .002
                }

            })


//--------------Observe text effect-----------------------------

            const inputText = `<?php the_field('second_header_text'); ?>`
            for (let n in inputText.split(" ")) {
                x = Math.random() * 2 - 1
                y = Math.random() * 2 - 1
                r = Math.random() * 2 - 1
                let wrd = inputText.split(" ")[n]
                wrd = wrd + "&nbsp;"

                var addClass = ""
                if(wrd.substring(0, 1) == "~"){
                    addClass = "mainColor"
                    wrd = wrd.substring(1)
                }
                $(".secondHeaderText").append('<div class="secondHeaderWord flutter '+addClass+'" data-x=' + x + ' data-y=' + y + ' data-r=' + r + '><span>' + wrd + '</span></div>')
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