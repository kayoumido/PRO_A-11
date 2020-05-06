<?php

namespace App\Poll;

use MyCLabs\Enum\Enum;

/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 * @method static self FINISHED()
 */
class PollStatuses extends Enum
{
    // created but not published, only seen by moderators, votes not allowed
    private const DRAFT = "draft";
    // everyone inside a presentation has access to it and users are allowed to vote
    private const PUBLISHED = "published";
    // everyone inside a presentation has access but votes not allowed anymore
    private const FINISHED = "finished";
}
