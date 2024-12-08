<?php

namespace Modules\Main\Traits\Seo\Meta;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

trait MetaTags
{

    public function generateMetaTag(array $meta=[] ,array $instance=[])
    {
        $public= $this->publicTag($meta ,$instance);
        $twitter=$this->twitter($meta ,$instance);
        $opengraph=$this->opengraph($meta ,$instance);
        return $public. " \n " . $twitter .  " \n " . $opengraph;
    }

    private  function publicTag(array $meta ,array  $instance)
    {
        $title = $meta['title'] ?? $instance['title'] ?? $instance['name'];
        $description = $meta['description'] ?? $instance['excerpt'] ?? null;

        $followable =$meta['follow'] ?? 'follow';
        $indexable =$meta['$indexable'] ?? 'index';
        $conical = $meta['conical_url'] ?? url()->current();
        $keyword = isset($meta['keywords']) ? implode(', ' , $meta['keywords']) : null;

        $tagHTML="<title>$title</title> \n";
        $tagHTML .="<meta name='robots' content='$indexable, $followable'> \n";
        $tagHTML .="<link rel='canonical' href='$conical' /> \n";
        if ($description) $tagHTML .= "<meta name='description' content='$description'> \n";
        if ($conical) $tagHTML .= "<meta name='keywords' content='$keyword'> \n";

        return $tagHTML;
    }

    private function twitter(array $meta ,array  $instance)
    {
        $title = $meta['title'] ?? $instance['title'] ?? $instance['name'];
        $description = $meta['description'] ?? $instance['excerpt'] ?? null;
        $image = $meta['image'] ?? $instance['featured_image'] ?? $instance['avatar'] ?? null;
        $imgAlt = $instance['title'] ??$instance['name'] ?? null;
        $twitterUsername =config('seogeneral.twitter') ?? null;

        $twitterHTML = "<meta name='twitter:card' content='summary'> \n";
        $twitterHTML .= "<meta name='twitter:title' content='$title'> \n";
        $twitterHTML .= "<meta name='twitter:site' content='$twitterUsername'> \n";
        if($description) $twitterHTML .= "<meta name='twitter:description' content='$description'> \n";
        if($description) $twitterHTML .= "<meta name='twitter:image' content='$image'> \n";
        if($description) $twitterHTML .= "<meta name='twitter:image' content='$image'> \n";
        if($description) $twitterHTML .= "<meta name='twitter:alt' content='$imgAlt'> \n";

        return $twitterHTML;
    }

    private function opengraph(array $meta ,array  $instance)
    {
        $title = $meta['title'] ?? $instance['title'] ?? $instance['name'];
        $description = $meta['description'] ?? $instance['excerpt'] ?? null;
        $image = $meta['image'] ?? $instance['featured_image'] ?? $instance['avatar'] ?? null;
        $locale = config('app.locale') ?? 'fa';
        $site =__(config('app.name'));
        $url = url()->current();
        $ogType=$meta['og_type'] ?? 'website';
        $publishedAt=$instance['published_at'] ?? $instance['created_at'] ?? null;

        $opengraphHTML = "<meta property='og:type' content='$ogType'> \n";
        $opengraphHTML .= "<meta property='og:title' content='$title'> \n";
        $opengraphHTML .= "<meta name='og:url' content=".$url."> \n";
        $opengraphHTML .= "<meta name='og:site_name' content='$site'> \n";
        $opengraphHTML .= "<meta property='og:brand' content='$site'> \n";
        $opengraphHTML .= "<meta property='og:locale' content='$locale'> \n";
        if($description) $opengraphHTML .= "<meta property='og:description' content='$description'> \n";
        if($image) $opengraphHTML .= "<meta property='og:image' content='$image'> \n";
        if($publishedAt) {
            $time= Carbon::create($publishedAt)->toW3cString();
            $opengraphHTML .= "<meta property='og:published_time' content='$time'> \n";
        }
        return $opengraphHTML;
    }


}
