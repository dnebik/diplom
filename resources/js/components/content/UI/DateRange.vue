<template>
    <div class="range-datepicker" style="position: relative; width: max-content">
        <v-date-picker v-model="range" is-range />
        <button :disabled="range === null" class="reset-btn" type="button" @click="range = null">Сбросить</button>
    </div>
</template>

<script>
export default {
    name: "DateRange",
    model: {
        prop: 'value',
        event: 'change',
    },
    data() {
        return {
            value: null,
        }
    },
    props: {
        range: null,
    },
    watch: {
        range(value) {
            this.$emit('change', value);
        },
        value(value) {
            this.range = value;
        }
    },
    created() {
        this.range = this.value;
    }
}
</script>

<style scoped lang="sass">
    .range-datepicker
        position: relative
        width: max-content
    .reset-btn
        font-size: 14px
        font-weight: bold
        border-radius: 3px
        padding: 5px 7px
        cursor: pointer
        background-color: #cce8e8
        color: #2a4365
        transition: 0.2s
        position: absolute
        right: 10px
        bottom: 8px
        z-index: 1000
        &:disabled
            opacity: 0
        &:active, &:hover, &
            border: unset
            outline: none

</style>
