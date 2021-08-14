@extends(backpack_view('blank'))
@section('content')
    <link href="{{ asset('css/room.css') }}" rel="stylesheet">
    <div id="app">
        <div class="room">
            <input type="hidden" id="organization" value="{{$id}}">
            <div class="room-main">
                <div class="room-title">
                    Комнаты
                    <span v-if="sections.length > 0">(@{{ sections.length }})</span>
                    <button class="room-btn" @click="newRooms()">Добавить комнату</button>
                </div>
                <div class="room-table">
                    <div class="room-table-header">
                        <div class="room-table-header-item room-table-item-id">ID</div>
                        <div class="room-table-header-item room-table-item-name">Название</div>
                        <div class="room-table-header-item room-table-item-status">Статус</div>
                        <div class="room-table-header-item room-table-item-created">Создан</div>
                        <div class="room-table-header-item room-table-item-action">Действия</div>
                    </div>
                    <div class="room-table-body">
                        <div class="room-table-list" v-for="(section,key) in sections" :key="key">
                            <div class="room-table-body-item room-table-item-id">@{{section.id}}</div>
                            <div class="room-table-body-item room-table-item-name">@{{section.name}}</div>
                            <div class="room-table-body-item room-table-item-status">@{{section.status}}</div>
                            <div class="room-table-body-item room-table-item-created">@{{ section.created_at }}</div>
                            <div class="room-table-header-item room-table-item-action">
                                <div class="room-table-header-item room-table-item-statistics"></div>
                                <div class="room-table-header-item room-table-item-edit"></div>
                                <div class="room-table-header-item room-table-item-delete"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="room" v-for="(section,key) in sections" :key="key">
            <div class="room-main">
                <div class="room-title">
                    @{{ section.name }} <span v-if="section.organization_tables.length > 0">(@{{ section.organization_tables.length }})</span>
                    <button class="room-btn">Добавить стол</button>
                </div>
                <div class="room-table">
                    <div class="room-table-header">
                        <div class="room-table-header-item room-table-item-id">ID</div>
                        <div class="room-table-header-item room-table-item-name">Название</div>
                        <div class="room-table-header-item room-table-item-status">Статус</div>
                        <div class="room-table-header-item room-table-item-created">Лимит</div>
                        <div class="room-table-header-item room-table-item-action">Действия</div>
                    </div>
                    <div class="room-table-body">
                        <div class="room-table-list" v-for="(table,key) in section.organization_tables" :key="key">
                            <div class="room-table-body-item room-table-item-id">@{{table.id}}</div>
                            <div class="room-table-body-item room-table-item-name">@{{table.title}}</div>
                            <div class="room-table-body-item room-table-item-status">@{{table.status}}</div>
                            <div class="room-table-body-item room-table-item-created">@{{ table.limit }}</div>
                            <div class="room-table-header-item room-table-item-action">
                                <div class="room-table-header-item room-table-item-statistics"></div>
                                <div class="room-table-header-item room-table-item-duplicate"></div>
                                <div class="room-table-header-item room-table-item-edit"></div>
                                <div class="room-table-header-item room-table-item-delete"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('backpack.modal.room')
    </div>
    @include('backpack.scripts')
    <script src="{{ asset('js/room.js') }}"></script>
@endsection
