<template>
    <div class="view-document-item">
        <span class="fio">{{name}}</span>
        <div class="datetime">
            <span class="date">{{date}}</span>
            <span class="time">{{time}}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "ViewDocumentItem",
    props: {
        name: String,
        date: String,
        time: String,
    }
}
</script>

<style scoped lang="sass">
    .view-document-item
        margin-bottom: 18px
        border-radius: 3px
        background-color: #028F91
        color: #ffffff
        display: flex
        padding: 5px 6px 2px 6px
        z-index: 5
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25)
        .fio
            font-size: 16px
        .datetime
            margin-left: auto
            display: flex
            flex-direction: column
            align-items: end
            .date
                font-size: 10px
            .time
                font-size: 8px
                opacity: 0.8
</style>
