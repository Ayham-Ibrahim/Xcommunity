<?php

namespace App\Http\Traits;

use SimplePie\SimplePie;

trait GetNewsTrait
{
    public function getNews($feedUrl)
    {
        $feed = new SimplePie();
        $feed->set_feed_url($feedUrl);
        $feed->enable_cache(false);
        $feed->init();

        $siteName = $feed->get_title();
        $siteDescription = $feed->get_description();
        $siteLogo = $feed->get_image_url();

        $data['siteName'] = $siteName;
        $data['siteDescription'] = $siteDescription;
        $data['siteLogo'] = $siteLogo;

        $i = 0;
        $news = [];
        foreach ($feed->get_items() as $item) {

            $date = $item->get_date('Y-m-d H:i:s');
            $title = $item->get_title();
            $content = $item->get_content();

            $news[$i]['date'] = $date;
            $news[$i]['title'] = $title;
            $news[$i]['content'] = $content;

            $i++;
        }
        $data['news'] = $news;

        return $data;
    }
}
