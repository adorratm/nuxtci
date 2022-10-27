<template>
  <div>
    <div
      class="card border bg-light"
      :key="index"
      v-for="(item, index) in address_informations"
    >
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-sm-12">
            <div class="form-group my-3">
              <ValidationProvider
                :vid="'address' + index"
                :name="$t('panel.settings.addressInformation')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label :for="'address' + index" class="mb-5">{{
                  $t("panel.settings.addressInformation")
                }}</label>
                <textarea
                  :id="'address' + index"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.settings.addressInformation')"
                  required
                  v-model="item.address"
                  cols="30"
                  rows="5"
                  :name="'address[' + index + ']'"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group my-3">
              <ValidationProvider
                :vid="'map' + index"
                :name="$t('panel.settings.map')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label :for="'map' + index" class="mb-5">{{
                  $t("panel.settings.map")
                }}</label>
                <input
                  :id="'map' + index"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.settings.map')"
                  type="text"
                  required
                  v-model="item.map"
                  :name="'map[' + index + ']'"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-12">
            <div
              class="card bg-white border"
              v-for="(contact, i) in item.phones"
              :key="i"
            >
              <div class="card-body">
                <div
                  class="
                    row
                    align-items-center align-self-center align-content-center
                  "
                >
                  <div class="col-sm-3">
                    <div class="form-group my-3">
                      <ValidationProvider
                        :vid="'phone-' + index + '-' + i"
                        :name="$t('panel.settings.phone')"
                        rules="min:2"
                        v-slot="{ errors }"
                      >
                        <label :for="'phone-' + index + '-' + i" class="mb-5">{{
                          $t("panel.settings.phone")
                        }}</label>
                        <input
                          :id="'phone-' + index + '-' + i"
                          class="form-control form-control-sm rounded-0"
                          :placeholder="$t('panel.settings.phone')"
                          type="text"
                          v-model="contact.phone"
                          :name="'phone[' + index + '][' + i + ']'"
                        />
                        <span class="mt-5 d-block text-danger">{{
                          errors[0]
                        }}</span>
                      </ValidationProvider>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group my-3">
                      <ValidationProvider
                        :vid="'whatsapp-' + index + '-' + i"
                        :name="$t('panel.settings.whatsapp')"
                        rules="min:2"
                        v-slot="{ errors }"
                      >
                        <label
                          :for="'whatsapp-' + index + '-' + i"
                          class="mb-5"
                          >{{ $t("panel.settings.whatsapp") }}</label
                        >
                        <input
                          :id="'whatsapp-' + index + '-' + i"
                          class="form-control form-control-sm rounded-0"
                          :placeholder="$t('panel.settings.whatsapp')"
                          type="text"
                          v-model="contact.whatsapp"
                          :name="'whatsapp[' + index + '][' + i + ']'"
                        />
                        <span class="mt-5 d-block text-danger">{{
                          errors[0]
                        }}</span>
                      </ValidationProvider>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group my-3">
                      <ValidationProvider
                        :vid="'fax-' + index + '-' + i"
                        :name="$t('panel.settings.fax')"
                        rules="min:2"
                        v-slot="{ errors }"
                      >
                        <label :for="'fax-' + index + '-' + i" class="mb-5">{{
                          $t("panel.settings.fax")
                        }}</label>
                        <input
                          :id="'fax-' + index + '-' + i"
                          class="form-control form-control-sm rounded-0"
                          :placeholder="$t('panel.settings.fax')"
                          type="text"
                          v-model="contact.fax"
                          :name="'fax[' + index + '][' + i + ']'"
                        />
                        <span class="mt-5 d-block text-danger">{{
                          errors[0]
                        }}</span>
                      </ValidationProvider>
                    </div>
                  </div>
                  <div class="col-sm-3 text-center">
                    <button
                      role="button"
                      type="button"
                      @click="appendContact(index)"
                      class="btn btn-primary"
                    >
                      <i class="fa fa-plus"></i>
                    </button>
                    <button
                      role="button"
                      type="button"
                      @click="deleteContact(index, i)"
                      class="btn btn-danger"
                      v-if="item.phones.length > 1"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 text-center">
            <button
              role="button"
              type="button"
              @click="appendAddress"
              class="btn btn-primary"
            >
              <i class="fa fa-plus fa-2x"></i>
            </button>
            <button
              role="button"
              type="button"
              @click="deleteAddress(index)"
              class="btn btn-danger"
              v-if="address_informations.length > 1"
            >
              <i class="fa fa-trash fa-2x"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
export default {
  components: {
    ValidationProvider,
  },
  data() {
    return {
      address_informations: [
        {
          address: null,
          map: null,
          phones: [
            {
              phone: null,
              whatsapp: null,
              fax: null,
            },
          ],
        },
      ],
    };
  },
  methods: {
    appendAddress() {
      this.address_informations.push({
        address: null,
        map: null,
        phones: [
          {
            phone: null,
            whatsapp: null,
            fax: null,
          },
        ],
      });
    },
    deleteAddress(index) {
      this.address_informations.splice(index, 1);
    },
    appendContact(index) {
      this.address_informations[index].phones.push({
        phone: null,
        whatsapp: null,
        fax: null,
      });
    },
    deleteContact(index, i) {
      this.address_informations[index].phones.splice(i, 1);
    },
  },
};
</script>