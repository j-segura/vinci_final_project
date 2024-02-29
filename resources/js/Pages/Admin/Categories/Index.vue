<template>

    <AdminNav>
        <h2>Categorieas</h2>
        <Link :href="route('categories.create')">
            <button>Create Company</button>
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
                    <td>{{ category.image }}</td>
                    <td class="text-white px-4 py-2 text-center">
                        <img v-if="category.image" :src="category.image" alt="category Logo" width="50" height="50" class="m-auto" />
                    </td>
                    <td class="text-white px-4 py-2 space-x-4 text-center">
                        <Link :href="route('categories.show', category)">
                            <button>Show</button>
                        </Link>
                        <Link :href="route('categories.edit', category)">
                            <button>Edit</button>
                        </Link>
                        <button @click="deleteCompany(category)">Delete</button>
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
            deleteCompany(item){
                this.form.delete(route('categories.destroy', item.id), {
                    preserveScroll: true,
                    onSuccess: () => {},
                    onError: () => {},
                    onFinish: () => {},
                });
            },
        },
    }

    </script>
