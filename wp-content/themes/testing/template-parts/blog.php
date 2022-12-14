    <!-- Services-->
    <section class="page-section" id="services">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">Services</h2>
          <h3 class="section-subheading text-muted">
            Lorem ipsum dolor sit amet consectetur.
          </h3>
        </div>
        <?php $services = query_posts( 'post_type=wporg_service' ); ?>
        <div class="row text-center">
          <?php if($services): ?>
          <?php foreach($services as $service): ?>
            <?php $custom = get_post_custom($service->ID);?>
            <?php $icon = $custom['icon'][0];?>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fas fa-circle fa-stack-2x text-primary"></i>
              <i class="fas <?php echo $icon; ?> fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="my-3"><?php echo $service->post_title; ?></h4>
            <p class="text-muted">
              <?php echo $service->post_content ?>
            </p>
          </div>
          <?php endforeach;?>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Blog-->
    <section class="page-section bg-light" id="blog">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">Blog</h2>
          <h3 class="section-subheading text-muted">
            Lorem ipsum dolor sit amet consectetur.
          </h3>
        </div>
        <div class="row">
            <?php
            if (have_posts()) {
                while (have_posts()) :
                    the_post();
            ?>
                <div class="col-lg-4">
                <article class="post" data-id="<?php the_ID();?>">
                    <?php if(has_post_thumbnail()) : ?>
                        <img
                            class="mx-auto rounded-circle"
                            src="<?php the_post_thumbnail();?>"
                            alt="..."
                        />
                    <?php endif; ?>
                    <p class="text-muted wp-category"><?php the_category(', ');?></p>
                    <small>Creado el <?php the_time('F jS, Y'); ?> por <?php the_author_posts_link(); ?></small>
                    <a class="wp-post-link" 
                        href="<?php the_permalink();?>" 
                        title="Permanent Link to <?php the_title_attribute(); ?>"
                    >
                        <h4><?php the_title(); ?></h4>
                    </a>
                    <div class="row">
                        <div class="excerpt col-lg-8 mx-auto text-center">
                            <?php the_excerpt( 'Ver más...', true );?>
                        </div>
                    </div>
                    <p class="postmetadata">
                        <strong>|</strong>
                        <?php edit_post_link('Edit','','<strong>|</strong>'); ?>  
                        <?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></p> 
                    </p>
                </article>
                </div>
            <?php
                endwhile;
            } else {
            ?>
                <p><?php _e( 'Sorry, no posts matched your criteria.' );?>
            <?php
            }
            ?>
            <div class="navigation">
              <?php the_posts_pagination();?>
            </div>

        </div>
      </div>
    </section>
    <!-- Clients-->
    <div class="py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-3 col-sm-6 my-3">
            <a href="#!"
              ><img
                class="img-fluid img-brand d-block mx-auto"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logos/microsoft.svg"
                alt="..."
            /></a>
          </div>
          <div class="col-md-3 col-sm-6 my-3">
            <a href="#!"
              ><img
                class="img-fluid img-brand d-block mx-auto"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logos/google.svg"
                alt="..."
            /></a>
          </div>
          <div class="col-md-3 col-sm-6 my-3">
            <a href="#!"
              ><img
                class="img-fluid img-brand d-block mx-auto"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logos/facebook.svg"
                alt="..."
            /></a>
          </div>
          <div class="col-md-3 col-sm-6 my-3">
            <a href="#!"
              ><img
                class="img-fluid img-brand d-block mx-auto"
                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logos/ibm.svg"
                alt="..."
            /></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact-->
    <section class="page-section" id="contact">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">Contact Us</h2>
          <h3 class="section-subheading text-muted">
            Lorem ipsum dolor sit amet consectetur.
          </h3>
        </div>
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
          <div class="row align-items-stretch mb-5">
            <div class="col-md-6">
              <div class="form-group">
                <!-- Name input-->
                <input
                  class="form-control"
                  id="name"
                  type="text"
                  placeholder="Your Name *"
                  data-sb-validations="required"
                />
                <div class="invalid-feedback" data-sb-feedback="name:required">
                  A name is required.
                </div>
              </div>
              <div class="form-group">
                <!-- Email address input-->
                <input
                  class="form-control"
                  id="email"
                  type="email"
                  placeholder="Your Email *"
                  data-sb-validations="required,email"
                />
                <div class="invalid-feedback" data-sb-feedback="email:required">
                  An email is required.
                </div>
                <div class="invalid-feedback" data-sb-feedback="email:email">
                  Email is not valid.
                </div>
              </div>
              <div class="form-group mb-md-0">
                <!-- Phone number input-->
                <input
                  class="form-control"
                  id="phone"
                  type="tel"
                  placeholder="Your Phone *"
                  data-sb-validations="required"
                />
                <div class="invalid-feedback" data-sb-feedback="phone:required">
                  A phone number is required.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-group-textarea mb-md-0">
                <!-- Message input-->
                <textarea
                  class="form-control"
                  id="message"
                  placeholder="Your Message *"
                  data-sb-validations="required"
                ></textarea>
                <div
                  class="invalid-feedback"
                  data-sb-feedback="message:required"
                >
                  A message is required.
                </div>
              </div>
            </div>
          </div>
          <!-- has successfully submitted-->
          <div class="d-none" id="submitSuccessMessage">
            <div class="text-center text-white mb-3">
              <div class="fw-bolder">Form submission successful!</div>
            </div>
          </div>
          <!-- has error on submit-->
          <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">
              Error sending message!
            </div>
          </div>
          <!-- Submit Button-->
          <div class="text-center">
            <button
              class="btn btn-primary btn-xl text-uppercase"
              id="submitButton"
              type="submit"
            >
              Send Message
            </button>
          </div>
        </form>
      </div>
    </section>