<template>
    <div>
        <div>
            <ul>
                <li>
                    <router-link to="/">Go to Foo</router-link>
                </li>
                <li>
                    <router-link to="/bar">Go to Bar</router-link>
                </li>
                <li>
                    <router-link to="/baz">Go to Baz</router-link>
                </li>
            </ul>
        </div>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>

</style>