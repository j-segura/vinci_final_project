<template>

    <AdminNav>
        <div class="admin-header">
            <h2>Social Media</h2>
            <Link :href="route('social-medias.create')">
                <button class="basic-succes-btn">Add Social Media</button>
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
                <tr v-for="socialMedia in socialMedias.data">
                    <td>{{ socialMedia.id }}</td>
                    <td>{{ socialMedia.name }}</td>
                    <td>
                        <div class="portrait">
                            <img v-if="socialMedia.icon" :src="socialMedia.icon" alt="socialMedia Logo" width="50px" height="50px" class="m-auto" />
                        </div>
                    </td>
                    <td>
                        <Link :href="route('social-medias.edit', socialMedia)">
                            <button>Edit</button>
                        </Link>
                        <button @click="deleteSocialMedia(socialMedia)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <Paginator :links="socialMedias.links"/>
    </AdminNav>

</template>

<script>

import AdminNav from "../../Admin.vue";
import { Link } from '@inertiajs/vue3';
import Paginator from '@/Components/Paginator.vue';
import { Inertia } from "@inertiajs/inertia";

export default {

    components: {
        AdminNav,
        Link,
        Paginator,
    },

    props: {
        socialMedias: Object
    },

    data() {
        return {
            search: '',
        };
    },

    watch: {

    },

    methods: {
        deleteSocialMedia(socialMedia){
            Inertia.delete(route('social-medias.destroy', socialMedia), {
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
}

</script>

<style>
.portrait {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
}
</style>
