<template>
    <div class="d-xl-flex">
        <div class="w-100">
            <div class="d-md-flex">
                <div class="w-100">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row mb-3">
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="mt-2">
                                            <h5>
                                                {{ __("Media") }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-sm-6">
                                        <div
                                            class="mt-4 mt-sm-0 float-sm-end d-flex align-items-center"
                                        >
                                            <div class="dropdown mb-2 me-2">
                                                <button
                                                    class="btn btn-light dropdown-toggle w-100"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                >
                                                    <i
                                                        class="mdi mdi-plus me-1"
                                                    ></i>
                                                    {{ __("Create New") }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#folderModal"
                                                        ><i
                                                            class="bx bx-folder me-1"
                                                        ></i>
                                                        {{ __("Folder") }}</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        ><i
                                                            class="bx bx-file me-1"
                                                        ></i>
                                                        {{
                                                            __("Upload File")
                                                        }}</a
                                                    >
                                                </div>
                                            </div>
                                            <div class="search-box mb-2 me-2">
                                                <div class="position-relative">
                                                    <input
                                                        type="text"
                                                        class="form-control bg-light border-light rounded"
                                                        placeholder="Search..."
                                                    />
                                                    <i
                                                        class="bx bx-search-alt search-icon"
                                                    ></i>
                                                </div>
                                            </div>

                                            <div class="dropdown mb-0">
                                                <a
                                                    class="btn btn-link text-muted dropdown-toggle mt-n2"
                                                    role="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-haspopup="true"
                                                >
                                                    <i
                                                        class="mdi mdi-dots-vertical font-size-20"
                                                    ></i>
                                                </a>

                                                <div
                                                    class="dropdown-menu dropdown-menu-end"
                                                >
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        >Share Files</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        >Share with me</a
                                                    >
                                                    <a
                                                        class="dropdown-item"
                                                        href="#"
                                                        >Other Actions</a
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <ul>
                                    <li
                                        v-for="(folder, index) in folderLists"
                                        :key="folder.id"
                                    >
                                        {{ folder.name }}
                                    </li>
                                </ul>
                                <pre>{{ folderLists }}</pre>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end w-100 -->
            </div>
        </div>

        <div class="card filemanager-sidebar ms-lg-2">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="font-size-15 mb-4">Storage</h5>
                    <div class="apex-charts" id="radial-chart"></div>

                    <p class="text-muted mt-4">48.02 GB (76%) of 64 GB used</p>
                </div>

                <div class="mt-4">
                    <div class="card border shadow-none mb-2">
                        <a href="javascript: void(0);" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div
                                        class="avatar-xs align-self-center me-2"
                                    >
                                        <div
                                            class="avatar-title rounded bg-transparent text-success font-size-20"
                                        >
                                            <i class="mdi mdi-image"></i>
                                        </div>
                                    </div>

                                    <div class="overflow-hidden me-auto">
                                        <h5
                                            class="font-size-13 text-truncate mb-1"
                                        >
                                            Images
                                        </h5>
                                        <p
                                            class="text-muted text-truncate mb-0"
                                        >
                                            176 Files
                                        </p>
                                    </div>

                                    <div class="ms-2">
                                        <p class="text-muted">6 GB</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const folderLists = ref([]);
const currentFolderId = ref(0);

const fetchMedia = async (folderId = 0) => {
    try {
        const response = await axios.get(route("media.list"), {
            params: { folder_id: folderId },
        });
        folderLists.value = response.data;
        console.log(response.data);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchMedia(currentFolderId.value);
});
</script>
