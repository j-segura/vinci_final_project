<template>
    <AdminNav>
        <div class="admin-header">
            <h2>Edit Tag {{ tag.name }}</h2>
            <Link :href="route('tags.index')">
                <button class="basic-gray-btn">Regresar</button>
            </Link>
        </div>
        <form @submit.prevent="submit">
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


            <div class="mt-8">
                <button type="submit" class="basic-succes-btn">Edit Tag</button>
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
        tag: Object
    },

    data() {
        return {
            form: useForm({
                name: "",
                _method: 'put',
            })
        };
    },

    mounted() {
        this.form.name = this.tag.name;
    },

    methods: {
        submit() {
            this.form.put(route('tags.update', this.tag), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                },
            });
        },
    },
}

</script>
