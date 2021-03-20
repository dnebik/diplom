<template>
    <label class="body" ref="body">
        <span ref="label">{{label}}</span>
        <input type="text"
               :value="value"
               @input="$emit('input', $event.target.value); check()"
               @focusin="check()"
               @focusout="check()"
               ref="input"
        >
    </label>
</template>

<script>
export default {
    name: "Input",
    model: {
        prop: 'value',
        event: 'input',
    },
    props: {
        value: {
            type: [String, Number],
            default: '',
        },
        label: {
            type: String,
            required: true
        }
    },
    mounted() {
        this.check();
    },
    methods: {
        check() {
            let input = this.$refs.input;
            let body = this.$refs.body;

            let isActive = document.activeElement === this.$refs.input;

            if (isActive) { body.classList.add('notEmpty'); return }
            if (input.value.toString().length > 0) { body.classList.add('notEmpty'); return }

            body.classList.remove('notEmpty');
        },
    }
}
</script>

<style scoped lang="sass">
    .body
        min-width: 250px
        padding: 13px 30px 11px 9px
        border-radius: 3px
        position: relative
        transition: 0.2s
        input
            font-size: 18px
            border: unset
            &:focus
                outline: none
        span
            font-size: 16px
            position: absolute
            background-color: #ffffff
            padding: 0 4px
            top: 10px
                left: 13px
            transition: 0.2s

        &.notEmpty
            border: 2px solid #48ACAD
            span
                top: -10px
                color: #48ACAD
            input
                color: #028F91
        &:not(.notEmpty)
            border: 2px solid #D2D2D2
            span
                color: #D2D2D2
            input
                color: #D2D2D2
</style>
