<script setup>
import { ref, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useDetailStore } from "@/store/detail";
import { useArticleStore } from "@/store/article";
import { storeToRefs } from "pinia";
import { useRoute } from "vue-router";
import { articleService } from "@/services";
const { t, locale } = useI18n();
const articleStore = useArticleStore();
const like = ref(false);
const route = useRoute();
const { articles, selectedArticle, loading } = storeToRefs(useArticleStore());
const handleClickLike = () => {
    like.value = !like.value;
    console.log("slug123", route.params.slug, locale.value);
    if (like.value === true) {
        console.log("like1", props.like + 1);
        articleService.addLike(route.params.slug, props.like + 1).then((res) => {
            console.log('res', res)
            // if (res.data.success === 1) {
            //     article.value = res.data.article;
            // }
        });
    }
    // console.log('articles', articles)
    //   console.log("library", library);
    // libraryStore.setSelectedLibrary(library);
};
onMounted(() => {
    articleStore.fetch();
});
const props = defineProps({
    title: {
        type: String,
        default: "",
    },
    writer: {
        type: String,
        default: "",
    },
    time: {
        type: String,
        default: "",
    },
    content1: {
        type: String,
        default: "",
    },
    content2: {
        type: String,
        default: "",
    },
    content3: {
        type: String,
        default: "",
    },
    src: {
        type: String,
        default: "",
    },
    like: {
        type: Number,
        default: "",
    },
    avatar: {
        type: String,
        default: "",
    },
});
</script>
<template>
    <div class="rounded-normal shadow-fullArticle">
        <img
            :src="props.src"
            class="w-full rounded-tl-[20px] rounded-tr-[20px]"
        />
        <div class="px-3 pt-3 pb-3 text-start">
            <div class="flex gap-[14px] pb-2">
                <img :src="props.avatar" />
                <div class="flex flex-col gap-6">
                    <p class="text-[#45315D] text-base font-bold">
                        {{ props.title }}
                    </p>
                    <div class="flex gap-3 items-center">
                        <p class="text-xs font-bold text-[#313131]">
                            {{ t("articles.fullArticle.by") }}
                        </p>
                        <p class="text-xs font-normal text-[#313131]">
                            {{ t("articles.fullArticle.writer") }}
                        </p>
                        <span class="text-[#C6C6C6]">|</span>
                        <p class="text-[#C6C6C6] text-xs font-normal">
                            {{ t("articles.fullArticle.time") }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pb-2">
                <button class="px-6 py-2 bg-[#F6F6F6] rounded-2xl">
                    {{ t("articles.fullArticle.clear") }}
                </button>
                <button class="px-[14px] py-2 bg-[#F6F6F6] rounded-2xl">
                    {{ t("articles.fullArticle.stories") }}
                </button>
                <button class="px-4 py-2 bg-[#F6F6F6] rounded-2xl">
                    {{ t("articles.fullArticle.blog") }}
                </button>
            </div>

            <p
                class="text-[#313131] text-base font-normal pb-6 px-1"
                v-html="props.content1"
            />
            <div class="flex gap-4 pb-3">
                <img src="/images/articles/full/arrow-l.svg" />
                <p v-html="props.content2" />
            </div>
            <!-- <div class="flex gap-4 pb-3">
                <img src="/images/articles/full/arrow-l.svg" />
                <p v-html="props.content2" />
            </div>
            <div class="flex gap-4 pb-3">
                <img src="/images/articles/full/arrow-l.svg" />
                <p v-html="props.content2" />
            </div> -->
            <p
                class="text-[#313131] text-base font-normal pb-5 px-1"
                v-html="props.content3"
            />
            <hr />

            <div class="flex justify-between pt-5">
                <div class="flex gap-5">
                    <div
                        @click="() => handleClickLike()"
                        class="cursor-pointer py-2 px-6 bg-[#F6F6F6] flex gap-2 justify-center rounded-lg"
                    >
                        <img src="/images/articles/full/save.svg" />
                        <p class="text-[#313131] text-xs font-normal">
                            {{ t("articles.fullArticle.save") }}
                        </p>
                    </div>
                    <div
                        @click="() => handleClickLike()"
                        class="cursor-pointer py-2 px-6 bg-[#F6F6F6] flex gap-2 justify-center rounded-lg"
                    >
                        <img
                            :src="
                                like
                                    ? '/images/articles/full/like.png'
                                    : '/images/articles/full/dis-like.svg'
                            "
                        />
                        <p class="text-[#313131] text-xs font-normal">
                            {{ t("articles.card.like") }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-[10px] px-2">
                    <div><img src="/images/articles/full/facebook.svg" /></div>
                    <div><img src="/images/articles/full/twitter.svg" /></div>
                    <div><img src="/images/articles/full/instagram.svg" /></div>
                    <div><img src="/images/articles/full/youtube.svg" /></div>
                </div>
            </div>

            <!-- <p
        @click="() => handleClickDetails(props)"
        class="text-[#FF2400] text-sm font-bold underline cursor-pointer pb-6"
      >
        {{ t("articles.card.fullArticle") }}
      </p> -->
        </div>
    </div>
</template>
