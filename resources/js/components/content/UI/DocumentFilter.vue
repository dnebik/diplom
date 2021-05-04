<template>
    <div class="form" ref="form">
        <div v-if="['history', 'search', 'docs'].includes(routeName)" style="margin-top: 50px;">
            <h2>Фильтр:</h2>
            <form @submit.prevent="Submit" autocomplete="off">
                <InputBox style="width: inherit; box-sizing: border-box" v-model="filter.like" label="Найти" ref="i"/>
                <DateRange v-model="filter.range" ref="z"/>
                <button class="btn submit" type="submit">Подтвердить</button>
            </form>
        </div>
        <div v-if="routeName === 'requests'" style="margin-top: 50px">
            <h2>Фильтр:</h2>
            <form @submit.prevent="Submit" autocomplete="off">
                <InputBox v-model="filter.like" label="Найти"/>
                <label class="select-label">
                    <span>Статус: </span>
                    <select v-model="filter.status">
                        <option value="0">Все</option>
                        <option value="1">Новый</option>
                        <option value="3">Решен</option>
                        <option value="2">Просмотрен</option>
                    </select>
                </label>
                <DateRange style="width: 100%; box-sizing: content-box" v-model="filter.range"/>
                <button class="btn submit" type="submit">Подтвердить</button>
            </form>
        </div>
    </div>
</template>

<script>
import InputBox from "./InputBox";
import DateRange from "./DateRange";
export default {
    name: "DocumentFilter",
    components: {
        InputBox,
        DateRange,
    },
    data() {
        return {
            filter: {
                like: '',
                range: null,
                status: 0,
            },
            size: 0,
        }
    },
    props: {
        routeName: {
            type: String,
            required: true,
        }
    },
    watch: {
        '$refs': {
            handler: 'refsChange',
            deep: true,
            immediate: true,
        },
        '$route': {
            handler: 'refsChange',
            deep:true,
            immediate: true,
        }
    },
    mounted() {
        // setInterval(() => {console.log(this.$refs)}, 1000);
    },
    methods: {
        Submit() {
            this.$emit('submit', this.filter);
        },
        refsChange() {
            setTimeout(() => {
                if (this.$refs.z) this.size = this.$refs.z.$el.clientWidth;
                this.$refs.form.style.width = this.size + 'px';
            },100)
        }
    }
}
</script>

<style scoped lang="sass">
    .form
        box-sizing: border-box
        display: block !important
        & > div
            display: flex
            flex-direction: column
            justify-content: center
            & > form
                min-width: max-content
                display: flex
                flex-direction: column
                align-items: flex-end
                justify-content: center
                .select-label
                    width: 100%
</style>
