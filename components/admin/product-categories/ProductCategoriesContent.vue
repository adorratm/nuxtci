<template>
  <div>
    <Tree v-model="product_categories" :textKey="'id'" :childrenKey="'top_id'" :virtualization="true" :watermark="true">
      <span slot-scope="{ node, path, tree }">
        <b class="btn btn-pink btn-sm py-0" @click="tree.toggleFold(node, path)" v-html="node.$folded ? '<i class=\'fa fa-plus\'></i>' : '<i class=\'fa fa-minus\'></i>'"></b>
        <input
          type="checkbox"
          :checked="node.$checked"
          @change="tree.toggleCheck(node, path)"
        />
        {{ node.text }}
      </span>
    </Tree>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import "he-tree-vue/dist/he-tree-vue.css";
import { Tree, Draggable, Check, Fold } from "he-tree-vue";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    Tree: Tree.mixPlugins([Draggable, Check, Fold]),
  },
  props: ["id"],
  data() {
    return {

      product_categories: [],
    };
  },
  methods: {
    getFormData(object) {
      return Object.keys(object).reduce((formData, key) => {
        if (object[key] !== null) {
          formData.append(
            key,
            Array.isArray(object[key])
              ? JSON.stringify(object[key])
              : object[key]
          );
        }
        return formData;
      }, new FormData());
    },
    async getProductCategories() {
      try {
        let { data } = await this.$axios.get("v1/panel/productcategories/");
        if (data && data.product_categories) {
          this.product_categories = data.product_categories;
        }
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
    async saveProductCategory() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/productcategories/update/" + this.id
          : "v1/panel/productcategories/save/";
        let { data } = await this.$axios.post(url, formData, {
          headers: {
            "Content-Type":
              "multipart/form-data; boundary=" + formData._boundary,
          },
        });
        data.status
          ? this.$toast.success(data.message, this.$t("successfully"))
          : this.$toast.error(data.message, this.$t("unsuccessfully"));
        setTimeout(() => {
          this.$router.replace("/panel/product-categories/");
        }, 1000);
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
  },
  mounted() {
    this.getProductCategories();
  },
};
</script>