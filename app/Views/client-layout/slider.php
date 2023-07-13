<!-- Slider start -->
<section id="home" class="no-padding">
    <div id="main-slide" class="cd-hero">
        <ul class="cd-hero-slider">
            <?php foreach ($images as $index => $image) : ?>
              
                    <li <?php if ($index === 0) echo 'class="selected"'; ?>>
                        <div class="overlay2">
                            <img class="" src="<?= base_url('admin-template/slide/' . $image['file_name']); ?>" alt="slider">
                        </div>
                        <div class="cd-full-width">
                            <h2>Need To Invent The Future!</h2>
                            <h3>We Making Difference To Great Things Possible</h3>
                            <a href="#0" class="btn btn-primary white cd-btn">Start Now</a>
                            <a href="#0" class="btn btn-primary solid cd-btn">Learn More</a>
                        </div> <!-- .cd-full-width -->
                    </li>
               
            <?php endforeach; ?>
          
        </ul> <!--/ cd-hero-slider -->
        <div class="cd-slider-nav">
            <nav>
                <?php foreach ($images as $index => $imageArray) : ?>
                    <span class="cd-marker item-<?= $index + 1; ?>"></span>
                    
                <?php endforeach; ?>
                <ul>
                    <?php foreach ($images as $index => $imageArray) : ?>
                       
                            <li <?php if ($index === 0) echo 'class="selected"'; ?>>
                                <a href="#0">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </li>
                      
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div> <!-- .cd-slider-nav -->
    </div><!--/ Main slider end -->
</section> <!--/ Slider end -->
