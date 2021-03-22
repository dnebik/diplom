<template>
    <div class="checkbox" ref="body">
        <label class="label">
            <input type="checkbox"
                   :checked="checked"
                   @change="$emit('change', $event.target.checked); check()"
            >
            <span>{{label}}</span>
        </label>
        <div class="outline">
            <div class="checker"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputCheckBox",
    model: {
        prop:  'checked',
        event: 'change',
    },
    props: {
        label: {
            type: String,
            required: true,
        },
        checked: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        check() {
            let body = this.$refs.body;
            if (this.checked) body.classList.add('checked');
            else body.classList.remove('checked');
        }
    }
}
</script>

<style scoped lang="sass">

$checkbox_width: 28px
$checkbox_height: 10px
$checker_size: 16px
$margin: 10px
$transition: 0.2s

.checkbox
    position: relative
    width: max-content
    margin: 15px 0
    -ms-user-select: none
    -moz-user-select: none
    -khtml-user-select: none
    -webkit-user-select: none

    input
        display: none

    .label
        height: 18px
        vertical-align: center
        display: block
        padding-left: calc(#{$checkbox_width} + #{$margin})
        color: #028F91

    .outline
        position: absolute
        left: 0
        top: 6px
        display: flex
        justify-content: center
        align-items: center
        width: $checkbox_width
        height: $checkbox_height
        border-radius: 6px
        pointer-events: none
        box-sizing: border-box
        padding: 0 2px
        transition: $transition
        .checker
            position: absolute
            display: block
            border-radius: 100%
            background-color: #A5A5A5
            width: $checker_size
            height: $checker_size
            transition: $transition

    &.checked
        .outline
            background-color: #A5A5A530
        .checker
            transform: translateX(#{-1 * ($checkbox_height / 2)})
            background-color: #A5A5A5
    &:not(.checked)
        .outline
            background-color: #028F9130
        .checker
            transform: translateX(#{$checkbox_height / 2})
            background-color: #028F91


</style>
