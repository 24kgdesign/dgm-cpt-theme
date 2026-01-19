<?php get_header(); ?>

<main id="main-content">
<div id="hero" class="hero-banner">



  <div class="hero-card">
    <div class="hero-content content-card">
      <h1 class="hero-heading">DANNY GODINEZ</h1>
      <h2 class="hero-kicker">Hello and welcome!</h2>

      <p class="hero-lede">
        2026 has arrived! I’m looking forward to performing at The Royal Room and North City Bistro this February. I’m also thrilled to continue on the music faculty at Shoreline Community College this year.

        In addition, I’m accepting private students in my South Seattle studio and continuing to collaborate and perform with a wide range of incredible artists here in Seattle.

        Onward! 
      </p>

      <div class="social-icons-row" aria-label="Social links">
        <a href="https://www.facebook.com/dannygodinezmusic" target="_blank" aria-label="Visit Danny Godinez on Facebook">
          <img src="<?php echo get_template_directory_uri(); ?>/icons/square-facebook-brands.svg" alt="" role="presentation" aria-hidden="true">
        </a>

        <a href="https://www.instagram.com/dannygodinezguitar" target="_blank" aria-label="Visit Danny Godinez on Instagram">
          <img src="<?php echo get_template_directory_uri(); ?>/icons/instagram-brands 2.svg" alt="" role="presentation" aria-hidden="true">
        </a>

        <a href="https://www.youtube.com/watch?v=CrWJmF7BXAM" target="_blank" aria-label="Visit Danny Godinez on YouTube">
          <img src="<?php echo get_template_directory_uri(); ?>/icons/square-youtube-brands.svg" alt="" role="presentation" aria-hidden="true">
        </a>

        <a href="https://dannygodinez.bandcamp.com/album/prequel" target="_blank" aria-label="Visit Danny Godinez on Bandcamp">
          <img src="<?php echo get_template_directory_uri(); ?>/icons/bandcamp_logo_icon5.svg" alt="" role="presentation" aria-hidden="true">
        </a>

        <a href="https://soundcloud.com/annyodinez" target="_blank" aria-label="Visit Danny Godinez on SoundCloud">
          <img src="<?php echo get_template_directory_uri(); ?>/icons/soundcloud-brands 1.svg" alt="" role="presentation" aria-hidden="true">
        </a>
      </div>
    </div>
  </div>
</div>


<?php
// Hide special event after Nov 30, 2025
$event_expiration = ('20260228');
$today = date('Ymd');

if ($today < $event_expiration) :
?>
  <section id="special-event" class="special-event opacity-0 translate-y-6 transition-all duration-700 ease-out content-card">
    <img src="<?php echo get_template_directory_uri(); ?>/images/2026_02_27_All_Things_Danny_Godinez_FB_Event_Cover.jpg" 
      alt="Danny Godinez live at Royal Room Feb 27 2026" 
      class="event-image">
    
    <a 
      href="https://thestranger.boldtypetickets.com/events/178236416/all-things-danny-godinez"
      target="_blank"
      rel="noopener nreferrer"
      aria-label="Buy tickets for this event (opens in new tab)"
      ><h3>
    Buy Tickets</h3>
  </a>

  </section>
<?php endif; ?>

<div id="events-div">
  <h2>Upcoming Shows</h2>

  <div id="events-area" class="events-scroll-wrapper">
    <?php
    date_default_timezone_set('America/Los_Angeles');

    $today_dt = new DateTime('today');

    $events = new WP_Query([
      'post_type'      => 'event',
      'posts_per_page' => -1,
      'meta_key'       => 'event_date',
      'orderby'        => 'meta_value_num',
      'order'          => 'ASC',
    ]);

    if ($events->have_posts()) :
      echo '<div class="events-list">';

      $all_instances = [];

      while ($events->have_posts()) : $events->the_post();

        // Base fields
        $event_name  = get_field('event_name') ?: get_the_title();
        $event_date  = get_field('event_date'); // Ymd
        $time        = get_field('time');       // H:i:s
        $end_time    = get_field('end_time');   // H:i:s (optional)
        $time_notes  = get_field('time_notes'); // optional
        $location    = get_field('location');
        $link        = get_field('link');

        // Recurrence
        $is_recurring     = (bool) get_field('is_recurring');
        $recurrence_type  = get_field('recurrence_type');
        $repeat_every     = (int) get_field('recurrence_freq');
        $repeat_until     = get_field('recurrence_until');

        $instances = [];

        $start_date = DateTime::createFromFormat('Ymd', $event_date);
        if (!$start_date) continue;

        $until_date = null;
        if ($is_recurring && $repeat_until) {
          $until_date = DateTime::createFromFormat('Ymd', $repeat_until);
        }

        // Skip invalid recurring events
        if ($is_recurring && !$until_date) continue;

        $max_instances = 60;

        if ($is_recurring && $repeat_every > 0) {
          switch ($recurrence_type) {
            case 'daily':   $interval = new DateInterval("P{$repeat_every}D"); break;
            case 'weekly':  $interval = new DateInterval("P{$repeat_every}W"); break;
            case 'monthly': $interval = new DateInterval("P{$repeat_every}M"); break;
            default:        $interval = null;
          }

          if ($interval) {
            $current = clone $start_date;
            $count = 0;

            while ($count < $max_instances && $current <= $until_date) {
              if ($current >= $today_dt) {
                $instances[] = clone $current;
              }
              $current->add($interval);
              $count++;
            }
          }
        } else {
          if ($start_date >= $today_dt) {
            $instances[] = $start_date;
          }
        }

        foreach ($instances as $instance_date) {
          $all_instances[] = [
            'date'       => $instance_date,
            'title'      => $event_name,
            'time'       => $time,
            'end_time'   => $end_time,
            'time_notes' => $time_notes,
            'location'   => $location,
            'link'       => $link,
          ];
        }

      endwhile;

      usort($all_instances, function ($a, $b) {
        return $a['date'] <=> $b['date'];
      });

      foreach ($all_instances as $event) : ?>
        <div class="event-block">

          <h3><?php echo esc_html($event['title']); ?></h3>

          <p>
            <strong>Date:</strong>
            <?php echo esc_html($event['date']->format('F j, Y')); ?>
          </p>

          <?php if (!empty($event['time'])) : ?>
            <p>
              <strong>Time:</strong>
              <?php
                echo esc_html(
                  date('g:i a', strtotime($event['time']))
                );

                if (!empty($event['end_time'])) {
                  echo ' – ' . esc_html(
                    date('g:i a', strtotime($event['end_time']))
                  );
                }

                if (!empty($event['time_notes'])) {
                  echo ' <span class="time-notes">('
                    . esc_html($event['time_notes'])
                    . ')</span>';
                }
              ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($event['location'])) : ?>
            <p>
              <strong>Location:</strong>
              <?php echo esc_html($event['location']); ?>
            </p>
          <?php endif; ?>

          <?php if (!empty($event['link'])) : ?>
            <p class="event-link">
              <a href="<?php echo esc_url($event['link']); ?>" target="_blank" rel="noopener">
                Visit Website
              </a>
            </p>
          <?php endif; ?>

        </div>
      <?php endforeach;

      echo '</div>';
      wp_reset_postdata();

    else :
      echo '<p>No upcoming events found.</p>';
    endif;
    ?>
  </div>
</div>

  <section id="music-title">
    <h2>Music</h2>
    <?php echo do_shortcode('[ai_playlist id="39"]'); ?>
  </section>

<section id="videos-title" class="opacity-0 translate-y-6 transition-all duration-700 ease-out reveal-on-scroll">
  <h2>Videos</h2>
    <div class="video-section">
      <div class="video-grid" tabindex="0">

        <div class="video-thumbnail" data-video="xqfAiiXBMgs" role="button" tabindex="0" aria-label="Play Video 1">
          <img src="https://img.youtube.com/vi/xqfAiiXBMgs/hqdefault.jpg" alt="Bainbridge Island Museum of Art - Momentum 2021">
          <h3>Bainbridge Island Museum of Art - Momentum</h4>
        </div>

        <div class="video-thumbnail" data-video="WVbVWv8OJWY" role="button" tabindex="0" aria-label="Play Video 2">
          <img src="https://img.youtube.com/vi/WVbVWv8OJWY/hqdefault.jpg" alt="Pick of the Day">
          <h3>Emerald City Guitars - Pick of the Day</h4>
        </div>

        <div class="video-thumbnail" data-video="hAQyNDJ0NPY" role="button" tabindex="0" aria-label="Play Video 3">
          <img src="https://img.youtube.com/vi/hAQyNDJ0NPY/hqdefault.jpg" alt="Friends Pick Friday">
          <h3>Emerald City Guitars - Friends Pick Friday</h4>
        </div>
      </div>

          <div class="youtube-footer-link">
            <a href="https://www.youtube.com/@dannygodinez8941" target="_blank" role="presentation" aria-hidden="true">Watch More Videos</a>
          </div>

    </div>
      
</section>

<div id="about-title">
  <h2>About</h2>
  <section class="about">
    <!-- <h2>About</h2> -->
    <div class="about-section">
      <p class=about-indent>
        Danny Godinez is known for his intricate acoustic fingerstyle and percussive guitar playing. 
        He has performed with renowned artists such as Carlos Santana, Johnny Lang, Tim Reynolds, 
        and Jason Mraz, among many others. A longtime collaborator with Michael Shrieve (of Santana), 
        Danny appears on two albums under Michael Shrieve’s Spellbinder.
      </p>
      <p>
        He has also toured, recorded, and collaborated with Native American singer Pura Fé 
        (Ulali, Robbie Robertson). As founder of the Danny Godinez Band, he has toured extensively 
        across the lower 48 states, Alaska, Europe, and Asia.
      </p>
      <p>
        Based in Seattle, Danny is a vibrant presence in the local music scene. He maintains a weekly 
        Monday night residency at the historic Owl ’n Thistle Irish Pub with his band — the same venue 
        where he played his first Seattle gig nearly three decades ago.
      </p>
      <p>
        In addition to performing, Danny is passionate about music education. He teaches guitar both 
        privately in his home studio and at Shoreline Community College.
      </p>
    </div> 
  </section>
</div>

<section id="contact-title">
  <h2>Contact</h2>
  <?php echo do_shortcode('[wpforms id="56"]'); ?>
</section>
</main>

<?php get_footer(); ?>
