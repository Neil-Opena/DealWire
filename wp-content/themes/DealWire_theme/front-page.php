<?php get_template_part('front-page-header'); ?>

<?php
//What is DealWire Section
$dealwire_section_title = get_field('dealwire_section_title');
$dealwire_section_text = get_field('dealwire_section_text');
$dealwire_section_button_text = get_field('dealwire_section_button_text');
$dealwire_section_link = get_field('dealwire_section_link');

//Our Services Section
$services_section_title = get_field('services_section_title');
$service_one_title = get_field('service_one_title');
$service_one_icon = get_field('service_one_icon');
$service_one_description = get_field('service_one_description');
$service_two_title = get_field('service_two_title');
$service_two_icon = get_field('service_two_icon');
$service_two_description = get_field('service_two_description');
$service_three_title = get_field('service_three_title');
$service_three_icon = get_field('service_three_icon');
$service_three_description = get_field('service_three_description');

//Trending Event Section
$event_image = get_field('event_image');
$event_title = get_field('event_title');
$event_date = get_field('event_date');
$event_description = get_field('event_description');
$event_link = get_field('event_link');
$event_button_text = get_field('event_button_text');


//Register Now Section
$register_section_title = get_field('register_section_title');
$register_section_description = get_field('register_section_description');
$register_section_button_text = get_field('register_section_button_text');
$register_section_button_link = get_field('register_section_button_link');
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
                <h2><?php echo $services_section_title; ?></h2>
                <div class="service">
                    <i class="service-symbol fa <?php echo $service_one_icon; ?> fa-2x" aria-hidden="true"></i>
                    <h4><?php echo $service_one_title; ?></h4>
                    <p><?php echo $service_one_description; ?></p>
                </div>
                <div class="service">
                    <i class="service-symbol fa <?php echo $service_two_icon; ?> fa-2x" aria-hidden="true"></i>
                    <h4><?php echo $service_two_title; ?></h4>
                    <p><?php echo $service_two_description; ?></p>
                </div>
                <div class="service">
                    <i class="service-symbol fa <?php echo $service_three_icon; ?> fa-2x" aria-hidden="true"></i>
                    <h4><?php echo $service_three_title; ?></h4>
                    <p><?php echo $service_three_description; ?></p>
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
                <img src="<?php echo $event_image['url']; ?>" alt="<?php echo $event_image['alt']; ?>" class="img-responsive img-thumbnail event-img">
            </div>
            <div class="col-sm-6 event-content">
                <h3><?php echo $event_title; ?></h3>
                <p><?php echo $event_date; ?></p>
                <p class="event-summary">
                <?php echo $event_description; ?>
                </p>
                <a href="<?php echo $event_link; ?>" class="btn btn-lg btn-active"><?php echo $event_button_text; ?></a>
            </div>
        </div>
    </div>
</section>

<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 register-content purple">
                <h2><?php echo $register_section_title; ?></h2>
                <p>
                <?php echo $register_section_description; ?>
                </p>

                <a href="<?php echo $register_section_button_link; ?>" class="btn btn-lg btn-active"><?php echo $register_section_button_text; ?></a>
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