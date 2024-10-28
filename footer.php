<?php
// Template Name: Footer 
wp_footer();
?>
<?php
$page = get_page_by_path('footer');
?>

<footer class="footer footerSection">

    <div class="row ">
        <div class="leftRow"> 
            <span class="mdi mdi-copyright"> Copywrite 2024 Kilanicorp</span>
            <a href="https://ezstacksystems.com" class="attribution"><span class="mdi mdi-xml"> Dev & Design ezStackSystems.com</span></a>
        </div>
        <div class="rightRow">
            <a href="<?php the_field('li_link'); ?>"><span class="mdi mdi-linkedin"></span></a>
            <a href="<?php the_field('tw_link'); ?>"><span class="mdi mdi-twitter"></span></a>
            <a href="<?php the_field('fa_link'); ?>"><span class="mdi mdi-facebook"></span></a>
        </div>
    </div>
</footer>