<template>

    <AdminNav>
        <div class="admin-header">
            <h2>Categories</h2>
            <Link :href="route('categories.create')">
                <button class="basic-succes-btn">Create Category</button>
            </Link>
        </div>

        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>image</th>
                <th>actions</th>
            </thead>
            <tbody>
                <tr v-for="category in categories.data">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>
                        <div class="portrait">
                            <img v-if="category.image" :src="category.image" alt="category Logo" width="50px" height="50px" class="m-auto" />
                        </div>
                    </td>
                    <td>
                        <Link :href="route('categories.edit', category)">
                            <button>Edit</button>
                        </Link>
                        <button @click="deleteCategory(category)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <Paginator :links="categories.links"/>
    </AdminNav>

</template>

<script>

import AdminNav from "../../Admin.vue"
import { Link } from '@inertiajs/vue3';
import Paginator from '@/Components/Paginator.vue';
import { Inertia } from "@inertiajs/inertia"

export default {

    components: {
        AdminNav,
        Link,
        Paginator,
    },

    props: {
        categories: Object
    },

    data() {
        return {
            search: '',
        };
    },

    watch: {

    },

    methods: {
        deleteCategory(category){
            Inertia.delete(route('categories.destroy', category), {
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
}

</script>

<style>
.portrait {
    width: 100px;
    height: 100px;
    overflow: hidden;
}
</style>
