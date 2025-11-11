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
                                {{ folders }}
                                <ul>
                                    <li
                                        v-for="(folder, index) in folders"
                                        :key="index"
                                    >
                                        {{ folder.name }}
                                    </li>
                                </ul>
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
    <!-- Modal tạo folder -->
    <div
        class="modal fade"
        id="folderModal"
        tabindex="-1"
        aria-labelledby="folderModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="folderModalLabel">
                        {{ __("Create Folder") }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>
                </div>
                <div class="modal-body">
                    <input
                        type="text"
                        :value="newFolderName"
                        @input="onFolderNameInput"
                        class="form-control"
                        placeholder="Folder name"
                    />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __("Close") }}
                    </button>
                    <button class="btn btn-primary" @click="createFolder">
                        {{ __("Create") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const folders = ref([]);
const files = ref([]);

const newFolderName = ref("");
const currentFolderId = ref(0);

const onFolderNameInput = (event) => {
    newFolderName.value = event.target.value;
};

const createFolder = async () => {
    if (!newFolderName.value.trim()) return;

    try {
        const response = await axios.post(route("media.folders.create"), {
            name: newFolderName.value,
            parent_id: currentFolderId.value,
        });
        if (!response.data.error) {
            newFolderName.value = "";
            showFolderModal.value = false;
            await fetchMedia(currentFolderId.value);
        } else {
            alert(response.data.message || "Error creating folder");
        }
    } catch (err) {
        console.error(err);
        alert("Error creating folder");
    }
};

const openFolder = async (folderId) => {
    await fetchMedia(folderId);
};

const fetchMedia = async (folderId) => {
    try {
        const response = await axios.get(route("media.list"), {
            params: { folder_id: folderId },
        });
        folders.value = response.data || [];
        console.log(folders.value);
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};
// Gọi khi vào trang
onMounted(() => {
    fetchMedia(currentFolderId.value);
});
</script>
