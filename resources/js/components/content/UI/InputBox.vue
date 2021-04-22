<template>
    <div class="body" ref="body">
        <label class="input-wrapper">
            <span ref="label">{{label}}</span>
            <input :type=" visible ? 'text' : 'password' "
                   :value="value"
                   @input="$emit('input', $event.target.value); check()"
                   @focusin="check()"
                   @focusout="check()"
                   ref="input"
            >
        </label>
        <div v-if="password" class="eye-wrapper">
            <svg @click="visible = !visible" class="eye" v-if="password && !visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 3L21 21" stroke="#D2D2D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10.584 10.587C10.2087 10.962 9.99778 11.4708 9.99759 12.0013C9.9974 12.5318 10.208 13.0407 10.583 13.416C10.958 13.7913 11.4667 14.0022 11.9973 14.0024C12.5278 14.0026 13.0367 13.792 13.412 13.417" stroke="#D2D2D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M17.357 17.349C15.726 18.449 13.942 19 12 19C8 19 4.667 16.667 2 12C3.369 9.605 4.913 7.825 6.632 6.659M9.363 5.365C10.2204 5.11972 11.1082 4.99684 12 5C16 5 19.333 7.333 22 12C21.222 13.361 20.388 14.524 19.497 15.488L9.363 5.365Z" stroke="#D2D2D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <svg @click="visible = !visible" class="eye" v-if="password && visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z" stroke="#48ACAD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 12C19.333 16.667 16 19 12 19C8 19 4.667 16.667 2 12C4.667 7.333 8 5 12 5C16 5 19.333 7.333 22 12Z" stroke="#48ACAD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputBox",
    model: {
        prop: 'value',
        event: 'input',
    },
    data() {
        return {
            visible: true
        }
    },
    watch: {
        visible() {
            let $this = this;
            setTimeout(() => {
                $this.$refs.input.blur();
            }, 1)
        }
    },
    props: {
        value: {
            type: [String, Number],
            default: '',
        },
        label: {
            type: String,
            required: true
        },
        password: {
            type: Boolean,
            required: false
        }
    },
    mounted() {
        this.check();
        this.visible = !this.password;
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
        //padding: 13px 11px 11px 9px
        height: 45px
        border-radius: 3px
        position: relative
        transition: 0.2s
        display: flex
        margin-bottom: 18px
        .input-wrapper
            flex: auto
            position: relative
            cursor: text
            display: flex
            padding: 0 9px
            align-items: center
            input
                font-size: 18px
                border: unset
                flex: auto
                &:focus
                    outline: none
            span
                font-size: 16px
                position: absolute
                background-color: #ffffff
                padding: 0 4px
                top: 13px
                left: 13px
                transition: 0.2s
                -ms-user-select: none
                -moz-user-select: none
                -khtml-user-select: none
                -webkit-user-select: none
        .eye-wrapper
            padding: 0 8px
            display: flex
            align-items: center
            .eye
                cursor: pointer
                z-index: 10

        &.notEmpty
            border: 1px solid #48ACAD
            span
                top: -10px
                color: #48ACAD
            input
                color: #1D5F60
        &:not(.notEmpty)
            border: 1px solid #D2D2D2
            span
                color: #D2D2D2
            input
                color: #D2D2D2
</style>
