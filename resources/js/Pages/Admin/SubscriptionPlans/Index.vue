<template>

    <AdminNav>
        <div class="admin-header">
            <h2>Planes</h2>
            <Link :href="route('plans.create')">
                <button class="basic-succes-btn">Create Plan</button>
            </Link>
        </div>

        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>frequency</th>
                <th>features</th>
                <th>actions</th>
            </thead>
            <tbody>
                <tr v-for="plan in plans.data">
                    <td>{{ plan.id }}</td>
                    <td>{{ plan.name }}</td>
                    <td>{{ plan.price }}</td>
                    <td>{{ plan.frequency }}</td>
                    <td>
                        {{ plan.features }}
                    </td>
                    <td>
                        <Link :href="route('plans.edit', plan)">
                            <button>Edit</button>
                        </Link>
                        <button @click="deletePlan(plan)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <Paginator :links="plans.links"/>
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
        plans: Object
    },

    data() {
        return {
            search: '',
        };
    },

    watch: {

    },

    methods: {
        deletePlan(plan){
            Inertia.delete(route('plans.destroy', plan), {
                preserveScroll: true,
                preserveState: true,
            });
        },
    },
}

</script>
