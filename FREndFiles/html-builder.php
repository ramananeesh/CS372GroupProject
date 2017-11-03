<?php

/* Function: adds header information
Parameter1: Optionally title name insert
Parameter2: Optionally add a page description */
function insertHeader($title = NULL, $descrip = NULL){
    echo '<meta charset="utf-8">';
    echo '<link rel="tempbox icon" href="./images/logo.ico" />';
    
    if($title != NULL){
        echo "<title>$title</title>";
    }
    
    if($descrip != NULL){
        echo '<meta name="description" content="' . $descrip . '">';
    }
}

/* Function: add Nav bar 
Parameter1: Optionally indicate which nav link is active*/
function insertNav($active = NULL){
    echo '<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="index.html" id="dashboardLogo">
                <img src="./images/logo.ico" width="25px" height="25px"> Doc -> Dash
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto" id="links1">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.html"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ur-user.html" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> Quick Send</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" id="links2">
                    <li class="nav-item">
                        <a class="nav-link" href="./login.html"><i class="fa fa-sign-in" aria-hidden="true"></i> Login/Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.html"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.html"><i class="fa fa-address-book" aria-hidden="true"></i> Contact Us</a>
                    </li>
                </ul>
            </div>
        </nav>';
}



/* Function: Add team member Cards  */
function insertTeam(){
    
    $members = teamBuilder();
    
    foreach ($members as $worker) {
        echo '<div class="col-md-6">
                            <div class="team-info">
                                <div class="img-sec">
                                    <img src="' . $worker["img"] . '" width="254px" height="254px" class="img-responsive">
                                </div>
                                <div class="fig-caption">
                                    <h3>' . $worker["name"] . '</h3>
                                    <p class="marb-20">' . $worker["title"] . '</p>
                                    <p>Follow me:</p>
                                    <ul class="team-social">
                                        <li class="bgblue-dark"><a href="' .  $worker["links"]["fb"] . '"><i class="fa fa-facebook"></i></a></li>
                                        <li class="bgred"><a href="' .  $worker["links"]["gp"] . '"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="bgblue-light"><a href="' .  $worker["links"]["tw"] . '"><i class="fa fa-twitter"></i></a></li>
                                        <li class="bgblue-dark"><a href="' .  $worker["links"]["li"] . '"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>';
    }
}

/* This should probably be pulled from the database */
function teamBuilder(){
    $team = [];
    
    $member = [ "img" => './images/profilePic_AneeshRaman.png',
                "name" => 'Aneesh Raman',
                "title" => 'Developer',
                "links" => array(
                                "fb" => 'https://www.facebook.com/aneeshraman97',
                                "tw" => '#',
                                "gp" => '#',
                                "li" => 'https://www.linkedin.com/in/aneesh-raman/'
                            )
              ];
    
    array_push($team, $member);
    
    $member = [ "img" => './images/profilePic_JoelStauffer.jpg',
                "name" => 'Joel Stauffer',
                "title" => 'Developer',
                "links" => array(
                                "fb" => 'https://www.facebook.com/joel.stauffer.54',
                                "tw" => '#',
                                "gp" => '#',
                                "li" => '#'
                            )
                ];
    
    array_push($team, $member);
    
    $member = ["img" => './images/profilePic_MatthewHunt.jpg',
                        "name" => 'Matthew Hunt',
                        "title" => 'Developer',
                        "links" => array(
                                        "fb" => '#',
                                        "tw" => '#',
                                        "gp" => '#',
                                        "li" => '#'
                                    )];
    
    array_push($team, $member);
    
    return $team;
}

?>