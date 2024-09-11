<?php get_header(); ?>
<div id="main" class="main">
    <div class="splash">

        <div id="cHolder"></div>
        <nav class="navbar navbar-dark  navbar-expand-lg ">
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

        <div id="splashItems" class="row align-middle">
            <div class="col-md-5">
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

        <svg id="wave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z" fill="#ffffff" />
        </svg>
    </div>


    <div class="secondHeader">

        <div class="secondHeaderText"></div>
        
        <svg id="secondWave" width="1920" height="100" preserveAspectRatio="none" viewBox="0 0 1920 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1330.65 90.2695C1654.87 90.2694 1859.97 30.0905 1922 0.000961304L1922 200.001L0 200.001L-5.63261e-06 135.572C28.5892 109.062 160.3 56.0414 458.431 56.0414C831.094 56.0413 925.389 90.2695 1330.65 90.2695Z" fill="#000000" />
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

</div>

<?php get_footer(); ?>