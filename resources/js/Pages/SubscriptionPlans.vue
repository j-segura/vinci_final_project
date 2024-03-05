<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div id="plans">
            <div class="header">
                <div class="header-img opacity-7">
                    <img src="./../img/old-FH.jpg" alt="">
                </div>
                <div class="header-content mb-20">
                    <h1>Flexible plans & Pricing</h1>
                    <p>upgrade to premiun and get access to more functionalities</p>
                </div>
            </div>
            <div class="plans">
                <div class="plan-card" v-for="plan in plans">
                    <div class="plan-header">
                        <h3 class="third-color">{{ plan.name }}</h3>
                        <p><span>${{ plan.price }}/</span>month</p>
                    </div>
                    <hr>
                    <div class="plan-characteristics">
                        <div class="characteristy" v-for="feature in JSON.parse(plan.features)">
                            <div class="check"></div>
                            <p><span>{{ feature.name }}</span> {{ feature.description }}</p>
                        </div>
                    </div>
                    <!-- <button class="boton-bg forth-bg">
                        CURRENT PLAN
                    </button> -->
                    <button class="boton-bg third-bg">
                        SUBSCRIBE
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {

    components: {

        AuthenticatedLayout,
        Head,

    },

    props: {
        plans: Object,
    },

    data() {

        return {


        };

    },

}

</script>
