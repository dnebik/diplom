<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>

            <div v-if="$route.name === 'history'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet" autocomplete="off">
                    <InputBox v-model="like" label="Найти"/>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>
            <div v-if="$route.name === 'search'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <InputBox label="Найти"/>
                <DateRange/>
            </div>
            <div v-if="$route.name === 'requests'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet" autocomplete="off">
                    <InputBox v-model="like" label="Найти"/>
                    <label class="select-label">
                        <p>Статус: </p>
                        <select v-model="status">
                            <option value="0">Все</option>
                            <option value="1">Новый</option>
                            <option value="3">Решен</option>
                            <option value="2">Просмотрен</option>
                        </select>
                    </label>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>
            <div v-if="$route.name === 'docs'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet" autocomplete="off">
                    <InputBox v-model="like" label="Найти"/>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>


        </div>
        <div style="width: 100%">
            <router-view :filter="filter"></router-view>
        </div>
    </div>
</template>

<script>
import DateRange from "./UI/DateRange";
import InputBox from "./UI/InputBox";
export default {
    name: "Documents",
    components: {
        DateRange,
        InputBox
    },
    data() {
        return {
            like: '',
            range: null,
            status: 0,

            filter: {
                like: null,
                range: null,
                status: 0,
            },
        }
    },
    mounted() {
        console.log(this.$route);
    },
    methods: {
        filtSet(event) {
            this.filter = {}
            this.$set(this.filter, 'like', this.like.length > 0 ? this.like : null);
            this.$set(this.filter, 'status', this.status);
            if (this.range !== null)
                this.$set(this.filter, 'range', {
                    start: this.range.start.getTime(),
                    end: this.range.end.getTime()
                });
            else this.$set(this.filter, 'range', null);

        },
    }
}
</script>

<style scoped lang="sass">

.flex-body
    display: flex

.nv-desctop
    margin-right: 63px
    min-width: 250px
    @media (max-width: 414px)
        display: none

    .btn
        float: right
        margin-top: 20px
</style>
