<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>
            <DocumentFilter :route-name="$route.name"/>
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
import DateRange from "./UI/DateRange";
import InputBox from "./UI/InputBox";
import Modal from "./UI/Modal";
import DocumentFilter from "./UI/DocumentFilter";
export default {
    name: "Documents",
    components: {
        DateRange,
        InputBox,
        Modal,
        DocumentFilter
    },
    data() {
        return {
            open_filter: false,
            filter: {
                like: null,
                range: null,
                status: 0,
            },
        }
    },
    mounted() {
        document.addEventListener('scroll', this.scroll);
    },
    destroyed() {
        document.removeEventListener('scroll', this.scroll)
    },
    methods: {
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
                    +start.getMonth(),
                    +start.getDate() + 1
                );
                let end = new_filter.range.end;
                end = new Date(
                    +end.getFullYear(),
                    +end.getMonth(),
                    +end.getDate() + 1,
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
    > *
        position: fixed
    > .form
        margin-top: 140px
    @media (max-width: 414px)
        display: none
</style>
