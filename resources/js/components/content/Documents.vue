<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>

            <div v-if="$route.name === 'history'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <InputBox label="Найти"/>
                <DateRange/>
            </div>
            <div v-if="$route.name === 'search'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <InputBox label="Найти"/>
                <DateRange/>
            </div>
            <div v-if="$route.name === 'requests'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <InputBox label="Найти"/>
                <select>
                    <option value="">Все</option>
                    <option value="">Решен</option>
                    <option value="">Просмотрен</option>
                    <option value="">Новый</option>
                </select>
                <DateRange/>
            </div>
            <div v-if="$route.name === 'docs'" style="margin-top: 50px">
                <h2>Фильтр:</h2>
                <InputBox label="Найти"/>
                <DateRange/>
            </div>


        </div>
        <router-view></router-view>
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
    mounted() {
        console.log(this.$route);
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


</style>
