<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DealWire
 */

?>

	</div><!-- #content -->

</div><!-- #page -->
<footer>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Deals</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Forums</a></li>
            <li><a href="#">Account</a></li>
        </ul>
    </nav>
    <p>Copyright &copy; 2017 &mdash; DealWire.co</p>
</footer>


<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory') ?>/vendors/js/jquery-3.2.1.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/vendors/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory') ?>/resources/js/script.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRqPv86iUa_FOseGUremm9ZpgBE1mLAW4&callback=initMap">
</script>
</body>
</html>
