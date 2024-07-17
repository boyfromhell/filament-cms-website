<script setup>
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import { Form } from "vee-validate";
import BaseInput from "@/components/BaseInput.vue";
import { contactService } from "@/services";
import BaseTextarea from "@/components/BaseTextarea.vue";
import { HollowDotsSpinner } from "epic-spinners";
import * as Yup from "yup";
const schema = Yup.object().shape({
    name: Yup.string().min(6).required(),
    email: Yup.string().email().required(),
    message: Yup.string().min(6).required(),
});
const showAnimator = ref(false);
const errorMessage = ref(null);
const successMessage = ref(null);
const onSubmit = (values) => {
    errorMessage.value = null;
    successMessage.value = null;
    // Submit to API
    console.log(values); // { email: 'email@gmail.com' }
    showAnimator.value = true;
    contactService
        .sendEmail({
            ...values,
        })
        .then((res) => {
            console.log("res", res.data);
            if (res.data) {
                successMessage.value = res.data;
                document.getElementById("MailSender").reset();
                setTimeout(() => {
                    successMessage.value = null;
                }, 3000);
            }
            showAnimator.value = false;
        })
        .catch((err) => {
            document.getElementById("MailSender").reset();
            console.log("Error:", err);
            if (err.response.status === 404) {
                console.log("ok");
                errorMessage.value = "Please input correct value";
            } else {
                errorMessage.value = err.response?.data?.message;
            }
            showAnimator.value = false;
        })
        .finally(() => {});
};
const { t, locale } = useI18n();
</script>
<template>
    <div
        :class="
            'max-w-[1440px] mx-auto relative ' +
            (locale === 'en' ? 'envelop-en-left-bg' : 'envelop-ar-right-bg')
        "
    >
        <div class="absolute hidden right-0 left-0 top-7 z-0">
            <div class="flex justify-between">
                <img
                    :src="[
                        locale === 'en'
                            ? '/images/home/contact-envelope-l.svg'
                            : '/images/home/contact-envelope-r.svg',
                    ]"
                />
                <img
                    :src="[
                        locale === 'en'
                            ? '/images/home/contact-message-l.svg'
                            : '/images/home/contact-message-r.svg',
                    ]"
                />
            </div>
        </div>
        <div class="px-16">
            <div class="relative">
                <p
                    class="absolute ltr:left-8 rtl:right-8 top-[3px] text-2xl font-bold text-[#45315D] z-10"
                >
                    {{ t("contact.title") }}
                </p>

                <div
                    :class="[
                        ' absolute top-0 w-20 h-10 z-0',
                        locale === 'en'
                            ? 'react-circle-l rounded-tl-full rounded-bl-full left-0 '
                            : 'react-circle-r rounded-tr-full rounded-br-full right-0 ',
                    ]"
                ></div>
            </div>
        </div>
        <div class="pt-20 px-16">
            <div class="grid grid-cols-2 gap-10 items-center">
                <Form
                    class="bg-white text-start shadow-form rounded-[10px] pt-[52px] pb-11 px-10"
                    @submit="onSubmit"
                    :validation-schema="schema"
                    id="MailSender"
                >
                    <p
                        class="text-3xl text-[#313131] font-bold pl-1 rtl:pr-1 pb-4"
                    >
                        {{ t("contact.formTitle") }}
                    </p>
                    <div class="pb-6">
                        <p class="px-4 pb-[6px]">
                            <span class="text-[#313131] text-xs font-bold">{{
                                t("contact.name.title")
                            }}</span
                            ><span class="text-[#FF0000] text-sm">*</span>
                        </p>
                        <base-input
                            input-type="text"
                            name="name"
                            :placeholder="t('contact.name.placeholder')"
                            class="w-full font-readex text-base font-light"
                        />
                    </div>
                    <div class="pb-6">
                        <p class="px-4 pb-[6px]">
                            <span class="text-[#313131] text-xs font-bold">{{
                                t("contact.email.title")
                            }}</span
                            ><span class="text-[#FF0000] text-sm">*</span>
                        </p>
                        <base-input
                            input-type="email"
                            name="email"
                            :placeholder="t('contact.email.placeholder')"
                            class="w-full font-readex text-base font-light"
                        />
                    </div>
                    <div class="">
                        <p class="px-4 pb-[6px]">
                            <span class="text-[#313131] text-xs font-bold">{{
                                t("contact.message.title")
                            }}</span
                            ><span class="text-[#FF0000] text-sm">*</span>
                        </p>
                        <base-textarea
                            input-type="text"
                            name="message"
                            :placeholder="t('contact.message.placeholder')"
                            class="w-full font-readex text-base font-light"
                        />
                    </div>
                    <div v-if="errorMessage">
                        <p class="text-red-500 text-sm text-end">
                            {{ t("contact.sendError") }}
                        </p>
                    </div>
                    <div v-if="successMessage">
                        <p class="text-green-600 text-sm text-end">
                            {{ t("contact.sendSuccess") }}
                        </p>
                    </div>
                    <div v-if="!showAnimator">
                        <div class="text-end pt-6">
                            <button
                                class="w-1/2 h-12 bg-[#6B6B6B] rounded-lg text-sm font-normal"
                            >
                                {{ t("contact.sendNow") }}
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end pt-6" v-else>
                        <hollow-dots-spinner
                            :animation-duration="1000"
                            :dot-size="15"
                            :dots-num="3"
                            color="#4BC49A"
                        />
                    </div>
                </Form>
                <img
                    :src="[
                        locale === 'en'
                            ? '/images/home/contact-l.svg'
                            : '/images/home/contact-r.svg',
                    ]"
                />
            </div>
        </div>
    </div>
</template>
<style>
.envelop-ar-right-bg {
    background-image: url("/images/home/contact-envelope-r.svg"),
        url("/images/home/contact-message-r.svg");
    background-repeat: no-repeat;
    background-position: right top 28px, left top 28px;
}
.envelop-en-left-bg {
    background-image: url("/images/home/contact-envelope-l.svg"),
        url("/images/home/contact-message-l.svg");
    background-repeat: no-repeat;
    background-position: left top 28px, right top 28px;
}
</style>
