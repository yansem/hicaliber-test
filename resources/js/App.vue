<template>
    <el-container>
        <el-header class="bg-blue-500">Header</el-header>
        <el-container>
            <el-aside width="300px" class="bg-white border-r border-gray-200 p-4">
                <el-form class="w-[250px]" :model="form" ref="form" label-width="80px">
                    <el-form-item label="Name">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item label="Price">
                        <el-slider
                            v-model="form.price"
                            range
                            :min="0"
                            :max="1000"
                            :show-input="true"
                        >
                        </el-slider>
                    </el-form-item>
                    <el-form-item label="Bedrooms">
                        <el-dropdown trigger="click">
    <span class="el-dropdown-link">
      Select
    </span>
                            <template #dropdown>
                                <el-dropdown-menu>
                                    <el-dropdown-item>Action 1</el-dropdown-item>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </el-form-item>
                    <el-form-item label="Bathrooms">
                        <el-dropdown trigger="click">
    <span class="el-dropdown-link">
      Select
    </span>
                            <template #dropdown>
                                <el-dropdown-menu>
                                    <el-dropdown-item>Action 1</el-dropdown-item>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </el-form-item>
                    <el-form-item label="Storeys">
                        <el-dropdown trigger="click">
    <span class="el-dropdown-link">
      Select
    </span>
                            <template #dropdown>
                                <el-dropdown-menu>
                                    <el-dropdown-item>Action 1</el-dropdown-item>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </el-form-item>
                    <el-form-item label="Garages">
                        <el-dropdown trigger="click">
    <span class="el-dropdown-link">
      Select
    </span>
                            <template #dropdown>
                                <el-dropdown-menu>
                                    <el-dropdown-item>Action 1</el-dropdown-item>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">Search</el-button>
                    </el-form-item>
                </el-form>
            </el-aside>

            <el-main>Main Content</el-main>
        </el-container>
    </el-container>
</template>

<script setup>
import {reactive} from 'vue'

const form = reactive({
    name: '',
    price: [0, 1000],
    bedrooms: '',
    bathrooms: '',
    storeys: '',
    garages: '',
})

const onSubmit = () => {
    console.log('submit!')
}
</script>