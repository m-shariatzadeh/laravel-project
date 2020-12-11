<?php

namespace App\Listeners;

use App\Events\PostViewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostViewCount implements ShouldQueue
{

    private $post;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostViewEvent  $event
     * @return void
     */
    public function handle(PostViewEvent $event)
    {
//        dd($event->post);

//        $event->post->post_view_count +=1;
//        $event->post->save();

        $this->post = $event->post;

        $this->post->post_view_count += 1;
        $this->post->save();

    }
}
