<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    posyandu: {
        type: Object,
        default: ()=>({})
    }
})
const form = useForm({
    username: '',
    name: '',
    no_telpon: '',
    posyandus_id:'',
    alamat: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nama Lengkap" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="no_telpon" value="No. Telpon" />

                <TextInput id="no_telpon" type="tel" class="mt-1 block w-full" v-model="form.no_telpon" required autofocus
                     />

                <InputError class="mt-2" :message="form.errors.no_telpon" />
            </div>
            <div class="col-span-full sm:col-span-3">
                <label for="posyandus_id" class="text-sm">Nama Posyandu</label>
                <select name="posyandus_id" id="posyandus_id" v-model="form.posyandus_id" class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm w-full text-gray-900">
                    <option value="">-----</option>
                    <option v-for="pos in posyandu" :value="pos.id" >{{pos.nama}}</option>
                </select>
                <InputError :message="form.errors.posyandus_id"/>

            </div>
            <div>
                <InputLabel for="alamat" value="Alamat" />

                <TextInput id="alamat" type="text" class="mt-1 block w-full" v-model="form.alamat" required autofocus
                   />

                <InputError class="mt-2" :message="form.errors.alamat" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                   />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="mt-4">
                <InputLabel for="username" value="Username" />

                <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
