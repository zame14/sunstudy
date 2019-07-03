<?php
$case_study = new CaseStudy($post);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="description"><?=$case_study->getContent()?></div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="shading-images">
                    <?=$case_study->displayGallery()?>
                </div>
            </div>
            <div class="col-12 floor-plans-wrapper">
                <h2>Floor Plans</h2>
                <div class="floor-plan-images">
                    <?=$case_study->displayFloorPlans()?>
                </div>
            </div>
        </div>
    </div>
</article>
