<script setup>
import { useI18n } from "vue-i18n";
import FullCard from "@/components/articles/FullCard.vue";
import MiniCard from "@/components/articles/MiniCard.vue";

import { useArticleStore } from "@/store/article";
import { storeToRefs } from "pinia";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import { articleService } from "@/services";

const { t, locale } = useI18n();
const articleStore = useArticleStore();
const { articles } = storeToRefs(useArticleStore());
const article = ref({});
onMounted(() => {
  // articleStore.fetch();
    const route = useRoute();
    console.log("slug", route.params.slug, locale.value);
    // Get data from api with cache time of 300 seconds
    articleService.getApiWithSlug(route.params.slug).then((res) => {
      // console.log('res', res)
        if (res.data.success === 1) {
            // title.value = res.data.article.title[locale.value];
            // content.value = res.data.article.data[locale.value].content;
            // src.value = Object.values(res.data.article.data.en.image)[0];
            article.value = res.data.article;
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
          {{ t("about.title") }}
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
    <div class="pt-16 pb-16">
      <div class="grid grid-cols-4 gap-7">
        <full-card
          class="col-span-3"
          v-if="article.title"
          :title="article.title[locale]"
          :writer="t('articles.fullArticle.writer')"
          :time="t('articles.fullArticle.time')"
          :content1="article.data[locale].content"
          :content2="article.data[locale].content"
          :content3="article.data[locale].content"
          :src="'/storage/' + article.seo.image"
          :like="article.like"
          avatar="/images/articles/full/avatar.png"
        />
        <div>
          <p class="pb-3 text-start">{{ t("articles.fullArticle.similar") }}</p>
          <div class="flex flex-col gap-5">
            <mini-card
              class=""
              :title="t('articles.fullArticle.similar')"
              :date="t('articles.fullArticle.date')"
              src="/images/articles/full/1.svg"
            />
            <mini-card
              class=""
              :title="t('articles.fullArticle.similar')"
              :date="t('articles.fullArticle.date')"
              src="/images/articles/full/2.svg"
            />
            <mini-card
              class=""
              :title="t('articles.fullArticle.similar')"
              :date="t('articles.fullArticle.date')"
              src="/images/articles/full/3.svg"
            />
            <mini-card
              class=""
              :title="t('articles.fullArticle.similar')"
              :date="t('articles.fullArticle.date')"
              src="/images/articles/full/4.svg"
            />
          </div>
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
