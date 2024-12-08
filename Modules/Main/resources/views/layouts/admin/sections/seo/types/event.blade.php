
<section>
    <input id="seo_type" name="seo[meta][seo_type]" value="Event" class="hidden"  type="hidden"/>
    <input id="seo_type" name="seo[schema][seo_type]" value="Event" class="hidden"  type="hidden"/>
    <div class="mb-3">
        <x-main::input.label value="{{__('name')}}" for="schema_name"/>
        <x-main::input.text id="schema_name" name="seo[schema][name]" class="block w-full mb-3"
                      value="{{$schema['name'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('seo.schema.name')"/>
    </div>
    <div class="mb-3">
        <x-main::input.label value="{{__('description')}}" for="schema_description"/>
        <x-main::input.textarea id="schema_description" name="seo[schema][description]"
                          class="block w-full mb-3">{{old('seo.schema.description') ?? $schema['description'] ?? ''}}</x-main::input.textarea>
        <x-main::input.error :messages="$errors->get('seo.schema.description')"/>
    </div>
    <div class="mb-3">
        <x-main::input.label value="{{__('image')}}" for="schema_image"/>
        <x-main::input.text id="schema_image" name="seo[schema][image]"
                      class="block w-full mb-3" value="{{old('seo.schema.image') ?? $schema['image'] ?? ''}}"/>
        <x-main::input.error :messages="$errors->get('seo.schema.image')"/>
    </div>
    <div class="grid md:grid-cols-2 gap-3 mb-3">
        <div class="">
            <x-main::input.label value="{{__('start date')}}" for="schema_start_date"/>
            <x-main::input.time id="schema_start_date" name="seo[schema][start_date]"
                          class="block w-full mb-3" value="{{old('seo.schema.start_date') ?? $schema['start_date'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.start_date')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('start time')}}" for="schema_start_time"/>
            <x-main::input.time id="schema_start_time" name="seo[schema][start_time]" type="time" class="block w-full mb-3"
                          value="{{old('seo.schema.start_time') ?? $schema['start_time'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.start_time')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('end date')}}" for="schema_end_date"/>
            <x-main::input.time id="schema_end_date" name="seo[schema][end_date]"
                          class="block w-full mb-3" value="{{old('seo.schema.end_date') ?? $schema['end_date'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.end_date')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('end time')}}" for="schema_end_time"/>
            <x-main::input.time id="schema_end_time" name="seo[schema][end_time]" type="time"
                          class="block w-full mb-3" value="{{old('seo.schema.end_time') ?? $schema['end_time'] ?? ''}}"/>
            <x-main::input.error :messages="$errors->get('seo.schema.end_time')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('time zone')}}" for="schema_end_time"/>
            <x-main::input.text id="schema_time_zone" name="seo[schema][time_zone]" list="timezones"
                          class="block w-full mb-3" value="{{old('seo.schema.time_zone') ?? $schema['time_zone'] ?? ''}}"/>
            <datalist id="timezones">
                @foreach(config('global.timezone') as $area=>$time)
                    <option value="{{$time}}">
                        {{__($area)}}
                    </option>
                @endforeach
            </datalist>
            <x-main::input.error :messages="$errors->get('seo.schema.time_zone')"/>
        </div>

    </div>
    <div class="grid md:grid-cols-2 gap-3 mb-3">
        <div class="">
            <x-main::input.label value="{{__('attendance mode')}}" for="schema_attendance"/>
            <x-main::input.select id="schema_attendance" name="seo[schema][attendanceMode]" class="block w-full mb-3">
                @foreach(config('global.seoschematype.attendanceMode') as $type=>$description)
                    <option @selected(isset($schema['attendanceMode']) && $schema['attendanceMode']==$description) >
                        {{__($type)}}
                    </option>
                @endforeach
            </x-main::input.select>
            <x-main::input.error :messages="$errors->get('seo.schema.attendanceMode')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('event status')}}" for="schema_eventStatus"/>
            <x-main::input.select id="schema_eventStatus" name="seo[schema][eventStatus]" class="block w-full mb-3">
                @foreach(config('global.seoschematype.eventStatus') as $type=>$description)
                    <option @selected(isset($schema['eventStatus']) && $schema['eventStatus']== $description) >
                        {{__($type)}}
                    </option>
                @endforeach
            </x-main::input.select>
            <x-main::input.error :messages="$errors->get('seo.schema.eventStatus')"/>
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-3 mb-3">
        <div class="">
            <x-main::input.label value="{{__('event type')}}" for="schema_eventPerformance"/>
            <x-main::input.select id="schema_eventPerformance" name="seo[schema][eventPerformance]" class="block w-full mb-3">
                @foreach(config('global.seoschematype.eventPerformance') as $type=>$description)
                    <option @selected(isset($schema['eventPerformance']) && $schema['eventPerformance']== $type ) >
                        {{__($description)}}
                    </option>
                @endforeach

            </x-main::input.select>
            <x-main::input.error :messages="$errors->get('seo.schema.eventPerformance')"/>
        </div>
        <div class="">
            <x-main::input.label value="{{__('performer name')}}" for="schema_performer_name" />
            <x-main::input.text id="schema_performer_name" name="seo[schema][performerName]" class="block w-full mb-3"
            :value="old('seo.schema.performerName') ?? $schema['performerName'] ?? ''" />
            <x-main::input.error :messages="$errors->get('seo.schema.performerName')"/>
        </div>
    </div>
</section>
