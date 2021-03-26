<template>
    <div class="input-file" ref="body">
        <label class="input">
            <input type="file" @change="file = $event.target.files[0]">
        </label>
        <div class="visual">
            <svg ref="clip" class="clip" width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.268 33.3139C15.2817 34.3277 16.6832 34.9536 18.2304 34.9499C19.7294 34.9463 21.1402 34.3591 22.2026 33.2966C23.2652 32.2341 23.8523 30.8234 23.856 29.3243L23.9109 6.58895C23.9136 5.47994 23.4843 4.43839 22.702 3.65609C21.9197 2.87383 20.8781 2.44447 19.7691 2.44719C18.6602 2.44987 17.6165 2.88423 16.8304 3.67032C16.0444 4.45637 15.61 5.50004 15.6073 6.60902L15.5599 26.2577C15.5563 27.7419 16.7608 28.9463 18.2449 28.9428C19.7291 28.9392 20.9394 27.7289 20.943 26.2447L20.9764 12.4222C20.9774 12.0157 20.6486 11.6868 20.2419 11.6878C19.8353 11.6887 19.5049 12.0191 19.5039 12.4258L19.4706 26.2483C19.4689 26.9205 18.9208 27.4687 18.2485 27.4704C17.5763 27.472 17.0307 26.9265 17.0324 26.2542L17.0798 6.60546C17.0815 5.88977 17.3619 5.21627 17.8691 4.70902C18.3764 4.20173 19.0499 3.92138 19.7656 3.91969C21.243 3.91612 22.442 5.11515 22.4384 6.59255L22.3835 29.3279C22.3809 30.4336 21.9478 31.4742 21.164 32.2579C20.3802 33.0417 19.3397 33.4748 18.234 33.4774C15.9514 33.4829 14.0989 31.6304 14.1044 29.348L14.1454 12.3929C14.1464 11.9864 13.8176 11.6575 13.411 11.6585C13.0044 11.6594 12.6739 11.9899 12.6729 12.3965L12.632 29.3515C12.6283 30.8987 13.2542 32.3002 14.268 33.3139V33.3139Z" fill="#48ACAD"/>
            </svg>

            <div class="text" ref="text">
                Выберите <br/> файл
            </div>

            <svg ref="border" class="border" width="81" height="81" viewBox="0 0 81 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1"
                      y="1" width="79"
                      height="79" rx="4"
                      stroke="#48ACAD"
                      stroke-width="2"
                      :stroke-dasharray="file !== null ? '' : '6 2'"/>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "InputFile",
    data() {
        return {
            file: null,
        }
    },
    watch: {
        file(to) {
            console.log(to)
            this.$emit('change', to);
            this.$refs.body.classList.add('clip');

            let text = to.name;
            if (text.length > 20)
                text = text.substr(0, 20) + '...';

            this.$refs.text.innerText = text;
        }
    }
}
</script>

<style scoped lang="scss">

.input-file {
    position: relative;
    width: 120px;
    height: 120px;

    .input {
        width: 100%;
        height: 100%;
        display: block;
        input {
            display: none;
        }
    }

    .visual {
        width: 100%;
        height: 100%;
        pointer-events: none;
        position: absolute;
        top: 0;
        left: 0;
        //overflow: hidden;
        .clip {
            width: auto;
            height: 65px;
            position: absolute;
            top: 7px;
            left: 50%;
            transform: translateX(-50%);
        }
        .border {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 2;
        }
        .text {
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 15px);
            z-index: 1;
            height: 38px;
            margin: 0 auto;
            box-sizing: border-box;
            overflow: hidden;
            text-align: center;
            position: absolute;
            bottom: 8px;
            word-wrap: break-word;
        }
    }

    &:not(:hover) {
        & .text {
            color: #48ACAD40;
        }
        & .border rect {
            stroke: #48ACAD40;
        }
        & .clip path {
            fill: #48ACAD40;
        }
    }
    &:hover {
        & .text {
            color: #48ACAD;
        }
        & .border rect {
            stroke: #48ACAD;
        }
        & .clip path {
            fill: #48ACAD;
        }
    }

    &.clip {
        & .visual {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        & .text {
            display: block;
            color: #48ACAD;
            transform: unset;
            left: unset;
            bottom: unset;
        }
        & .border rect {
            stroke: #48ACAD;
        }
        & .clip {
            top: -25px;
            right: -11px;
            transform: unset;
            left: unset;
            path {
                fill: #48ACAD;
            }
        }
    }
}

</style>
