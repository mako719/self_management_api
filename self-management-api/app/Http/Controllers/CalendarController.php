<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Services\CalendarService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $calendarService;

    public function __construct(
        CalendarService $calendarService
    ) {
        $this->calendarService = $calendarService;
    }

    /**
     * 指定した日付のカレンダーの情報を返却する
     *
     * @param Request $request
     * @param String $reportDate
     *
     * @return Json
     */
    public function show(Request $request, string $recordDate = null)
    {
        $calendarContents = $this->calendarService->getCalendarContents($request, $recordDate);

        return new CalendarResource($calendarContents);
    }
}
