<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>
            <DocumentFilter :route-name="$route.name" @submit="setFilter"/>
            <div class="doc_info" v-if="$root.$data.last_doc">
                <div class="info_wrapper">
                    <span class="title">ID:</span>
                    <span class="info">{{$root.$data.last_doc['id_avt']}}</span>
                </div>
                <div class="info_wrapper">
                    <span class="title">Дата:</span>
                    <span class="info">{{doc_date}}</span>
                </div>
                <div class="info_wrapper">
                    <span class="title">Создатель:</span>
                    <span class="info">{{$root.$data.last_doc['sFIO']}}</span>
                </div>
                <form @submit.prevent="sentReview()" class="employee_selector">
                    <InfoBox :class="{info_opacity: review_status}"
                             :type="review_sent === 'sent' ? 'info' : 'danger'"
                             :text="review_sent === 'sent' ? 'Отправлено' : 'Ошибка'"
                             :visible="review_sent !== null"
                    />
                    <span class="title">Получатель:</span>
                    <EmployeeSelector :label="false" :with_none="false" v-model="employee"/>
                    <button :disabled="waiting_emp" type="submit" class="btn submit">Отправить</button>
                </form>
            </div>
        </div>
        <div style="width: 100%">
            <button v-if="$route.meta.needFilter" type="button" class="btn primary" @click="open_filter = !open_filter">Фильтр</button>
            <router-view :filter="filter"></router-view>
        </div>
        <Modal :view-modal="open_filter" @close="open_filter = false">
            <DocumentFilter :route-name="$route.name" @submit="setFilter"/>
        </Modal>
    </div>
</template>

<script>

import dateformat from 'dateformat';
import DateRange from "./UI/DateRange";
import InfoBox from "./UI/InfoBox";
import EmployeeSelector from "./UI/EmployeeSelector";
import InputBox from "./UI/InputBox";
import Modal from "./UI/Modal";
import DocumentFilter from "./UI/DocumentFilter";
export default {
    name: "Documents",
    components: {
        DateRange,
        InputBox,
        Modal,
        DocumentFilter,
        EmployeeSelector,
        InfoBox
    },
    data() {
        return {
            open_filter: false,
            filter: {
                like: null,
                range: null,
                status: 0,
            },
            employee: null,
            waiting_emp: false,
            review_sent: null,
            review_status: false,
        }
    },
    mounted() {
        document.addEventListener('scroll', this.scroll);
        this.$root.watchReview();
    },
    destroyed() {
        document.removeEventListener('scroll', this.scroll)
    },
    computed: {
        doc_date() {
            return dateformat(new Date(this.$root.$data.last_doc['date']), "dd.mm.yyyy HH:MM");
        }
    },
    methods: {
        sentReview() {
            this.waiting_emp = true;

            let req = axios.post('/docs/send_review', {
                recipient: this.employee,
                id: this.$root.$data.last_doc['id'],
            });
            req.then(value => {
                let data = value['data'];
                if (data['status']['code'] === 0) {
                    this.review_sent = 'sent';
                } else {
                    this.review_sent = 'error';
                }
            });
            req.catch(() => {
                this.review_sent = 'error';
            })
            req.finally(() => {
                this.waiting_emp = false;
                this.review_status = true;
                setTimeout(() => {
                    this.review_sent = false;
                }, 5000);
            })
        },
        setFilter(filter) {
            this.open_filter = false;
            this.filtSet(filter);
        },
        scroll() {
            let top = window.scrollY;
            let nav = document.getElementsByClassName('nv-desctop')[0];
            nav.style.marginTop = '-' + (top > 115 ? 115 : top) + 'px';
        },
        filtSet(new_filter) {
            this.filter = {}
            this.$set(this.filter, 'like', new_filter.like.length > 0 ? new_filter.like : null);
            this.$set(this.filter, 'status', new_filter.status);
            if (new_filter.range !== null) {
                let start = new_filter.range.start;
                start = new Date(
                    +start.getFullYear(),
                    +start.getMonth()+1,
                    +start.getDate()+1
                );
                let end = new_filter.range.end;
                end = new Date(
                    +end.getFullYear(),
                    +end.getMonth()+1,
                    +end.getDate()+1,
                    23,
                    59,
                    59,
                    999
                );

                this.$set(this.filter, 'range', {
                    start: start.getTime(),
                    end: end.getTime()
                });
            }
            else this.$set(this.filter, 'range', null);

        },
    }
}
</script>

<style scoped lang="sass">

.doc_info
    margin-top: 190px
    width: 250px
    .info_wrapper
        margin-bottom: 12px
    .title
        display: block
        color: #D2D2D2
        font-weight: 400
        font-size: 18px
    .info
        display: block
        color: #028F91
        font-weight: 400
        font-size: 18px
    .employee_selector
        margin-top: 25px



.flex-body
    width: inherit
    overflow-x: hidden
    display: flex
    .btn.primary
        display: none
        float: right
        margin-bottom: 30px
        @media (max-width: 414px)
            display: block

.nv-desctop
    margin-right: 63px
    min-width: 250px
    position: relative
    > *
        position: fixed
    > .form
        margin-top: 140px
    @media (max-width: 414px)
        display: none
</style>
