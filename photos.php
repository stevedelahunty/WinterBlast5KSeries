<!-- photos Section -->
<section id="photos" class="services section">

<!-- Series Standings Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Photos</h2>
    <p>Hopkinton Race #1</p>
</div><!-- End Section Title -->

<div class="container">

    <div class="row gy-4">
<?php
$dir = getcwd();
$photoDir = $dir."/photos/2026";
$files_and_dirs = scandir($photoDir);
//echo "dir = ".$dir;

// Use array_diff() to remove the '.' and '..' entries which represent the current and parent directories
$files = array_diff($files_and_dirs, array('.', '..'));

foreach ($files as $file) {
    $path = "photos/2026/".$file;
    echo "<div class='col-4' >";
    echo "<img src='".$path."' class='img-fluid'>";
    echo "</div>";
}
?>
    </div>
</div>
</section>
