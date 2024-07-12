<script setup>
import { useLibraryStore } from "@/store/library";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import DetailCard from "@/components/DetailCard.vue";
import BlogCard from "@/components/BlogCard.vue";
import { libraryService } from "@/services";
const { t, locale } = useI18n();
const libraryStore = useLibraryStore();
const { librarys } = storeToRefs(useLibraryStore());
const library = ref({});
onMounted(() => {
    libraryStore.fetch();
    const route = useRoute();
    console.log("slug", route.params.slug, locale.value);
    // Get data from api with cache time of 300 seconds
    libraryService.getApiWithSlug(route.params.slug).then((res) => {
        if (res.data.success === 1) {
            console.log("slug", res);
            // title.value = res.data.library.title[locale.value];
            // content.value = res.data.library.data[locale.value].content;
            // src.value = Object.values(res.data.library.data.en.image)[0];
            library.value = res.data.library;
            console.log("image", res.data.library.seo.image);
        }
    });
});
</script>
<template>
    <div class="max-w-[1440px] mx-auto px-24">
        <div class="pt-12">
            <div class="relative">
                <p
                    class="absolute ltr:left-8 rtl:right-8 top-[3px] text-2xl font-bold text-[#45315D] z-10"
                >
                    {{ t("resourceLibrary.title") }}
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

        <div class="pt-20 flex flex-col gap-12">
            <detail-card
                v-if="library.title"
                :title="library.title[locale]"
                :content="library.data[locale].content"
                :src="'/storage/' + library.seo.image"
            />
        </div>

        <p class="pt-11 pb-5 text-[#45315D] font-bold text-lg text-start">
            {{ t("library.details.suggestedBlog") }}
        </p>
        <div class="grid grid-cols-3 gap-10 pb-16">
            <div v-for="library in librarys" :key="library.id">
                <div v-if="library.title[locale]">
                    <blog-card
                        :title="library.title[locale]"
                        :content="library.data[locale].content"
                        :src="'/storage/' + library.seo.image"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.react-circle-l {
    background-image: linear-gradient(to right, #ff9280, #ff2400);
}
.react-circle-r {
    background-image: linear-gradient(to right, #ff2400, #ff9280);
}
</style>
