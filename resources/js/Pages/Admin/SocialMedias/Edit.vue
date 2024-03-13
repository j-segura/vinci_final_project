<template>
    <AdminNav>
        <div class="admin-header">
            <h2>Edit {{ socialMedia.name }}</h2>
            <Link :href="route('social-medias.index')">
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

                <div>
                    <input type="file" id="icon" name="icon"
                        @input="form.icon = $event.target.files[0]"/>
                </div>

            </div>


            <div class="mt-8">
                <button type="submit" class="basic-succes-btn">Edit Social Media</button>
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
        socialMedia: Object
    },

    data() {
        return {
            form: useForm({
                name: "",
                icon: null,
                _method: 'put',
            })
        };
    },

    mounted() {
        this.form.name = this.socialMedia.name;
    },

    methods: {
        submit() {
            this.form.put(route('social-medias.update', this.socialMedia), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                    if (this.form.errors.icon) {
                        this.form.reset('icon');
                    }
                },
            });
        },
    },
}

</script>
