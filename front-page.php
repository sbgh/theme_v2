
<?php get_header(); ?>

<div id="main" class="main">
    <div class="splash">

        <div id="cHolder"></div>
        <nav class="navbar navbar-dark  navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img id="brandImg" src="<?php getMyImage(get_field('brand_image'), "medium"); ?>" alt="it-consulting-services"></a>
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
                        <li>
                            <a id="contactBtn" class="nav-link" href="#">Contact</a>
                        </li>
                        <!-- <li class="nav-item">
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
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>

        <div id="splashItems" class="row align-middle">
            <div class="col col-sm-8 col-md-6 col-lg-4 ">
                <div class="row splashItems">
                    <div class="col">
                        <div class="row splashHeader1">
                            <?php the_field('moto'); ?>
                        </div>
                        <div class="row splashHeader2">
                            <?php the_field('second_moto'); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
            </div>
        </div>


        <div id="imageback" class="imageback"></div>
        <div id="glassback" class="glassback"></div>

        <svg id="wave" class="wave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z" fill="#eaeaea" />
        </svg>
    </div>


    <div class="secondHeader">

        <div class="secondHeaderText"></div>

        <svg id="secondWave" class="wave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z" fill="#ffffff" />
        </svg>

    </div>

    <div id="whyUs" class="why">

        <div class="whyItems row">
            <div class="whyItemsL col col-md-6 col-lg-4">
                <div class="row align-items-center">
                    <div>

                        <div id="whyItemsLText" class="whyItemsLText"></div>
                        <div id="whyItemsLText2" class="whyItemsLText2"></div>
                    </div>
                </div>
            </div>
            <div class="whyItemsR1 col col-md-6  col-lg-4">

                <div id="customCard1" class="customCard">
                    <div class="customCardInner">
                        <div class="customCardSubtitle"></div>
                        <h3 class="customCardText"></h3>
                        <div class="customCardImage">
                            <img class="img-wrapper" src="<?php getMyImage(get_field('why_panel1_image'), "medium_large"); ?>" alt="it-consulting-services" width="800" height="757" style="max-width: 100%; height: auto;">
                            <!-- <?php $id = get_field('why_panel1_image');
                                    echo "$id"; ?> -->
                        </div>
                        <div class="button-container">
                            <!-- <a href="/it-consulting" class="button btn-dark-outline">
                                We'll show you how
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="whyItemsR2 col  col-md-12  col-lg-4">
                <div id="customCard2" class="customCard">
                    <div class="customCardInner">
                        <div class="customCardSubtitle"></div>
                        <h3 class="customCardText"></h3>
                        <div class="button-container">
                            <!-- <a href="/it-consulting" class="button btn-dark-outline">
                                We'll show you how
                            </a> -->
                        </div>
                    </div>
                </div>
                <div id="customCard3" class="customCard">
                    <div class="customCardInner">
                        <div class="customCardSubtitle"></div>
                        <h3 class="customCardText"></h3>
                        <div class="button-container">
                            <!-- <a href="/it-consulting" class="button btn-dark-outline">
                                We'll show you how
                            </a> -->
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <svg id="thirdWave" class="wave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z"
                fill="#eaeaea" />
        </svg>

    </div>

    <div id="services" class="services">
        <div id="servicesTitle" class="servicesTitle"> <?php the_field('services_title'); ?></div>
        <div id="servicesList" class="servicesList"></div>
        <svg id="fourthWave" class="wave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z"
                fill="#000000" />
        </svg>
    </div>

    <!-- Contact Us form -->
    <div id="contactBuffer" class="contactBuffer">
        <a name="contact"></a>
        <div class="contactHolder">
            <div id="contactTitle"><?php the_field('contact_us_title'); ?></div>
            <div id="contactText"><?php the_field('contact_us_text'); ?></div>

            <div id="mainContactContainer">

                <div id="contactFormTitle"><?php the_field('contact_us_form_title'); ?></div>

                <div id="content" class="contactContent">
                    <div class="entry-content-contact">

                        <p class="formError"></p>

                        <div class=" contactInput ">
                            <label for="contactName" class="fieldLabel">Name<span
                                    class="mandatoryAsterisk">*</span>:</label>
                            <div class="inputHolder">
                                <input type="text" name="contactName" id="contactName"
                                    class="required requiredField field" />
                                <div id="nameError" class="formError formItemError"></div>
                            </div>
                        </div>
                        <div class=" contactInput ">
                            <label for="email" class="fieldLabel">Email<span class="mandatoryAsterisk">*</span>:</label>
                            <div class="inputHolder">
                                <input type="email" name="email" id="email"
                                    class="required requiredField field email" />
                                <div id="emailError" class="formError formItemError"></div>
                            </div>
                        </div>
                        <div class=" contactInput ">
                            <label for="phone" class="fieldLabel">Phone Number:</label>
                            <div class="inputHolder">
                                <input type="text" name="phone" class="field" id="phone" />
                            </div>
                        </div>
                        <div class=" contactInput ">
                            <label for="message" class="fieldLabel">Message<span
                                    class="mandatoryAsterisk">*</span>:</label>
                            <div class="messageHolder">
                                <textarea name="message" id="message"
                                    class="required requiredField txtField"></textarea>
                                <div id="messageError" class="formError formItemError"></div>
                                <div class="contactSubmit">
                                    <div id="contactSubmit">Send</div>

                                    <div class="thanksContactMessage">
                                        <?php the_field('thank_you_contact_message'); ?>
                                    </div>
                                    <div class="loader"></div>
                                </div>
                            </div>

                        </div>

                    </div><!-- .entry-content -->
                </div><!-- #content -->
            </div><!-- #container -->
        </div>
    </div>


    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>User Name:</div>
                    <input type="text" id="username">
                    <div>Password:</div>
                    <input type="password" id="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
</div>
</body>

</html>