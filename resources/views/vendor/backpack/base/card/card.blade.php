@if($booking)
    @php
        $user =   $userService->getById($booking->user_id);
    @endphp
    @if($booking->status === \App\Domain\Contracts\BookingContract::CHECKING)
        <div class="card shadow border-0 overflow-hidden" data-card="{{$table->id}}" style="border-radius: 10px;">
            <div class="card-header bg-info font-weight-bold text-center h6 border-0">
                {{$table->title}}
                <span class="text-dark card-id">{{$booking->id}}</span>
            </div>
            <ul class="list-group list-group-flush" style="font-size: 13px;">
                <li class="list-group-item">
                    <span class="text-secondary">Имя</span> -
                    <span class="font-weight-bold text-dark">{{$user->name}}</span>
                </li>
                <li class="list-group-item">
                    <span class="text-secondary">Номер</span> -
                    <span class="font-weight-bold text-dark">{{$user->phone}}</span>
                </li>
            </ul>
            <div class="card-body" data-id="{{$organization->id}}" data-user="{{$user_id}}">
                <a class="btn btn-info btn-block text-white font-weight-bold">В резерве ({{$booking->time}})</a>
                <a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="{{$booking->id}}">Отменить</a>
            </div>
        </div>
    @elseif($booking->status === \App\Domain\Contracts\BookingContract::ON)
        <div class="card shadow border-0 overflow-hidden" data-card="{{$table->id}}" style="border-radius: 10px;">
            <div class="card-header bg-danger font-weight-bold text-center h6 border-0">
                {{$table->title}} <span class="text-dark card-id">{{$booking->id}}</span>
            </div>
            <ul class="list-group list-group-flush" style="font-size: 13px;">
                <li class="list-group-item">
                    <span class="text-secondary">Имя</span> -
                    <span class="font-weight-bold text-dark">{{$user->name}}</span>
                </li>
                <li class="list-group-item">
                    <span class="text-secondary">Номер</span> -
                    <span class="font-weight-bold text-dark">{{$user->phone}}</span>
                </li>
            </ul>
            <div class="card-body" data-id="{{$organization->id}}" data-user="{{$user_id}}">
                <a class="btn btn-danger btn-block text-white font-weight-bold">Забронирован ({{$booking->time}})</a>
                <a class="btn btn-success btn-block text-white font-weight-bold btn-booking-came" data-id="{{$booking->id}}">Гость пришел</a>
                <a class="btn btn-dark btn-block text-white font-weight-bold btn-booking-completed" data-id="{{$booking->id}}">Завершен</a>
                <a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="{{$booking->id}}">Отменить</a>
            </div>
        </div>
    @elseif($booking->status === \App\Domain\Contracts\BookingContract::CAME)
        <div class="card shadow border-0 overflow-hidden" data-card="{{$table->id}}" style="border-radius: 10px;">
            <div class="card-header bg-danger font-weight-bold text-center h6 border-0">
                {{$table->title}} <span class="text-dark card-id">{{$booking->id}}</span>
            </div>
            <ul class="list-group list-group-flush" style="font-size: 13px;">
                <li class="list-group-item">
                    <span class="text-secondary">Имя</span> -
                    <span class="font-weight-bold text-dark">{{$user->name}}</span>
                </li>
                <li class="list-group-item">
                    <span class="text-secondary">Номер</span> -
                    <span class="font-weight-bold text-dark">{{$user->phone}}</span>
                </li>
            </ul>
            <div class="card-body" data-id="{{$organization->id}}" data-user="{{$user_id}}">
                <a class="btn btn-info btn-block text-white font-weight-bold">Гость пришел ({{$booking->time}})</a>
                <a class="btn btn-dark btn-block text-white font-weight-bold btn-booking-completed" data-id="{{$booking->id}}">Завершен</a>
                <a class="btn btn-dark btn-block text-white font-weight-bold btn-booking" data-id="{{$booking->id}}">Отменить</a>
            </div>
        </div>
    @endif
@else
    <div class="card shadow border-0 overflow-hidden" data-card="{{$table->id}}" style="border-radius: 10px;">
        <div class="card-header bg-success font-weight-bold text-center h6 border-0">{{$table->title}}</div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center text-secondary">
                <a class="nav-link p-0">
                    <i class="nav-icon la la-users h2"></i><br>
                    Вместимость <span class="text-dark font-weight-bold">{{$table->limit}}</span>
                </a>
            </li>
        </ul>
        <div class="card-body" data-id="{{$organization->id}}" data-user="{{$user_id}}">
            <a href="/admin/booking/create?table={{$table->id}}" class="btn btn-success btn-block text-white font-weight-bold booking-new-btn" data-toggle="modal" data-target="#booking-modal" data-id="{{$table->id}}">Свободно</a>
        </div>
    </div>
@endif
