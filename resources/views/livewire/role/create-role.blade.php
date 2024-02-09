<form wire:submit.prevent='submit' >
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label  class="form-label">{{__('app.name-en')}}</label>
                <input type="text" class="form-control"  placeholder="{{__('app.role-en')}}" wire:model='name_en' required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label  class="form-label">{{__('app.name-ar')}}</label>
                <input type="text" class="form-control"  placeholder="{{__('app.role-ar')}}" wire:model='name_ar' required>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">{{__('app.guard')}}</label>
                <select class="form-select"  required="" name="guard" wire:model='guard' wire:change="guardChange" >
                    <option  selected>{{__('app.select-one')}}</option>
                    <option value="admin" >{{__('app.admin')}}</option>
                    <option value="planner">{{__('app.planner')}}</option>
                    <option value="user">{{__('app.user')}}</option>
                </select>
            </div>
        </div>


    </div>
    @if(count($permissions) !== 0)
        <div class="col-md-6">
            @foreach($permissions as $permission)
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="{{ $permission->name }}" wire:model="permissions" value="{{ $permission->name }}">
                    <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->name_i18n }}</label>
                </div>
            @endforeach
        </div>
    @endif
    <div>
        <button class="btn btn-primary" type="submit">{{__('app.submit')}}</button>
    </div>
</form>

