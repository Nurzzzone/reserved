@foreach($organizationService->getByUserId($user_id) as &$organization)
    <h1 class="my-3 text-center font-weight-bold text-primary">{{$organization->title}}</h1>
    <p class="text-center h5 text-secondary">Выберите стол для бронирования</p>
    @foreach($organizationTableService->getByOrganizationId($organization->id) as & $section)
        <h3 class="my-3">{{$section->name}}</h3>
        <div class="row">
            @foreach($organizationTableListService->getByTableId($section->id) as &$table)
                <div class="col-xl-2 col-lg-4 col-md-6 col-6">
                    @include('vendor.backpack.base.card.card',[
                        'userService'   =>  $userService,
                        'booking' => $bookingService->getLastByTableId($table->id, $date),
                        'organization' => $organization,
                        'user_id' => $user_id
                    ])
                </div>
            @endforeach
        </div>
    @endforeach
@endforeach
