<template>
    <div :class="{'textarea-wrapper': true, highlight: highlight}">
        <label>
            <textarea @input="$emit('input', $event.target.value)"
                      rows="1"
                      ref="textarea">
            </textarea>
        </label>
        <span class="label" v-text="label"></span>
        <span v-if="max > 0" class="max-len">({{value.length}}/{{max}})</span>
    </div>
</template>

<script>
export default {
    name: "TextAreaBox",
    data() {
        return {
            highlight: false
        }
    },
    model: {
        prop: 'value',
        event: 'input',
    },
    props: {
        value: { type: String },
        label: { type: String },
        max: { type: Number, default: 0 },
    },
    beforeDestroy() {
        this.$refs.textarea.removeEventListener('input', this.checkHighlight);
        this.$refs.textarea.removeEventListener('focus', this.checkHighlight);
        this.$refs.textarea.removeEventListener('blur', this.checkHighlight);
        if (this.max > 0) this.$refs.textarea.removeEventListener('input', this.checkLen);
    },
    mounted() {
        this.$refs.textarea.addEventListener('input', this.checkHighlight);
        this.$refs.textarea.addEventListener('focus', this.checkHighlight);
        this.$refs.textarea.addEventListener('blur', this.checkHighlight);
        if (this.max > 0) this.$refs.textarea.addEventListener('input', this.checkLen);
    },
    methods: {
        checkHighlight() {
            let textarea = this.$refs.textarea;
            if (document.activeElement === textarea) {
                this.highlight = true;
            } else {
                this.highlight = typeof this.value === "string" && this.value.length > 0;
            }

            setTimeout(() => {
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight > 40 ? textarea.scrollHeight + 'px': '22px';
            }, 1)
        },
        checkLen(event) {
            if (this.$refs.textarea.value.length > this.max)
            {
                this.$emit('input', this.$refs.textarea.value.substr(0, this.max));
                this.$refs.textarea.value = this.$refs.textarea.value.substr(0, this.max);
            }
        }
    }
}
</script>

<style scoped lang="scss">
    .textarea-wrapper {
        position: relative;
        width: 100%;
        border: 1px solid #D2D2D2;
        box-sizing: border-box;
        border-radius: 3px;
        margin-bottom: 18px;
        padding: 13px;

        .label {
            position: absolute;
            top: 13px;
            pointer-events: none;
            left: 13px;
            color: #D2D2D2;
            font-size: 16px;
            background-color: #ffffff;
            padding: 0 4px;
            transition: 0.2s;
            -ms-user-select: none;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            z-index: 1;
        }

        .max-len {
            position: absolute;
            top: -8px;
            right: 13px;
            pointer-events: none;
            -ms-user-select: none;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            background-color: #ffffff;
            z-index: 1;
            padding: 0 4px;
            font-size: 12px;
            color: #D2D2D2;
        }

        textarea {
            padding: 0;
            height: 22px;
            width: 100%;
            color: #1D5F60;
            font-size: 18px;
            box-sizing: border-box;
            resize: none;
            z-index: 2;
            &, &:focus, &:active {
                outline: unset;
                border: unset;
            }
        }

        &.highlight {
            border: 1px solid #48ACAD;
            .label {
                top: -10px;
                color: #48ACAD;
            }
        }
    }
</style>
