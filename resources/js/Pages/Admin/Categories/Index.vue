<template>

    <AdminNav>
        <h2>Categorieas</h2>
        <Link :href="route('categories.create')">
            <button>Create Category</button>
        </Link>
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
                    <td class="text-white px-4 py-2 text-center" >
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
    </AdminNav>

</template>

<script>

import AdminNav from "../../Admin.vue"
import { Link } from '@inertiajs/vue3';

export default {

    components: {
        AdminNav,
        Link,
    },

    props: {
        categories: Object
    },

    methods: {
        deleteCategory(category){
            this.form.delete(route('categories.destroy', category.id), {
                preserveScroll: true,
                onSuccess: () => {},
                onError: () => {},
                onFinish: () => {},
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
