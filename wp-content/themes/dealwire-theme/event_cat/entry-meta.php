<?php global $authordata; ?>
<?php
$start_date_epoch = get_post_meta( get_the_ID(), 'event-start-date', true );
$end_date_epoch = get_post_meta( get_the_ID(), 'event-date', true );
$start_dt = new DateTime("@$start_date_epoch");
$end_dt = new DateTime("@$end_date_epoch");
?>
<div class="entry-meta">
<span class="meta-prep meta-prep-author"><?php _e('By', 'fivehundred'); ?> </span>
<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( 'View all articles by %s', 'fivehundred' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
<span class="meta-sep"> | </span>

<?php if( !empty( $start_date_epoch ) && !empty( $end_date_epoch ) ) : ?>
    <span class="entry-date">
        <span style="font-size: 12.5px; font-weight: 400;" class="event-date" title="<?php echo $start_dt->format('Y-m-d') . ' - ' . $end_dt->format('Y-m-d') ?>"><?php echo $start_dt->format('Y-m-d') . ' - ' . $end_dt->format('Y-m-d'); ?></span></span>
<?php endif; ?>
</div>