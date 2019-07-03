<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/15/2019
 * Time: 2:46 PM
 */
class CaseStudy extends SSBase
{
    public function getFeatureImage()
    {
        return $this->getPostMeta('feature-image-cs');
    }
    public function getShadingImages()
    {
        $gallery = Array();
        $field = get_post_meta($this->id());
        foreach($field['wpcf-sun-shading-images-cs'] as $image) {
            $gallery[] = $image;
        }
        return $gallery;
    }
    public function getFloorPlans()
    {
        $gallery = Array();
        $field = get_post_meta($this->id());
        foreach($field['wpcf-floor-plans-cs'] as $image) {
            $gallery[] = $image;
        }
        return $gallery;
    }
    public function displayGallery()
    {
        $html = '<ul>';
        foreach ($this->getShadingImages() as $images)
        {
            $imageid = getImageID($images);
            $img = wp_get_attachment_image_src($imageid, 'feature');
            $html .= '<li><img src="' . $img[0] . '" alt="" /></li>';
        }
        $html .= '</ul>';
        return $html;
    }
    public function displayFloorPlans()
    {
        $html = '<ul>';
        foreach ($this->getFloorPlans() as $images)
        {
            $imageid = getImageID($images);
            $img = wp_get_attachment_image_src($imageid, 'plans');
            $html .= '<li><img src="' . $img[0] . '" alt="" /></li>';
        }
        $html .= '</ul>';
        return $html;
    }
}