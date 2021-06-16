<template>
    <div class="droping-list">
        <div class="top-panel" @click="open">{{label}}</div>
        <div class="list collapsed" style="max-height: 0" ref="list">
            <slot></slot>
        </div>
        <Modal :view-modal="open_modal" @close="open_modal = false">
            <slot></slot>
        </Modal>
    </div>
</template>

<script>
import Modal from "./Modal";
export default {
    components: {
        Modal
    },
    name: "DroppingList",
    props: {
        label: String
    },
    data() {
        return {
            open_modal: false,
        }
    },
    methods: {
        open() {
            let width = document.documentElement.scrollWidth;
            console.log(width);
            if (width <= 414) {
                this.open_modal = true;
            } else {
                let list = this.$refs.list;
                if (list.classList.contains('collapsed')) {
                    list.style.maxHeight = (list.scrollHeight > 365 ? 365 : list.scrollHeight) + 'px';
                } else {
                    list.style.maxHeight = 0;
                }
                list.classList.toggle('collapsed');
            }
        }
    }
}
</script>

<style scoped lang="sass">
    .droping-list
        margin-bottom: 10px
        .top-panel
            -webkit-touch-callout: none
            -webkit-user-select: none
            -khtml-user-select: none
            -moz-user-select: none
            -ms-user-select: none
            user-select: none

            border-radius: 3px
            background-color: #028F91
            padding: 10px
            text-align: center
            color: #ffffff
            font-size: 16px
            cursor: pointer
        .list
            transition: 0.2s
            overflow-x: hidden
            overflow-y: auto

</style>
