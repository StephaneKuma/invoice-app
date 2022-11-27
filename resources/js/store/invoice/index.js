import { defineStore } from "pinia";
import { ref } from "vue";

export const useInvoiceStore = defineStore("invoice", () => {
    const invoiceModal = ref(null);

    const toggleInvoice = () => {
        invoiceModal.value = !invoiceModal.value;
    };

    return {
        invoiceModal,
        toggleInvoice,
    };
});
