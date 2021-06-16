<template>
    <div class="droping-list" ref="body">
        <div class="top-panel" @click="open">{{label}}</div>
        <div :class="['list', 'collapsed']" style="max-height: 0; overflow-y: hidden" ref="list">
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
                    list.style.padding = '10px 8px 3px 8px';
                    this.$refs.body.style.boxShadow = '0px 0px 5px rgba(72, 172, 173, 0.47)';
                    setTimeout(() => {
                        list.style.overflowY = 'auto'
                    }, 200)
                } else {
                    list.style.overflowY = 'hidden'
                    list.style.maxHeight = 0;
                    setTimeout(() => {
                        list.style.padding = '0';
                    }, 155)
                }
                list.classList.toggle('collapsed');
            }
        }
    }
}
</script>

<style scoped lang="sass">
    .droping-list
        width: 100%
        margin-bottom: 10px
        transition: 0.2s
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
            transition: max-height 0.2s
            overflow-x: hidden


</style>
