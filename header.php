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
            let camera = new THREE.PerspectiveCamera(60, innerWidth / innerHeight, 1, 1000);
            camera.position.set(0, 8, -50).setLength(60);
            camera.lookAt(scene.position);
            let renderer = new THREE.WebGLRenderer({
                antialias: true,
                alpha: true
            });
            renderer.setSize(innerWidth, innerHeight);
            // renderer.setClearColor(0xd12020);
            var container = document.getElementById("cHolder");
            container.appendChild(renderer.domElement);

            let controls = new THREE.OrbitControls(camera, renderer.domElement);

            let light = new THREE.DirectionalLight(0xffffff, 1);
            light.position.setScalar(-1);
            scene.add(light, new THREE.AmbientLight(0xffffff, 0.5));

            let shape = new THREE.Shape();
            let angleStep = Math.PI * 0.5;
            let radius = 1;

            shape.absarc(2, 2, radius, angleStep * 0, angleStep * 1);
            shape.absarc(-2, 2, radius, angleStep * 1, angleStep * 2);
            shape.absarc(-2, -2, radius, angleStep * 2, angleStep * 3);
            shape.absarc(2, -2, radius, angleStep * 3, angleStep * 4);

            const loader = new THREE.CubeTextureLoader();
            loader.setPath('https://threejs.org/examples/textures/cube/pisa/');

            const textureCube = loader.load([
                'px.png', 'nx.png',
                'py.png', 'ny.png',
                'pz.png', 'nz.png'
            ]);

            let m = new THREE.MeshStandardMaterial({
                color: 0xb21414,
                envMap: textureCube,
                metalness: .2,
                roughness: 0.0
            });

            for (let i = 0; i < 42; i++) {
                let g = new THREE.ExtrudeGeometry(shape, {
                    depth: 100,
                    bevelEnabled: true,
                    bevelThickness: 0.05,
                    bevelSize: 0.05,
                    bevelSegments: 20,
                    curveSegments: 20
                });
                g.center();
                g.rotateX(Math.PI * 0.6);
                let xslot=Math.floor(i/6) -2
                let zslot=(i % 6) -4
                g.translate(-xslot*8, -50, zslot*8);
                g.rotateX(Math.PI * -0.2);
                g.rotateZ(Math.PI * -0.05);
                g.rotateY(Math.PI * -0.1);
                 o = new THREE.Mesh(g, m);
                // scene.rotation.x += Math.PI * -0.3;
                scene.add(o);
            }


            renderer.setAnimationLoop(_ => {
                renderer.render(scene, camera);
            })



            // function create3DEnvironment() {
            //     var container = document.getElementById("cHolder");
            //     const renderer = new THREE.WebGLRenderer({
            //         alpha: true
            //     })
            //     renderer.setSize(container.clientWidth - 16, container.clientHeight - 16);
            //     container.appendChild(renderer.domElement);

            //     const fieldOfView = 75 // measured in degrees
            //     const aspect = 2 // the canvas default
            //     const near = 0.1
            //     const far = 10000


            //     const camera = new THREE.PerspectiveCamera(fieldOfView, aspect, near, far)
            //     camera.position.z = 2

            //     const scene = new THREE.Scene()

            //     var light = new THREE.DirectionalLight(0xd12020, 1.5);
            //     light.position.setScalar(10);
            //     scene.add(light);
            //     scene.add(new THREE.AmbientLight(0xd12020, 0.5));

            //     const width = 1
            //     const height = 1
            //     const depth = 1
            //     const geometry = new THREE.BoxGeometry(width, height, depth)

            //     const material = new THREE.MeshLambertMaterial({
            //         color: 0x999999,
            //         wireframe: false,
            //         transparent: true,
            //         opacity: 0.85
            //     })

            //     // new THREE.MeshBasicMaterial({
            //     //     color: 0x55555
            //     // })

            //     const cube = new THREE.Mesh(geometry, material)
            //     scene.add(cube)

            //     const animate = (time, speed = 1) => {
            //         time *= 0.001 // given integer converted to seconds
            //         const rotation = time * speed
            //         cube.rotation.x = rotation
            //         cube.rotation.y = rotation

            //         renderer.render(scene, camera)

            //         requestAnimationFrame(animate)
            //     };
            //     requestAnimationFrame(animate)
            // }

            // create3DEnvironment()






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