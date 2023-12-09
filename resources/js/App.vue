<template>
    <el-container v-loading="isLoading">
        <el-header class="bg-blue-500">PHP Developer Test Header</el-header>
        <el-container>
            <el-aside width="300px" class="bg-white border-r border-gray-200 p-4">
                <el-form :rules="rules" ref="ruleFormRef" :model="form" class="w-[250px]" label-width="80px">
                    <el-form-item label="Name" prop="name" :error="errors.name">
                        <el-input v-model="form.name"/>
                    </el-form-item>
                    <el-form-item label="Price" :error="errors.price" class="!mb-7">
                        <el-slider
                            v-model="form.price"
                            range
                            :min="sliderRangeMin"
                            :max="sliderRangeMax"
                            :show-input="true"
                            @change="handleSliderChange"
                            :format-tooltip="formatTooltip"
                        />
                        <el-input-number :min="sliderRangeMin" :max="sliderRangeMax" v-model="sliderRange.min" @change="handleInputChange"/>
                        <el-input-number v-model="sliderRange.max" @change="handleInputChange"/>
                    </el-form-item>
                    <el-form-item label="Bedrooms" :error="errors.bedrooms">
                        <el-input-number :min="0" :max="255" v-model="form.bedrooms"/>
                    </el-form-item>
                    <el-form-item label="Bathrooms" :error="errors.bathrooms">
                        <el-input-number :min="0" :max="255" v-model="form.bathrooms"/>
                    </el-form-item>
                    <el-form-item label="Storeys" :error="errors.storeys">
                        <el-input-number :min="0" :max="255" v-model="form.storeys"/>
                    </el-form-item>
                    <el-form-item label="Garages" :error="errors.garages">
                        <el-input-number :min="0" :max="255" v-model="form.garages"/>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit(ruleFormRef)">Search</el-button>
                        <el-button  @click="resetForm">Reset</el-button>
                    </el-form-item>
                </el-form>
            </el-aside>

            <el-main>
                <template v-if="items.length > 0">
                    <el-table :data="items">
                        <el-table-column prop="name" label="Name"/>
                        <el-table-column prop="price" label="Price"/>
                        <el-table-column prop="bedrooms" label="Bedrooms"/>
                        <el-table-column prop="bathrooms" label="Bathrooms"/>
                        <el-table-column prop="storeys" label="Storeys" />
                        <el-table-column prop="garages" label="Garages" />
                    </el-table>
                </template>

                <template v-else>
                    There are no search results...
                </template>
            </el-main>
        </el-container>
    </el-container>
</template>

<script setup>
import {ref, reactive, computed} from 'vue'

const isLoading = ref(false);
const sliderRangeMin = 0;
const sliderRangeMax = 1000000;

const formTemplate = {
    name: '',
    price: [sliderRangeMin, sliderRangeMax],
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null
}
const form = ref({...formTemplate});
const sliderRange = reactive({
    min: sliderRangeMin,
    max: sliderRangeMax
});
const rules = reactive({
    name: [
        { min: 3, max: 255, message: 'Length should be 3 to 255', trigger: 'blur' },
    ],
    price: [{}]
})
const errors = ref({});

const items = ref([]);
const ruleFormRef = ref(null);

const filteredParams = computed(() => Object.fromEntries(
    Object.entries(form.value).filter(([key, value]) => value !== '' && value !== 0))
);

const onSubmit = async (formEl) => {
    if (!formEl) return
    await formEl.validate(async (valid) => {
        if (valid) {
            isLoading.value = true;
            await axios.get('/api/v1/search', {params: filteredParams.value})
                .then(response => {
                    items.value = response.data.data;
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        errors.value = formatValidationErrors(error.response.data.errors);
                    } else {
                        console.error(error);
                    }
                })
                .finally(() => {
                    isLoading.value = false;
                })
        }
    })

};

const resetForm = () => {
    form.value = {...formTemplate};
    sliderRange.min = sliderRangeMin;
    sliderRange.max = sliderRangeMax;

}

const handleSliderChange = (value) => {
    [sliderRange.min, sliderRange.max] = value;
};

const handleInputChange = () => {
    form.price = [sliderRange.min, sliderRange.max];
};

const formatValidationErrors = (validationErrors) => {
    const formattedErrors = {};
    for (const key in validationErrors) {
        if (key === 'price.0' || key === 'price.1') {
            formattedErrors['price'] = validationErrors[key][0];
        } else {
            formattedErrors[key] = validationErrors[key][0];
        }

    }
    return formattedErrors;
};

const formatTooltip = (value) => {
    return `$${value}`;
}
</script>