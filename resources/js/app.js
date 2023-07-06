import "./bootstrap";

import Alpine from "alpinejs";
import "flowbite";
import deleteModal from "./deleteModal";
import imageModal from "./imageModal";
import createResource from "./createResource";
import categoryManipulation from "./categoryManipulation";

document.addEventListener('alpine:init', () => {
    Alpine.data('deleteModal', deleteModal)
    Alpine.data('imageModal', imageModal)
    Alpine.data('createResource', createResource)
    Alpine.data('categoryManipulation', categoryManipulation)
})

window.Alpine = Alpine
Alpine.start();