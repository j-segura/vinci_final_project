<template>
    <AdminNav>
        <div class="admin-header">
            <h2>Edit Plan</h2>
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
                            type="text"
                            pattern="[0-9]*"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="block w-full"
                            autocomplete="frequency-input"
                        />

                        <InputError :message="form.errors.frequency" class="mt-2" />
                    </div>

                </div>
            </div>

            <div>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="detail, index in form.features">
                            <td>{{ detail.name }}</td>
                            <td>{{ detail.description }}</td>
                            <td>
                                <button @click.prevent="deleteFeature(index)">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <div class="space-y-6">
                        <div>
                            <InputLabel for="detail_name" value="Name" />

                            <TextInput
                                id="detail_name"
                                ref="detail_nameInput"
                                v-model="detail.name"
                                type="text"
                                class="block w-full"
                                autocomplete="detail_name-input"
                            />

                        </div>

                    </div>
                    <div class="space-y-6">
                        <div>
                            <InputLabel for="detail_description" value="Description" />

                            <TextInput
                                id="detail_description"
                                ref="detail_descriptionInput"
                                v-model="detail.description"
                                type="text"
                                class="block w-full"
                                autocomplete="detail_description-input"
                            />

                        </div>

                    </div>
                    <button @click.prevent="addFeature(detail)" class="basic-succes-btn">Add feature</button>
                </div>
            </div>

            <div class="omt-8">
                <button type="submit" class="basic-succes-btn">Edit Plan</button>
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
        plan: Object
    },

    data() {
        return {
            form: useForm({
                name: '',
                price: '',
                frequency: '',
                features: [],
                _method: 'put',
            }),

            detail: {
                name: '',
                description: '',
            }
        };
    },

    mounted() {
        this.form.name = this.plan.name;
        this.form.price = this.plan.price;
        this.form.frequency = this.plan.frequency;
        this.form.features = JSON.parse(this.plan.features);
    },

    methods: {
        submit() {
            this.form.put(route('plans.update', this.plan), this.form, {
                preserveScroll: true,
                forceFormData: true,
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

        addFeature(detail) {
            this.form.features.push(detail);
            this.detail = {
                name: '',
                description: '',
            }
        },

        deleteFeature(index) {
            this.form.features.splice(index, 1);
        }
    },
}

</script>
