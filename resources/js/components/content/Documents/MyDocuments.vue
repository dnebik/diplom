<template>
    <div class="my-documents-container">
<!--        <DatePicker></DatePicker>-->
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
        <ListItem id="IAV14AMF2" date="21.04.2012" fio="Небренчин Д.С." comment="Коммандировка" status="-"/>
        <ListItem id="C6MSHXWDQ"  date="01.03.2012" fio="Погонялов В.А." comment="" status="Отказано"/>
        <ListItem id="INO1LIQQY"  date="15.11.2021" fio="Васичкин Д.С." comment="Отпуск" status="Согласован"/>
    </div>
</template>

<script>
import ListItem from "../UI/ListItem";
// import DatePicker from "vue-datetime";
export default {
    name: "MyDocuments",
    components: {
        ListItem,
        // DatePicker
    }
}
</script>

<style scoped lang="sass">
    .my-documents-container
        flex: auto
</style>
