<div class="spacer team1 m-t-20">
    <div class="container">
        <div class="row justify-content-center m-b-30">
            <div class="col-md-7 text-center">
            <h2 class="title"><?php the_field('about_team_title'); ?></h2>
                <h6 class="subtitle"><?php the_field('about_team_text'); ?></h6>
            </div>
        </div>
        <?php 
        $about_teams = get_field('about_teams');
        if($about_teams){
        ?>
            <div class="row m-t-30">
                <?php 
                foreach ($about_teams as $team) {
                ?>
                    <div class="col-lg-12">
                        <div class="card card-shadow">
                            <!-- Row -->
                            <div class="row no-gutters ">
                                <div class="col-md-5 pro-pic" style="background:url(<?php echo $team['photo']['sizes']['thumbnail']; ?>) center center no-repeat; background-size: cover"></div>
                                <div class="col-md-7 bg-white">
                                    <div class="p-30">
                                        <h5 class="title m-t-0 m-b-0 font-medium"><?php echo $team['name']; ?></h5>
                                        <p class="m-t-5 m-b-5"><small><?php echo $team['position']; ?></small></p>
                                        <p><?php echo $team['description']; ?></p>
                                        <ul class="list-inline">
                                            <?php 
                                            if($team['linkedin']){
                                                echo '<li class="list-inline-item"><a target="_blank" href="'. $team["linkedin"] .'"><i class="fa fa-linkedin"></i></a></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Row -->
                        </div>
                    </div>
                <?php 
                } 
                ?>
            </div>
        <?php 
        }
        ?>
    </div>
</div>