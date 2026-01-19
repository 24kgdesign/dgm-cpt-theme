<footer class="site-footer">
  <div class="footer-content">
    <p>&copy; <?php echo date('Y'); ?> Godinez Music. All rights reserved.</p>
    <p>Website by <a href="https://www.24kgdesign.com/portfolio" target="_blank" aria-label="Visit LaMonte Golden for Web Design">LaMonte Golden</a> Photos by <a href="https://facebook.com/mona.anastas" target="_blank" aria-label="Visit Mona Anastas on Facebook" rel="noopener">Mona Anastas</a></p>
    <div class="footer-social-icons">
      <a href="https://www.facebook.com/danny.godinez.96" target="_blank" aria-label="Visit Danny Godinez on Facebook"><img src="<?php echo get_template_directory_uri(); ?>/icons/square-facebook-brands.svg" alt="" role="presentation" aria-hidden="true"></a>
      <a href="https://www.instagram.com/dannygodinezguitar/" target="_blank" aria-label="Visit Danny Godinez on Instagram"><img src="<?php echo get_template_directory_uri(); ?>/icons/instagram-brands 2.svg" alt="" role="presentation" aria-hidden="true"></a>
      <a href="https://www.youtube.com/watch?v=CrWJmF7BXAM&list=PLJPMYJBMIetC68tMeGftHNSGks7xJBu7P" target="_blank" aria-label="Visit Danny Godinez on Youtube"><img src="<?php echo get_template_directory_uri(); ?>/icons/square-youtube-brands.svg" alt="" role="presentation" aria-hidden="true"></a>
      <a href="https://dannygodinez.bandcamp.com/album/prequel" target="_blank" aria-label="Visit Danny Godinez on Bandcamp"><img src="<?php echo get_template_directory_uri(); ?>/icons/bandcamp_logo_icon5.svg" alt="" role="presentation" aria-hidden="true"></a>
      <a href="https://soundcloud.com/annyodinez" target="_blank" aria-label="Visit Danny Godinez on Soundclound"><img src="<?php echo get_template_directory_uri(); ?>/icons/soundcloud-brands 1.svg" alt="" role="presentation" aria-hidden="true"></a>
  </div>

 

</footer>
<!-- Event Image Modal -->
  <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-label="Expanded event image">
    <span class="close" aria-label="Close image popup">&times;</span>
    <img class="modal-content" id="modalImage" alt="Expanded event poster">
  </div>

  <div id="videoModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <iframe src="" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>

  <!-- Testimonial Pop Up Section -->

  <div id="testimonial-popup" 
    class="testimonial-popup"
    role="dialog"
    aria-live="assertive"
    aria-label="Testimonial from Michael Shrieve"
    aria-modal="true">
    <button id="close-popup" aria-label="Close popup">&times;</button>
      <blockquote>
        “Danny Godinez plays guitar just the way I like it; with fire and beauty, grace and melody, intensity and passion.”
        <cite>— Michael Shrieve, Santana</cite>
      </blockquote>
  </div>

  <?php wp_footer(); ?>
</body>
</html>