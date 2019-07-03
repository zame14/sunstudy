<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/5/2018
 * Time: 11:46 AM
 */
class AnalysisOption extends SSBase
{
    public function getImage()
    {
        return $this->getPostMeta('feature-image');
    }
}