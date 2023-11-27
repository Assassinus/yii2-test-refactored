<?php

namespace app\components\history;

interface IEventViewFactory
{
    /**
     * @param $eventType
     * @return IEventItemView
     *
     * TODO создать одно перечисление, которое содержит все типы событий и задать этот тип $eventType а-ля createView(AllEventGroups $eventType)
     */
    public function createView($eventType): IEventItemView;
}