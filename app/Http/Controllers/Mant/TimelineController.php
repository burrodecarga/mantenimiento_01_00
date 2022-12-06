<?php

namespace App\Http\Controllers\Mant;

use App\Http\Controllers\Controller;
use App\Models\Timeline;

class TimelineController extends Controller
{
    public function pending()
    {
        $timelines = Timeline::where('status', 0)->get();
        return view('mant.timelines.pending', compact('timelines'));
    }
}
