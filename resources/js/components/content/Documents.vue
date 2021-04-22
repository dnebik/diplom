<template>
    <div class="flex-body">
        <div class="nv-desctop">
            <navigate></navigate>
            <div style="margin-top: 50px">
                <h3>Фильтр:</h3>
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
