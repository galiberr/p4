<div>
        @if (is_null($events))
        There are no karaoke events in your search area.
        @else
        The search returned {{ count($events) }} karaoke events in your search area:
        @foreach ($events as $event)
        <div class="row">
                <div class="panel panel-default">
                        <div class="panel-body">
                                <div class="col-lg-2">
                                        <img src="/assets/uploads/events/{{ $event->id }}/thumbnail" alt="Event thumbnail" />
                                </div>
                                <div class="col-lg-10">
                                        <a href="/events/{{ $event->id }}">{{ $event->title }}</a> hosted by <a href="/users/{{ $event->kj->id }}">{{ $event->kj->first_name }} {{ $event->kj->last_name }}</a><br />
                                        {{ $event->description }}<br />
                                        Location: <a href="/locales/{{ $event->locale->id }}">{{ $event->locale->gm_name }}</a> at {{ $event->locale->gm_formatted_address }}<br />
                                        @if ($event->recurring)
                                        Takes place every {{ \App\Libraries\Event::dayOfWeek($event->day_of_week)}} - next date on {{ \App\Libraries\Event::nextDate($event->day_of_week)->toFormattedDateString() }}
                                        @else
                                        Date: {{ date('F j, Y', strtotime($event->next_date)) }}
                                        @endif
                                        <br />
                                        Starts: {{ date('h:i A', strtotime($event->start_time)) }} Ends: {{ date('h:i A', strtotime($event->end_time)) }}
                                </div>
                        </div>
                </div>
        </div>
        @endforeach
        @endif
</div>