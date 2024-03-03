<template>
    <AdminNav>
        <div class="admin-header">
            <h2>Create Plan</h2>
            <Link :href="route('plans.index')">
                <button class="basic-gray-btn">Regresar</button>
            </Link>
        </div>
        <form @submit.prevent="submit">
            <div>
                <div class="space-y-6">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            ref="nameInput"
                            v-model="form.name"
                            type="text"
                            class="block w-full"
                            autocomplete="name-input"
                        />

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                </div>

                <div class="space-y-6">
                    <div>
                        <InputLabel for="price" value="Price" />

                        <TextInput
                            id="price"
                            ref="priceInput"
                            v-model="form.price"
                            type="text"
                            pattern="[0-9]*"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="block w-full"
                            autocomplete="price-input"
                        />

                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>

                </div>

                <div class="space-y-6">
                    <div>
                        <InputLabel for="frequency" value="Frequency" />

                        <TextInput
                            id="frequency"
                            ref="frequencyInput"
                            v-model="form.frequency"
                            type="number"
                            class="block w-full"
                            autocomplete="frequency-input"
                        />

                        <InputError :message="form.errors.frequency" class="mt-2" />
                    </div>

                </div>
            </div>

            <div>
                hola
            </div>

            <div class="omt-8">
                <button type="submit" class="basic-succes-btn">Create Plan</button>
            </div>
        </form>
    </AdminNav>
</template>

<script>

import AdminNav from "../../Admin.vue"
import { Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

export default {

    components: {
        AdminNav,
        Link,
        InputError,
        InputLabel,
        TextInput,
    },

    props: {
        categories: Object
    },

    data() {
        return {
            form: useForm({
                name: null,
                price: null,
                frequency: null,
                features: [],
            })
        };
    },

    methods: {
        submit() {
            this.form.post(route('plans.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                    if (this.form.errors.price) {
                        this.form.reset('price');
                    }
                    if (this.form.errors.frequency) {
                        this.form.reset('frequency');
                    }
                    if (this.form.errors.features) {
                        this.form.reset('features');
                    }
                },
            });
        },
    },
}

</script>
