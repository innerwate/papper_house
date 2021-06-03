<template>
    <div>
        <div class="office-board-wrap">
            <div class="office-board-content">
                <ul class="office-menu">
                    <li><router-link :to="{name: 'my-poems'}">Мои стихотворения</router-link></li>
                    <li><router-link :to="{name: 'create-poem'}"></router-link>Добавить стихотворение</li>
                    <li v-if="_user.role.name == 'admin'"><router-link :to="{name : 'create-duel'}">Добавить дуэль</router-link></li>
                    <li v-if="_user.role.name == 'admin'"><router-link :to="{name : 'duels'}">Список дуэлей</router-link></li>
                    <li>Редактировать профиль</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            _user() {
                return this.$auth.user() || {};
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>