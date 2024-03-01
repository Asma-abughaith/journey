<!-- plan-create.blade.php -->

<div>
    <form wire:submit.prevent="submit">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="name_en">{{ __('app.name-en') }}</label>
                    <input type="text" class="form-control"
                           placeholder="{{ __('app.region-en') }}" name="name_en"
                           value="{{ old('name_en') }}" id="name_en" required wire:model='name_en'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="name_er">{{ __('app.name-ar') }}</label>
                    <input type="text" class="form-control"
                           placeholder="{{ __('app.region-ar') }}" name="name_ar"
                           value="{{ old('name_ar') }}" id="name_ar" required wire:model='name_ar'>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"
                           for="validationTooltip03">{{ __('app.description-en') }}</label>
                    <div>
                        <textarea required name="description_en" class="form-control" rows="3" id="validationTooltip03"
                                  placeholder="{{ __('app.description-enter-en') }}" wire:model='description_en'>{{ old('description_en') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label"
                           for="validationTooltip04">{{ __('app.description-ar') }}</label>
                    <div>
                        <textarea required name="description_ar" class="form-control" rows="3" id="validationTooltip04"
                                  placeholder="{{ __('app.description-enter-ar') }}" wire:model='description_ar'>{{ old('description_ar') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @foreach($days as $dayIndex => $day)
            <div class="d-flex justify-content-lg-between">
                <h5 class="mb-4">Day Number {{ $loop->iteration }}:</h5>
                <button type="button" class="btn btn-success" wire:click="addDay">Add Another Day</button>
                @if($dayIndex > 0)
                    <button type="button" class="btn btn-danger" wire:click="removeDay({{ $dayIndex }})">Remove This Day</button>
                @endif
            </div>
                @foreach($day['activities'] as $activityIndex => $activity)
                <div class="mb-3">
                    <h6 class="text-success mb-3">Activity No.{{ $loop->iteration }}:</h6>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip05">{{ __('app.activity-name-en') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ __('app.start_datetime-enter-en') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][name_en]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.name_en">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip05">{{ __('app.activity-name-ar') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ __('app.start_datetime-enter-en') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][name_ar]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.name_ar">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip05">{{ __('app.start-time') }}</label>
                            <input type="time" class="form-control"
                                   placeholder="{{ __('app.start_datetime-enter-en') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][start_datetime]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.start_datetime">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip06">{{ __('app.end_datetime') }}</label>
                            <input type="time" class="form-control"
                                   placeholder="{{ __('app.end_datetime-enter-ar') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][end_datetime]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.end_datetime">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="">{{ __('app.places') }}</label>
                            <select class="select2 form-control " name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][places][]"
                                     data-placeholder="{{ __('app.choose...') }}" required
                                    wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.places">
                                <option value="">{{ __('app.select-one') }}</option>
                                @foreach ($places as $place)
                                    <option value="{{ $place['id'] }}">{{ $place['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip06">{{ __('app.note-en') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ __('app.end_datetime-enter-ar') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][note_en]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.note_en">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label"
                                   for="validationTooltip06">{{ __('app.note-ar') }}</label>
                            <input type="text" class="form-control"
                                   placeholder="{{ __('app.end_datetime-enter-ar') }}"
                                   name="days[{{ $dayIndex }}][activities][{{ $activityIndex }}][note_ar]"
                                   wire:model="days.{{ $dayIndex }}.activities.{{ $activityIndex }}.note_ar">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="m-4 ms-5">
                            <button type="button" class="btn btn-success"
                                    wire:click="addActivity({{ $dayIndex }})">+</button>
                            @if($activityIndex > 0)
                                <button type="button" class="btn btn-danger"
                                        wire:click="removeActivity({{ $dayIndex }}, {{ $activityIndex }})">-</button>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
        @endforeach

        <div style="text-align: end">
            <button class="btn btn-primary" type="submit">{{ __('app.create') }}</button>
        </div>
    </form>
</div>
