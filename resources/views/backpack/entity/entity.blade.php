@extends(backpack_view('blank'))
@section('content')
    <link href="{{ asset('css/entity.css') }}" rel="stylesheet">
    <div id="app" v-if="organization">
        <div class="entity">
            <input type="hidden" id="organization" value="1">
            <div class="entity-main">
                <div class="entity-header">
                    <div class="entity-title">@{{ organization.title }}</div>
                    <div class="entity-stars">
                        <div class="entity-star" :class="{'entity-star-sel':(organization.rating >= 0.5)}"></div>
                        <div class="entity-star" :class="{'entity-star-sel':(organization.rating >= 1.5)}"></div>
                        <div class="entity-star" :class="{'entity-star-sel':(organization.rating >= 2.5)}"></div>
                        <div class="entity-star" :class="{'entity-star-sel':(organization.rating >= 3.5)}"></div>
                        <div class="entity-star" :class="{'entity-star-sel':(organization.rating >= 4.5)}"></div>
                    </div>
                    <div class="entity-rating" v-if="organization.rating">@{{ organization.rating }}</div>
                </div>
                <a href="https://{{$_SERVER['SERVER_NAME']}}/home/bars/2" target="_blank" class="entity-link">
                    <div class="entity-description">{{$_SERVER['SERVER_NAME']}}/home/bars/2</div>
                </a>
            </div>
            <div class="entity-wallpaper">
                <div class="entity-logo" :style="{'background-image':'url('+organization.image+')'}"></div>
            </div>
        </div>
        <div class="entity-single">
            <div class="entity-single-title">
                <div class="entity-single-header">Название</div>
                <div class="entity-single-input">
                    <input type="text" placeholder="На русском" v-model="organization.title" maxlength="255" ref="organization_title">
                    <select >
                        <option>KZT</option>
                    </select>
                    <input type="text" placeholder="Цена" v-model="organization.price" maxlength="255">
                </div>
            </div>
            <div class="entity-single-description">
                <div class="entity-single-header">Описание</div>
                <div class="entity-single-input">
                    <textarea placeholder="На русском" v-model="organization.description"></textarea>
                </div>
            </div>
            <div class="entity-single-description">
                <div class="entity-single-header">Описание</div>
                <div class="entity-single-input">
                    <textarea placeholder="Қазақша" v-model="organization.description_kz"></textarea>
                </div>
            </div>
            <div class="entity-single-description">
                <div class="entity-single-header">Описание</div>
                <div class="entity-single-input">
                    <textarea placeholder="In English" v-model="organization.description_en"></textarea>
                </div>
            </div>
        </div>
        <div class="entity-blocks">
            <div class="entity-block">
                <div class="entity-block-title">Время работы</div>
                <div class="entity-block-description">Настройте время работы вашего заведения</div>
                <div class="entity-block-body">
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Понедельник</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.monday.start" v-mask="'##:##'" placeholder="00:00" :required="true" ref="organization_monday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.monday.end" v-mask="'##:##'" ref="organization_monday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Вторник</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.tuesday.start" v-mask="'##:##'" ref="organization_tuesday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.tuesday.end" v-mask="'##:##'" ref="organization_tuesday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Среда</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.wednesday.start" v-mask="'##:##'" ref="organization_wednesday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.wednesday.end" v-mask="'##:##'" ref="organization_wednesday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Четверг</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.thursday.start" v-mask="'##:##'" ref="organization_thursday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.thursday.end" v-mask="'##:##'" ref="organization_thursday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Пятница</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.friday.start" v-mask="'##:##'" ref="organization_friday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.friday.end" v-mask="'##:##'" ref="organization_friday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Суббота</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.saturday.start" v-mask="'##:##'" ref="organization_saturday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.saturday.end" v-mask="'##:##'" ref="organization_saturday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Воскресенье</div>
                        <div class="entity-block-item-input">
                            <div class="entity-block-item-input-double">
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">С</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.sunday.start" v-mask="'##:##'" ref="organization_sunday_start">
                                    </div>
                                </div>
                                <div class="entity-block-item-input-double-block">
                                    <div class="entity-block-item-input-double-title">До</div>
                                    <div class="entity-block-item-input-double-text">
                                        <input type="text" class="entity-block-item-input-double" v-model="organization.sunday.end" v-mask="'##:##'" ref="organization_sunday_end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="entity-block">
                <div class="entity-block-title">Контакты</div>
                <div class="entity-block-description">Заполните контактные данные вашего заведения</div>
                <div class="entity-block-body">
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Категория</div>
                        <div class="entity-block-item-input">
                            <select>
                                <option v-for="(category,key) in categories" :key="key">@{{category.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Город</div>
                        <div class="entity-block-item-input">
                            <select>
                                <option v-for="(city,key) in cities" :key="key">@{{city.title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Адрес</div>
                        <div class="entity-block-item-input">
                            <input type="text" v-model="organization.address" v-mask="'+# (###) ###-##-##'">
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Телефон номер</div>
                        <div class="entity-block-item-input">
                            <input type="text" v-model="organization.phone" v-mask="'+# (###) ###-##-##'">
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Эл.почта</div>
                        <div class="entity-block-item-input">
                            <input type="email" v-model="organization.email">
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Веб-сайт</div>
                        <div class="entity-block-item-input">
                            <input type="text" v-model="organization.website">
                        </div>
                    </div>
                    <div class="entity-block-item">
                        <div class="entity-block-item-title">Общее количество столов</div>
                        <div class="entity-block-item-input">
                            <input type="text" readonly :value="organization.tables">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="entity-footer">
            <div class="entity-footer-btn">
                <button @click="saveOrganization">Сохранить</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>
    <script src="{{ asset('js/entity.js') }}" type="module"></script>
@endsection
