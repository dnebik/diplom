<template>
    <div class="flex-body">
        <div class="nv-desctop" ref="nav-block">
            <navigate></navigate>

            <div v-if="$route.name === 'history'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet">
                    <InputBox v-model="like" label="Найти"/>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>
            <div v-if="$route.name === 'search'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet">
                    <InputBox v-model="like" label="Найти"/>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>
            <div v-if="$route.name === 'requests'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet">
                    <InputBox v-model="like" label="Найти"/>
                    <select>
                        <option value="">Все</option>
                        <option value="">Решен</option>
                        <option value="">Просмотрен</option>
                        <option value="">Новый</option>
                    </select>
                    <DateRange v-model="range"/>
                    <button class="btn submit" type="submit">Подтвердить</button>
                </form>
            </div>
            <div v-if="$route.name === 'docs'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <form @submit.prevent="filtSet">
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
            like: null,
            range: null,

            filter: {
                like: null,
                range: null
            },
        }
    },
    watch: {
        '$route': {
            handler: 'formUpdate',
            deep: true,
            immediate: true
        }
    },
    // mounted() {
    //     console.log(this);
    // },
    methods: {
        filtSet() {
            this.filter = {}
            this.filter['like'] = this.like !== null || this.like > 0 ? this.like : null;
            if (this.range !== null)
            {
                let start = this.range.start;
                start = new Date(
                    +start.getFullYear(),
                    +start.getMonth(),
                    +start.getDate() + 1
                );
                let end = this.range.end;
                end = new Date(
                    +end.getFullYear(),
                    +end.getMonth(),
                    +end.getDate() + 1,
                    23,
                    59,
                    59,
                    999
                );
                this.filter['range'] = {
                    start: start.getTime(),
                    end: end.getTime()
                }
            }
            else this.filter['range'] = null;
        },
        formUpdate() {
            setTimeout(() => {
                this.range = null;
                this.like = null;
                let form = this.$refs['nav-block'].getElementsByTagName('form');
                if (form.length > 0) {
                    form[0].getElementsByTagName('button')[0].click();
                }
            }, 1)
        }
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
