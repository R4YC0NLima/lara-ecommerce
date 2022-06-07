<script>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

export default {
    components: {
        Head, 
        useForm,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors
    },
    props: {
        status: String,
        phoneNumber: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                phone_number: this.phoneNumber,
                verification_code: ''   
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('verify'));
        }
    }
}

// defineProps({
//     status: String,
//     phoneNumber: String,
// });

// const form = useForm({
//     phone_number: this.phoneNumber,
//     verification_code: ''
// });

// const submit = () => {
//     form.post(route('verify'));
// };
</script>

<template>
    <Head title="Forgot Password" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="phone" value="Phone" />
                <JetInput
                    id="phone"
                    type="hidden"
                    v-model="form.phone_number"
                    class="mt-1 block w-full"
                />

                <JetLabel for="verification_code" value="verification_code" />
                <JetInput
                    id="verification_code"
                    v-model="form.verification_code"
                    type="tel"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Verificar número de telefone
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
