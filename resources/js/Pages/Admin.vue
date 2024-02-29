<template>
    <Head title="Admin"/>

    <AuthenticatedLayout>
        <section id="admin-dashboard">
            <aside :class="is_expanded && 'is-expanded'">
                <button @click="ToggleMenu">
                    <span class="material-symbols-outlined" v-if="is_expanded">
                        arrow_back
                    </span>
                    <span class="material-symbols-outlined" v-else>
                        arrow_forward
                    </span>
                </button>

                <h3>Tables</h3>
                <div class="menu">
                    <Link :href="route('tags')" class="button" :active="route().current('tags')">
                        <span class="material-symbols-outlined">sell</span>
                        <span class="text">Tags</span>
                    </Link>
                    <Link :href="route('categories.index')" class="button" :active="route().current('categories.index')">
                        <span class="material-symbols-outlined">view_cozy</span>
                        <span class="text">Categories</span>
                    </Link>
                    <Link :href="route('tags')" class="button" :active="route().current('tags')">
                        <span class="material-symbols-outlined">group</span>
                        <span class="text">Users</span>
                    </Link>
                </div>
            </aside>
            <div class="admin-content">
                <slot />
            </div>
        </section>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,
        Link,

    },

    data() {

        return {

            is_expanded: false,

        };

    },

    methods: {

        ToggleMenu() {

            this.is_expanded = !this.is_expanded;

        }

    },

}

</script>
