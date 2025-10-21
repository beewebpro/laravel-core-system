import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
class Bng {
    static noticesTimeout = {};
    static noticesTimeoutCount = 500;

    static showSuccess(message, messageHeader = "") {
        this.showNotice("success", message, messageHeader);
    }

    static showError(message, messageHeader = "") {
        this.showNotice("error", message, messageHeader);
    }

    static showNotice(messageType, message, messageHeader = "") {
        let key = `notices_msg.${messageType}.${message}`;
        let color = "";
        let icon = "";

        if (Bng.noticesTimeout[key]) {
            clearTimeout(Bng.noticesTimeout[key]);
        }

        Bng.noticesTimeout[key] = setTimeout(() => {
            if (!messageHeader) {
                switch (messageType) {
                    case "error":
                        messageHeader = "error";
                        break;
                    case "success":
                        messageHeader = "success";
                        break;
                }
            }

            switch (messageType) {
                case "error":
                    color = "#f44336";
                    icon = '<i class="mdi mdi-information-outline"></i>';
                    break;
                case "success":
                    color = "#4caf50";
                    icon = '<i class="mdi mdi-check"></i>';
                    break;
            }

            Toastify({
                text: message,
                duration: 5000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                escapeMarkup: false,
                icon: icon,
                style: {
                    background: color,
                },
            }).showToast();
        }, Bng.noticesTimeoutCount);
    }
}

$(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    new Bng();
    window.Bng = Bng;
});
