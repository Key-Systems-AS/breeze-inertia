<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <table-people :users=users></table-people>


                        <div class="w-1/4 mt-20">
                            <p class="text-2xl mb-5">New user</p>

                            <BreezeValidationErrors class="mb-4" />

                            <form @submit.prevent="submit">
                                <div class="mt-4">
                                    <BreezeLabel for="name" value="Name" />
                                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                </div>
                                <div class="mt-4">
                                    <BreezeLabel for="email" value="Email" />
                                    <BreezeInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
                                </div>
                                <div class="mt-4">
                                    <BreezeLabel for="password" value="Password" />
                                    <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autofocus autocomplete="password" />
                                </div>
                                <div class="mt-4">
                                    <BreezeButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Save
                                    </BreezeButton>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import TablePeople from '@/Components/TablePeople.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';


export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        TablePeople,
        BreezeValidationErrors,
        Head,
    },
    props: {
        users: Array,
        errors: Object
    },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: ''
                }
        }
    },
    methods: {
        submit() { // Sjekk FormHelper https://inertiajs.com/forms
          this.$inertia.post('/users', this.form, {
                    preserveScroll: true,
                    onSuccess: () => this.resetForm(),
                });
        },
        resetForm() {
            this.form.name = ''
            this.form.email = ''
            this.form.password = ''
        }
    }
}
</script>
