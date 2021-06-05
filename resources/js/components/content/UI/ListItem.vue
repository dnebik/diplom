<template>
    <div :class="{list_item: true, viewed: request_status == 2, reviewed: request_status == 3}" @click="go()">
        <div class="top">
            <span class="fio">{{fio}}</span>
            <span class="date">{{date}}</span>
        </div>
        <div class="bottom">
            <div class="grid-container">
                <div class="comment">{{comment}}</div>
                <div class="status">{{status}}</div>
                <div class="id">{{id}}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListItem",
    props: {
        fio: '',
        date: '',
        comment: '',
        status: '',
        id: '',
        request_status: 0,
    },
    methods: {
        go() {
            this.$router.push({name: 'view', params: {id: this.id}})
        }
    }
}
</script>

<style scoped lang="sass">
    .list_item
        min-width: 280px
        max-width: 420px
        display: flex
        flex-direction: column
        margin-bottom: 12px
        border-radius: 3px
        overflow: hidden
        width: 100%
        min-height: 48px
        cursor: pointer
        transition: 0.2s

        &.viewed
            .top
                background-color: #89C2F3 !important
        &.reviewed
            .top
                background-color: #B5B5B5 !important
            .bottom
                color: #B5B5B5 !important


        &:hover
            transform: scale(1.05)
            box-shadow: 0 0 8px #48ACAD


        & .top, & .bottom
            padding: 4px 7px
            width: 100%
            box-sizing: border-box
        .top
            display: flex
            justify-content: space-between
            align-items: center
            min-height: 26px
            background-color: #028F91
            color: white
            .fio
                font-size: 16px
        .bottom
            color: #48ACAD
            background-color: #CFE5F944
            min-height: 22px
            .grid-container
                width: 100%
                display: grid
                grid-template-columns: 1fr 1fr 1fr
                grid-template-rows: 1fr
                gap: 0 0
                grid-template-areas: "comment status id"
                & > *
                    overflow: hidden
                    text-overflow: ellipsis
                    white-space: nowrap
                    padding: 0 2px
                .comment
                    grid-area: comment
                .status
                    grid-area: status
                .id
                    grid-area: id
                    text-align: right
</style>
