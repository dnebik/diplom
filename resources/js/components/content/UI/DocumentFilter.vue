<template>
    <div class="form">
        <div v-if="['history', 'search', 'docs'].includes(routeName)" style="margin-top: 50px">
            <h2>Фильтр:</h2>
            <form @submit.prevent="Submit" autocomplete="off">
                <InputBox v-model="filter.like" label="Найти"/>
                <DateRange v-model="filter.range"/>
                <button class="btn submit" type="submit">Подтвердить</button>
            </form>
        </div>
        <div v-if="routeName === 'requests'" style="margin-top: 50px">
            <h2>Фильтр:</h2>
            <form @submit.prevent="Submit" autocomplete="off">
                <InputBox v-model="filter.like" label="Найти"/>
                <label class="select-label">
                    <span>Статус: </span>
                    <select v-model="status">
                        <option value="0">Все</option>
                        <option value="1">Новый</option>
                        <option value="3">Решен</option>
                        <option value="2">Просмотрен</option>
                    </select>
                </label>
                <DateRange v-model="filter.range"/>
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
                like: null,
                range: null,
                status: 0,
            }
        }
    },
    props: {
        routeName: {
            type: String,
            required: true,
        }
    },
    methods: {
        Submit() {
            this.$emit('submit', this.filter);
        }
    }
}
</script>

<style scoped lang="sass">

</style>
