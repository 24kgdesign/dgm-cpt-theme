<?php
/**
 * Archive template for Events CPT
 */

get_header();

/**
 * DATE RANGE (used by all queries)
 */
$today  = date('Ymd');
$future = date('Ymd', strtotime('+365 days'));


/**
 * HERO IMAGE (ACF OPTIONS)
 */
$hero_image = function_exists( 'get_field')
    ? get_field('shows_hero_image', 'option')
    : '';
?>

<main class="shows-page">
    <!-- ========================
     HERO
    ===========================-->
    <section 
        class="shows-hero"
        <?php if ( $hero_image ) : ?>
            style="background-image: url('<?php echo esc_url($hero_image); ?>');"
        <?php endif; ?>
      >
        <div class="shows-hero__overlay">
            <div class="shows-hero__inner">
                <h1>Shows</h1>
                <p>Live music, good rooms, and great nights.</p>
            </div>
        </div>
    </section>    

    <!-- ==========================
     FEATURED SHOWS(3)
     =========================== -->
    <section class="shows-featured">
        <h2>Featured Shows</h2>

        <?php
        $featured_query = new WP_Query([
            'post_type'         => 'event',
            'posts_per_page'    => 3,
            'meta_key'          => 'event_date',
            'orderby'           => 'meta_value',
            'order'             => 'ASC',
            'meta_query'        => [
                [
                    'key'       => 'event_date',
                    'value'     => [$today, $future],
                    'compare'   => 'BETWEEN',
                    'type'      => 'NUMERIC',

                ],
                [
                    'key'       => 'is_featured',
                    'value'     => '1',
                    'compare'   => '=',
                ],
            ],
        ]);
        ?>

        <?php if( $featured_query->have_posts() ) : ?>
            <div class="featured-grid">
                <?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>

                    <article class="featured-card">

                        <?php if ( has_post_thumbnail() ) :?>
                            <div class="featured-flyer">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <h3><?php the_title(); ?></h3>

                        <?php if ( function_exists( 'get_field') ) :
                            $event_date = get_field('event_date');
                            if ( $event_date ) : ?>
                                <p class="event-date">
                                    <?php echo date('F j, Y', strtotime($event_date)); ?>
                                </p>
                        <?php endif; endif; ?>

                        <a href="<?php the_permalink(); ?>" class="event-link">
                            View Details 
                        </a>

                    </article>
            
                <?php endwhile; ?>
            </div>

            <?php wp_reset_postdata();?>
        <?php else : ?>
            <p>No featured shows at this time.</p>
        <?php endif; ?>
    </section>
            
<!-- ============================
            ABOUT ATTENDING
============================= -->
<section class="shows-info">
    <p>
        Come catch Danny live around the Northwest — intimate rooms, great musicians, and nights built around connection and sound.
    </p>
</section>

<!-- =========================
    UPCOMING EVENTS (365 DAYS)
========================== -->
<section class="shows-list">
    <h2>Upcoming Shows</h2>

    <?php
    $events_query = new WP_Query([
        'post_type'         => 'event',
        'posts_per_page'    => -1,
        'meta_key'          => 'event_date',
        'orderby'           => 'meta_value',
        'order'             => 'ASC',
        'meta_query'        => [
            [
                'key'       => 'event_date',
                'value'     => [$today, $future],
                'compare'   => 'BETWEEN',
                'type'      => 'NUMERIC',
            ],
        ],
    ]);
    ?>

    <?php if ( $events_query->have_posts() ) : ?>
        <ul class="events-list">

            <?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>

                <li class="event-row">

                    <div class="event-row__meta">
                        <h3><?php the_title(); ?></h3>

                        <?php if ( function_exists('get_field') ) :
                            $event_date = get_field('event_date'); 
                            if ( $event_date ) : ?>
                                <span class="event-date">
                                    <?php echo date('M j, Y', strtotime($event_date)); ?>
                                </span>
                        <?php endif; endif; ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="event-link">
                        Info
                    </a>

                </li>

            <?php endwhile; ?>

        </ul>    
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>No upcoming shows scheduled.</p>
    <?php endif; ?>
</section>

<!-- ===========================
        BOOKING CTA
============================ -->
    <section class="shows-booking">
        <h2>Booking</h2>
        <p>
            Interested in booking a show or private event? Reach out with dates, location, and details.
        </p>

        <button
            class="btn-booking"
            data-modal-target="#booking-modal">
            Booking Inquiry
        </button>
    </section>

    </main>

    <?php
    get_footer();



