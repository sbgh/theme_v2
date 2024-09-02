<?php
// Template Name: Footer 
wp_footer();
?>
<?php
    $page = get_page_by_path('footer'); 
?>

<footer class="footer footerSection">

    <div class="row ">



    <div class="leftRow"> <span class="mdi mdi-copyright"></span>   Copywrite 2024 Kilanicorp</div>
    <div class="rightRow">
        <span class="mdi mdi-linkedin"></span>
        <span class="mdi mdi-twitter"></span>
        <span class="mdi mdi-facebook"></span>
    </div>


        <!-- <div class="col footer-details">
            <div class="footer-logo" style="background-image:url(<?php the_field('logo_image', $page->ID); ?>);"></div>
            <div class="footer-address"><?php the_field('address', $page->ID);?></div>
            <div class="footer-text"><?php the_field('footer-text', $page->ID);?></div>
            <div class="footer-tel-email">
                <div class="footer-tel"><a href="tel:<?php the_field('telephone', $page->ID);?>"><?php the_field('telephone', $page->ID);?></a></div>
                <div class="footer-email">Email: <a href="mailto:<?php the_field('email', $page->ID);?>"><?php the_field('email', $page->ID);?></a></div>
            </div>
        </div>

        <div class="col-4 footer-map">
            <div class="footerMap map-responsive"><iframe frameborder="0"
                    src="https://www.google.com/maps/embed/v1/place?key=<?php the_field('google_maps_key', $page->ID);?>&amp;q=the+metropolitan+1235+11+ave+sw+calgary+ab+t3c+0m5"
                    allowfullscreen="">
            </iframe></div>
        </div> -->
    </div>
</footer>

</body>

</html>