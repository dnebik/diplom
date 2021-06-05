<template>
    <div :class="{
        'info-box': true,
        'info': type === 'info',
        'danger': type === 'danger',
        'hide': !visible,
    }">
        {{text}}
    </div>
</template>

<script>
export default {
    name: "InfoBox",
    props: {
        text: {
            type: String,
            default: '',
        },
        type: {
            type: String,
            default: 'info',
        },
        visible: {
            type: Boolean,
            default: true,
        }
    }
}
</script>

<style scoped lang="sass">
    .info-box
        box-sizing: border-box
        width: 100%
        padding: 11px
        margin: 12px 0 25px 0
        border-radius: 3px
        font-size: 18px
        display: flex
        align-items: center
        justify-content: center
        transition: 0.3s ease-in-out
        &.hide
            opacity: 0
        &.danger
            background-color: #F8DFDF
            color: #105A5B
        &.info
            background-color: #eaf4fc
            color: #105A5B
</style>
