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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row">
                                    <div
                                        class="col-xl-2 col-sm-3"
                                        v-for="(folder, index) in folderLists"
                                        :key="folder.id"
                                    >
                                        <div class="card shadow-none border">
                                            <div class="card-body p-3">
                                                <div class="text-center">
                                                    <div class="mb-2">
                                                        <div
                                                            class="avatar-title bg-transparent rounded"
                                                        >
                                                            <i
                                                                class="bx bxs-folder font-size-24 text-warning"
                                                            ></i>
                                                        </div>
                                                    </div>
                                                    <h5
                                                        class="font-size-14 text-truncate mb-1"
                                                    >
                                                        <a
                                                            href="javascript: void(0);"
                                                            class="text-body"
                                                        >
                                                            {{ folder.name }}
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <!-- Modal -->
    <div class="modal fade" id="folderModal" tabindex="-1" aria-hidden="true">
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
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    folders: {
        type: Object,
    },
});

const folderLists = ref(props.folders || []);
const currentFolderId = ref(0);
const newFolderName = ref("");
let folderModalInstance = null;

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

            if (folderModalInstance) folderModalInstance.hide();

            fetchMedia(currentFolderId.value);
        } else {
            alert(response.data.message || "Error creating folder");
        }
    } catch (err) {
        console.error(err);
        alert("Error creating folder");
    }
};

const openFolder = async (folderId) => {
    currentFolderId.value = folderId;
    await fetchMedia(folderId);
};

const fetchMedia = async (folderId = 0) => {
    try {
        const response = await axios.get(route("media.list"), {
            params: { folder_id: folderId },
        });
        folderLists.value = [...response.data];
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchMedia(0);
    const modalEl = document.getElementById("folderModal");
    folderModalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
});

watch(
    () => props.folders,
    (newVal) => {
        if (newVal.length > 0 && folderLists.value.length === 0) {
            folderLists.value = [...newVal];
        }
    },
    { immediate: true }
);
</script>
