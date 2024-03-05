<template>

    <AdminNav>
        <div class="admin-header">
            <h2>Tags</h2>
            <Link :href="route('tags.create')">
                <button class="basic-succes-btn">Create Tag</button>
            </Link>
        </div>

        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>actions</th>
            </thead>
            <tbody>
                <tr v-for="tag in tags.data">
                    <td>{{ tag.id }}</td>
                    <td>{{ tag.name }}</td>
                    <td>
                        <Link :href="route('tags.edit', tag)">
                            <button>Edit</button>
                        </Link>
                        <button @click="deleteTag(tag)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <Paginator :links="tags.links"/>
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
        tags: Object
    },

    data() {
        return {
            search: '',
        };
    },

    watch: {

    },

    methods: {
        deleteTag(tag){
            Inertia.delete(route('tags.destroy', tag), {
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
