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
        body {
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


            const templateName = '<?php $template = get_template();
                                    echo "$template" ?>'

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }



            var svgloader = new THREE.SVGLoader();
            var floader = new THREE.FileLoader()
            // var pathsHolder = svgloader.parse('<svg id="cloudShape"  version="1.1"  viewBox="0 0 256.00007 256.00002"  > <g id="layer1">  <path    id="path10000"    d="m 465.83684,466.9869 c -18.8823,0 -37.6499,7.7751 -51.0017,21.127 -8.4122,8.4121 -14.6043,18.9734 -18.0383,30.3583 -8.2539,1.5581 -16.0492,5.5866 -21.9931,11.5304 -7.7473,7.7473 -12.2573,18.6331 -12.2573,29.5895 0,10.9565 4.51,21.8458 12.2573,29.5931 7.7474,7.7473 18.6367,12.2573 29.5931,12.2573 l 187.4365,0 c 6.9935,0 13.9453,-2.8775 18.8904,-7.8224 4.9452,-4.9451 7.8227,-11.8971 7.8227,-18.8906 0,-6.9935 -2.8775,-13.9417 -7.8227,-18.8868 -4.9147,-4.9149 -11.8119,-7.784 -18.7617,-7.8193 -1.3562,-12.6709 -7.0967,-24.867 -16.1148,-33.8851 -10.3847,-10.3847 -24.9798,-16.4314 -39.666,-16.4314 -3.5656,0 -7.1233,0.3656 -10.6192,1.0539 -2.5582,-3.8175 -5.4715,-7.3951 -8.7235,-10.6469 -13.3518,-13.3519 -32.1193,-21.127 -51.0017,-21.127 z"    style="color:#000000;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;color-interpolation:sRGB;color-interpolation-filters:linearRGB;fill:#808080;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1px;marker:none;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" /> </g></svg>')
            floader.load(
                // resource URL
                '/wp-content/themes/' + templateName + '/images/icon1.svg',
                // called when the resource is loaded
                function(data) {
                    initIconEffect(data)
                })



            function initIconEffect(data) {
                //--------------3d icons effect-----------------------------
                let scene = new THREE.Scene();
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

                // let controls = new THREE.OrbitControls(camera, renderer.domElement);

                let light = new THREE.DirectionalLight(0xffffff, 1);
                light.position.setScalar(.5);
                scene.add(light, new THREE.AmbientLight(0xffffff, 0.5));

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

                let mesh = new THREE.MeshStandardMaterial({
                    color: <?php the_field('icon_color'); ?>, // 0xb21414 ?
                    envMap: textureCube,
                    metalness: .2,
                    roughness: 0.0
                });


                var objects = []
                for (let i = 0; i < 60; i++) {
                    let deg = Math.random() * 360
                    var shapes = icons[Math.floor(Math.random() * icons.length)]; //pick rnd shape
                    for (let q in shapes) {

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

                        o = new THREE.Mesh(g, mesh);
                        o.material.transparent = true
                        o.material.opacity = 0.0
                        o.deg = deg

                        scene.add(o);
                        objects.push(o)
                    }

                }

                var rTime = 0
                renderer.setAnimationLoop(_ => {
                    renderer.render(scene, camera);

                    rTime++
                    if (rTime % 3 == 0) {
                        rTime = 0
                        for (let x in objects) {
                            let obj = objects[x]
                            // obj.position.z -= Math.sin(obj.deg) * .05
                            obj.position.z = Math.sin(obj.deg) * 50
                            obj.deg += .004
                            obj.deg = obj.deg > 360 ? obj.deg -= 360 : obj.deg

                            obj.material.opacity = obj.material.opacity > 1 ? obj.material.opacity = 1 : obj.material.opacity + 0.0001;
                        }
                    }

                })

                function onWindowResize() {

                    renderer.setSize(innerWidth, innerHeight);
                    camera.aspect = innerWidth / innerHeight;
                    camera.updateProjectionMatrix();

                }
                window.addEventListener('resize', onWindowResize, false);

                $("canvas").on("dblclick", function() {
                    let controls = new THREE.OrbitControls(camera, renderer.domElement);
                });
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

            //----------Populate why text------------
            let txt = "<?php the_field('third_moto'); ?>"

            for (let n in txt.split(" ")) {
                let wrd = txt.split(" ")[n]
                wrd = wrd + "&nbsp;"

                var addClass = ""
                if (wrd.substring(0, 1) == "~") {
                    addClass = "mainColor"
                    wrd = wrd.substring(1)
                }
                $("#whyItemsLText").append('<div class="thirdMotoWord ' + addClass + '"><span>' + wrd + '</span></div>')


            }

            //----------Populate why cards------------
            txt = `<?php the_field('why_us'); ?>`
            let txtArr = txt.split("\n")
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