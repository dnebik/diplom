<template>
    <div :class="{
        'info-box': true,
        'info': type === 'info',
        'danger': type === 'danger'
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
        background-color: #F8DFDF
        color: #105A5B
        font-size: 18px
        display: flex
        align-items: center
        justify-content: center
</style>
