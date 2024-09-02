<?php get_header(); ?>
<div id="main" class="main">
    <div class="splash">

        <div id="imageback" class="imageback"></div>
        <div id="glassback" class="glassback"></div>
        <div class="splashItems">
            <div class="splashItem">
                <div id="splashTitle" class="splashTitle megrim-regular ucTitle">
                    <p><?php the_field('up_title'); ?></p>
                </div>
                <div id="splashMoto" class="splashMoto">
                    <p><?php the_field('moto'); ?></p>
                </div>
            </div>
            <div class="splashItem">
                <div class="pivot">
                    <div id="keyboard-base" class="keyboard-base">
                        <div class="key">~</div>
                        <div class="key">1</div>
                        <div class="key">2</div>
                        <div class="key">3</div>
                        <div class="key">4</div>
                        <div class="key">5</div>
                        <div class="key">6</div>
                        <div class="key">7</div>
                        <div class="key">8</div>
                        <div class="key">9</div>
                        <div class="key">0</div>
                        <div class="key">-</div>
                        <div class="key">+</div>
                        <div class="key delete">Delete</div>
                        <div class="key tab">Tab</div>
                        <div class="key">Q</div>
                        <div class="key">w</div>
                        <div class="key">E</div>
                        <div class="key">R</div>
                        <div class="key">T</div>
                        <div class="key">Y</div>
                        <div class="key">U</div>
                        <div class="key">I</div>
                        <div class="key">O</div>
                        <div class="key">P</div>
                        <div class="key">[</div>
                        <div class="key">]</div>
                        <div class="key backslash">\</div>
                        <div class="key capslock">CapsLock</div>
                        <div class="key">A</div>
                        <div class="key">S</div>
                        <div class="key">D</div>
                        <div class="key">F</div>
                        <div class="key">G</div>
                        <div class="key">H</div>
                        <div class="key">J</div>
                        <div class="key">K</div>
                        <div class="key">L</div>
                        <div class="key">;</div>
                        <div class="key">'</div>
                        <div class="key return">Return</div>
                        <div class="key leftshift">Shift</div>
                        <div class="key">Z</div>
                        <div class="key">X</div>
                        <div class="key">C</div>
                        <div class="key">V</div>
                        <div class="key">B</div>
                        <div class="key">N</div>
                        <div class="key">M</div>
                        <div class="key">,</div>
                        <div class="key">.</div>
                        <div class="key">/</div>
                        <div class="key rightshift">Shift</div>
                        <div class="key leftctrl">Ctrl</div>
                        <div class="key">Alt</div>
                        <div class="key command">Command</div>
                        <div class="key space">Space</div>
                        <div class="key command">Command</div>
                        <div class="key">Alt</div>
                        <div class="key">Ctrl</div>
                        <div class="key">Fn</div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <div id="whyUs" class="whyUs">
        <div id="whyUsWords" class="whyUsWords"></div>
    </div>
    <div id="services" class="services">
        <div id="serviceList" class="serviceList"></div>
    </div>
    <div id="industries" class="industries">
        <div id="industriesList" class="industriesList"></div>
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


<style>
    .imageback {
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url(<?php getMyImage(get_field('background1'), 'large'); ?>);
    }
</style>
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