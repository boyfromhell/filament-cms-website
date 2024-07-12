<script setup>
import { useI18n } from "vue-i18n";
import { ref, onMounted, computed } from "vue";
import { useArticleStore } from "@/store/article";
import router from "@/router";
import { storeToRefs } from "pinia";
const { t, locale } = useI18n();
const libraryStore = useArticleStore();
const hour = ref("");
const minute = ref("");
const period = ref("");
const { articles, selectedArticle, loading } = storeToRefs(useArticleStore());
const handleClickDetails = (article) => {
    //   console.log("article.slug", article.slug);
    libraryStore.setSelectedArticle(article);
    // router.push("/articles/full");
    router.push({ name: "Article", params: { slug: article.slug } });
};
onMounted(() => {
    getTime(props.date);
});
const props = defineProps({
    title: {
        type: String,
        default: "",
    },
    slug: {
        type: String,
        default: "",
    },
    content: {
        type: String,
        default: "",
    },
    date: {
        type: String,
        default: "",
    },
    looked: {
        type: String,
        default: "",
    },
    like: {
        type: String,
        default: "",
    },
    fullArticle: {
        type: String,
        default: "",
    },
    src: {
        type: String,
        default: "",
    },
});

const getDay = (time) => {
    const someDate = new Date(time);

    const dayIndex = someDate.getDay();
    const dayName = [
        computed(() => t("articles.day.sunday")),
        computed(() => t("articles.day.monday")),
        computed(() => t("articles.day.tuesday")),
        computed(() => t("articles.day.wednesday")),
        computed(() => t("articles.day.thursday")),
        computed(() => t("articles.day.friday")),
        computed(() => t("articles.day.saturday")),
    ][dayIndex];
    return dayName;
    // console.log(`The day was: ${dayName}`);
};
const getTime = (time) => {
    const date = new Date(time);
    const hours24 = date.getUTCHours();
    const minutes = date.getUTCMinutes();
    let period1 =  computed(() => t("articles.day.am"));
    let hours12 = hours24;
    if (hours24 >= 12) {
        period1 = computed(() => t("articles.day.pm"));
        if (hours24 > 12) hours12 = hours24 - 12;
    }
    hour.value = hours12;
    minute.value = minutes;
    period.value = period1;
    return true;
    // console.log(`The day was: ${dayName}`);
};
</script>
<template>
    <div class="rounded-normal shadow-article">
        <img :src="props.src" />
        <div class="px-3 pt-1 pb-8 text-start">
            <div class="text-start">
                <p class="text-[#9367C7] text-sm font-bold">
                    {{ props.title }}
                </p>
            </div>
            <div class="relative ">
                <p class="text-[#313131] text-xs font-light flex absolute rtl:left-0 ltr:right-0">
                    <span>{{ getDay(props.date) }}&nbsp;</span>
                    <span>{{ hour }}:</span>
                    <span>{{ minute }}&nbsp;</span>
                    <span>{{ period }}</span>
                </p>
            </div>

            <p class="text-[#313131] text-[11px] font-normal pb-3 pt-5" v-html="props.content" />
            <p
                @click="() => handleClickDetails(props)"
                class="text-[#FF2400] text-sm font-bold underline cursor-pointer pb-6"
            >
                {{ t("articles.card.fullArticle") }}
            </p>
            <div class="flex gap-5">
                <div class="flex gap-1">
                    <img src="/images/articles/view.svg" />
                    {{ props.looked }}
                    {{ t("articles.card.view") }}
                </div>
                <div class="flex gap-1">
                    <img src="/images/articles/like.svg" />
                    {{ props.like }}
                    {{ t("articles.card.like") }}
                </div>
            </div>
        </div>
    </div>
</template>
