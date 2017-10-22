<?php get_template_part('front-page-header'); ?>

<?php
//What is DealWire Section
$dealwire_section_title = get_field('dealwire_section_title');
$dealwire_section_text = get_field('dealwire_section_text');
$dealwire_section_button_text = get_field('dealwire_section_button_text');



 ?>


<section id="hero" data-type="background" data-speed="3">
    <div class="container">
        <div class="row">
            <h1 class="hero-text"><span class="blue1">Deal</span><span class="blue2">Wire</span></h1>
            <p class="lead"><?php bloginfo('description') ?></p>
        </div>
    </div>
</section>
<section id="deals">
	<div class="container">
		<h2>Featured Deals</h2>
		<br>
	</div>
	<article >
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) {
		the_post_thumbnail();
		}
		?>
		<?php the_content(); ?>
		<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'fivehundred' ) . '&after=</div>') ?>
		</div>
		</div>
		<?php comments_template( '', true ); ?>
	</article>
</section>

<section id="about">
    <div class="container-fluid">
        <div class="row">
            <h2><?php echo $dealwire_section_title; ?></h2>
            <div class="col-sm-8 col-sm-offset-2">
                <?php echo $dealwire_section_text; ?>
				<div class="row">
                	<a href="#" class="btn btn-lg btn-active"><?php echo $dealwire_section_button_text; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="services-section" data-type="background" data-speed="10">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 white-layer">
                <h2>Our Services</h2>
                <div class="service">
                    <i class="service-symbol fa fa-briefcase fa-2x" aria-hidden="true"></i>
                    <h4>Deal Platform</h4>
                    <p>Our private placement platform allows for a limited number of companies to pair up with private and institutional sources of captial to fund their next stage of growth. Investors can filter deals by type, location, stage (Seed, Series A, etc.), projected returns and more.</p>
                </div>
                <div class="service">
                    <i class="service-symbol fa fa-bullhorn fa-2x" aria-hidden="true"></i>
                    <h4>Market Outreach</h4>
                    <p>Whether you're a startup looking to "test the waters" or an established business looking to increase awareness, we provide a number of web-based digital marketing solutions to our subscripoton base of over 3 million accredited investors.</p>
                </div>
                <div class="service">
                    <i class="service-symbol fa fa-phone fa-2x" aria-hidden="true"></i>
                    <h4>On Call Advisory</h4>
                    <p>From questions regarding valuation to exploring the idea of going public, our "On Call" Advisory service provides entrepreneurs with 1-on-1 mentoring through experienced investment bankers, M&amp;A advisors and other financial professionals.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="event">
    <div class="container-fluid">
        <div class="row">
            <h2>Trending DealWire Event</h2>
            <div class="col-sm-6">
                <img src="<?php bloginfo('stylesheet_directory') ?>/resources/img/nyc.jpg" alt="" class="img-responsive img-thumbnail event-img">
            </div>
            <div class="col-sm-6 event-content">
                <h3>NYC Summer Venture Conference</h3>
                <p>Date: August 3, 2017</p>
                <p class="event-summary">
                At this NYC Event, we will be showcasing a bunch of NEW Early-Stage VC Funds in the NYC area! The VC and Angel panels of early-stage investors will focus on How to meet investors, pitch them, and what it really takes ti get them to write you a check!
                </p>
                <a href="#" class="btn btn-lg btn-active">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 register-content purple">
                <h2>Register Now!</h2>
                <p class="lead">
                    What are you waiting for?
                </p>
                <div class="register-justify">
                <p>Register now and get the unique privileges of being a member of the grwoing community of investors here in Dealwire!</p>
                </div>
                <a href="#" class="btn btn-lg btn-active">Join Now!</a>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-6 white-layer form-container">
                <h2>Contact Us!</h2>
                <p>Contact us now to learn more about how DealWire.co can help you. Simply fill out the form below or call us at <span class="number">(888)-944-4769</span>.</p>
                <p>We are waiting to hear from you!</p>
                <!-- <form method="post">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="name" id="name" placeholder="Your name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" name="email" id="email" placeholder="Your email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="message">Message</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea name="message" id="message" placeholder="Your questions, suggestions, or concerns" cols="30" rows="7"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <input type="submit" class="btn btn-lg btn-active">
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
    <div id="test">

    </div>
</section>

<?php get_footer(); ?>