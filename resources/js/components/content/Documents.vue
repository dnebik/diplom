<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>
            <DocumentFilter :route-name="$route.name" @submit="setFilter"/>
            <div class="doc_info" v-if="$root.$data.last_doc">
                <div class="info_wrapper">
                    <span class="title">ID:</span>
                    <span class="info copy">{{$root.$data.last_doc['id_avt']}}</span>
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
                             v-if="review_sent"
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
            <button v-if="$route.meta.needFilter" type="button" class="btn primary btn-filtr" @click="open_filter = !open_filter">Фильтр</button>
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
            copy_link: null,
        }
    },
    mounted() {
        document.querySelector('body').addEventListener('mouseover', this.copyHoverCheck);
        document.querySelector('body').addEventListener('mouseout', this.copyLeaveCheck);
        document.querySelector('body').addEventListener('click', this.copyClick);
        document.addEventListener('scroll', this.scroll);
        this.$root.watchReview();
    },
    destroyed() {
        document.removeEventListener('scroll', this.scroll)
        document.querySelector('body').removeEventListener('mouseover', this.copyHoverCheck);
        document.querySelector('body').removeEventListener('mouseout', this.copyLeaveCheck);
        document.querySelector('body').removeEventListener('click', this.copyClick);
    },
    computed: {
        doc_date() {
            return dateformat(new Date(this.$root.$data.last_doc['date']), "dd.mm.yyyy HH:MM");
        }
    },
    methods: {
        copyHoverCheck(event) {
            let target = event.target;
            if (target.classList.contains('copy')) {
                let dom = document.createElement('div');
                dom.classList.add('copy-link');
                dom.style.top = (target.offsetTop + target.offsetParent.offsetTop + (target.clientHeight / 2) - 9) + 'px';
                dom.style.left = target.offsetLeft + target.offsetParent.offsetLeft + target.offsetWidth + 15 + 'px';
                dom.innerHTML = "<svg width=\"15\" height=\"15\" viewBox=\"0 0 15 15\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
                    "<path d=\"M6 9.14716C6.25978 9.41718 6.56985 9.63169 6.91206 9.77813C7.25427 9.92457 7.62173 10 7.99292 10C8.36411 10 8.73157 9.92457 9.07378 9.77813C9.41598 9.63169 9.72606 9.41718 9.98584 9.14716L13.1745 5.89984C13.7031 5.36156 14 4.6315 14 3.87026C14 3.10902 13.7031 2.37896 13.1745 1.84068C12.646 1.3024 11.9291 1 11.1816 1C10.4341 1 9.71722 1.3024 9.18867 1.84068L8.79009 2.24659\" stroke=\"#028F91\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n" +
                    "<path d=\"M9 5.85284C8.74022 5.58282 8.43015 5.36831 8.08794 5.22187C7.74573 5.07543 7.37827 5 7.00708 5C6.63589 5 6.26843 5.07543 5.92622 5.22187C5.58402 5.36831 5.27394 5.58282 5.01416 5.85284L1.82549 9.10016C1.29694 9.63844 1 10.3685 1 11.1297C1 11.891 1.29694 12.621 1.82549 13.1593C2.35405 13.6976 3.07092 14 3.81841 14C4.5659 14 5.28278 13.6976 5.81133 13.1593L6.20991 12.7534\" stroke=\"#028F91\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n" +
                    "</svg>\n"

                document.body.prepend(dom);
                this.copy_link = dom;
            }
        },
        copyLeaveCheck(event) {
            if (event.target.classList.contains('copy')) {
                this.copy_link.parentNode.removeChild(this.copy_link);
                this.copy_link = null;
            }
        },
        copyClick(event) {
            let target = event.target
            if (target.classList.contains('copy')) {
                let selection = window.getSelection();
                let range = document.createRange();
                range.selectNodeContents(target);
                selection.removeAllRanges();
                selection.addRange(range);
                selection.removeAllRanges();
                document.execCommand('copy');


                let dom = document.createElement('div');
                dom.classList.add('copy-info');
                dom.style.top = (target.offsetTop + target.offsetParent.offsetTop + (target.clientHeight / 2) - 12) + 'px';
                dom.style.left = target.offsetLeft + target.offsetParent.offsetLeft + target.offsetWidth + 15 + 'px';
                dom.innerHTML = "Скопированно!"
                document.body.prepend(dom);
                setTimeout(() => {
                    dom.parentNode.removeChild(dom);
                }, 4 * 1000)
            }
        },
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
        width: max-content
        &.copy
            cursor: pointer
    .employee_selector
        margin-top: 25px

.btn-filtr
    margin-bottom: 20px !important

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

<style lang="sass">
    .copy-link
        position: absolute
        z-index: 10

    .copy-info
        position: absolute
        background-color: #D2D2D2
        padding: 2px 6px
        color: #828282
        border-radius: 3px
        font-size: 16px
        z-index: 11
        &:after
            position: absolute
            content: ' '
            width: 8px
            height: 8px
            left: -4px
            top: 50%
            transform: translateY(-50%) rotate(45deg)
            background-color: #D2D2D2
</style>
