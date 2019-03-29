<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuizWinnerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Information about the shipping status update.
     *
     * @var string
     */
    public $quiz;

    /** @var object */
    protected $quizWinners;
    protected $players;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $quizRepo = App::make('App\Repositories\QuizRepository');
        $this->quizWinners = $quizRepo->getWinnerList();
        $this->$players = $quizRepo->getPlayerList();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('quiz.' . $this->quiz->id);
    }
}
