<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Presentation;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class ModerateController extends Controller
{
    public function report(Request $request, Question $question, User $user)
    {

    }

    public function hide(Request $request, Question $question)
    {

    }

    public function unhide(Request $request, Question $question)
    {

    }

    public function ban(Request $request, Presentation $presentation, User $user)
    {

    }

    public function unban(Request $request, Presentation $presentation, User $user)
    {

    }
}
