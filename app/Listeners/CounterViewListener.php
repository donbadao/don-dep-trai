<?php

namespace App\Listeners;

use App\Events\CounterViewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CounterViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CounterViewEvent  $event
     * @return void
     */
    public function handle(CounterViewEvent $event)
    {

        if (!$this->isPostViewed($event->post)) {
            $this->storePost($event->post);
            Post::updateView($event->post->post_id);
        } else
            
        return true;
    }

    private function isPostViewed($post)
    {
        $viewed = session()->get('viewed_posts', []);
        return array_key_exists($post->post_id, $viewed);
    }


    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->post_id;

        session()->put($key, time());
    }
}
