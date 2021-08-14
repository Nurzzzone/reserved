<link href="{{ asset('css/modal.css') }}" rel="stylesheet">
<template v-if="showModal">
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header">
                            Комната
                        </slot>
                        <div class="modal-close" @click="showModal = false"></div>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            <div class="modal-inputs" v-for="(newSection,key) in newSections" :key="key">
                                <div class="modal-input-close" v-if="key !== 0 && newSectionsStatus" @click="removeRoom(key)"></div>
                                <div class="modal-input">
                                    <div>Название комнаты</div>
                                    <input type="text" class="modal-text" ref="newSection" v-model="newSection.name" :disabled="!newSectionsStatus">
                                </div>
                                <div class="modal-input">
                                    <div>Статус</div>
                                    <select class="modal-select" v-model="newSection.status" :disabled="!newSectionsStatus">
                                        <option value="ENABLED" :selected="newSection.status === 'ENABLED'">Включен</option>
                                        <option value="FROZEN" :selected="newSection.status === 'FROZEN'">Заблокирован</option>
                                    </select>
                                </div>
                            </div>
                        </slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-additional-button" v-if="!newSectionsStatus" @click="addRoom()">
                                Добавить комнату
                            </button>
                            <button class="modal-default-button" @click="saveRooms()">
                                Готово
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
