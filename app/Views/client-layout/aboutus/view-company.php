<!-- Company Profile -->
<div class="row">
    <div class="col-md-12 heading">
        <span class="title-icon classic pull-left"><i class="fa fa-suitcase"></i></span>
        <h2 class="title classic">Company Profile</h2>
    </div>
</div><!-- Title row end -->

<div class="row">
    <div class="landing-tab clearfix">
        <ul class="nav nav-tabs nav-stacked col-md-3 col-sm-5">
            <li class="active">
                <a class="animated fadeIn" href="#tab_a" data-toggle="tab">
                    <span class="tab-icon"><i class="fa fa-info"></i></span>
                    <div class="tab-info">
                        <h3>Who Are We</h3>
                    </div>
                </a>
            </li>
            <li>
                <a class="animated fadeIn" href="#tab_b" data-toggle="tab">
                    <span class="tab-icon"><i class="fa fa-briefcase"></i></span>
                    <div class="tab-info">
                        <h3>Our Company</h3>
                    </div>
                </a>
            </li>
            <li>
                <a class="animated fadeIn" href="#tab_c" data-toggle="tab">
                    <span class="tab-icon"><i class="fa fa-android"></i></span>
                    <div class="tab-info">
                        <h3>What We Do</h3>
                    </div>
                </a>
            </li>
            
            <li>
                <a class="animated fadeIn" href="#tab_d" data-toggle="tab">
                    <span class="tab-icon"><i class="fa fa-support"></i></span>
                    <div class="tab-info">
                        <h3>Dedicated Support</h3>
                    </div>
                </a>
            </li>
        </ul>
        <div class="tab-content col-md-9 col-sm-7">
            <div class="tab-pane active animated fadeInRight" id="tab_a">
                <i class="fa fa-trophy big"></i>
                <h3><?php echo $aboutus[0]['page_title']; ?></h3>
                <p><?php echo $aboutus[0]['description']; ?></p>
            </div>
            <div class="tab-pane animated fadeInLeft" id="tab_b">
                <i class="fa fa-briefcase big"></i>
                <h3><?php echo $aboutus[1]['page_title']; ?></h3>
                <p><?php echo $aboutus[1]['description']; ?></p>
            </div>
            <div class="tab-pane animated fadeIn" id="tab_c">
                <i class="fa fa-android big"></i>
                <h3><?php echo $aboutus[2]['page_title']; ?></h3>
                <p><?php echo $aboutus[2]['description']; ?></p>
            </div>
            <div class="tab-pane animated fadeIn" id="tab_d">
                <i class="fa fa-support big"></i>
                <h3><?php echo $aboutus[3]['page_title']; ?></h3>
                <p><?php echo $aboutus[3]['description']; ?></p>
            </div>
          
        </div><!-- tab content -->
    </div><!-- Overview tab end -->
</div><!--/ Content row end -->

<!-- Company Profile -->
