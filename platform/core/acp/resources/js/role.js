document.addEventListener("DOMContentLoaded", function () {
    const allChecked = (nodes) =>
        nodes.length > 0 && Array.from(nodes).every((cb) => cb.checked);
    const anyChecked = (nodes) => Array.from(nodes).some((cb) => cb.checked);

    document.querySelectorAll(".form-check-input").forEach((input) => {
        input.addEventListener("change", function () {
            const checked = this.checked;

            // tìm li nơi checkbox đang ở (nếu có) và card chứa nó (nếu có)
            const li = this.closest("li");
            const card = this.closest(".card");

            // 1) Đồng bộ descendants (nếu check/uncheck 1 node thì apply xuống tất cả con)
            const wrapper = li ?? card;
            if (wrapper) {
                const descendants = wrapper.querySelectorAll(
                    ":scope ul .form-check-input"
                );
                descendants.forEach((d) => (d.checked = checked));
            }

            // 2) Cập nhật các ancestor <li> từng cấp lên trên, set checked/indeterminate đúng
            let ancestorLi = li?.closest("ul")?.closest("li");
            while (ancestorLi) {
                const ancestorCheckbox = ancestorLi.querySelector(
                    ":scope > .form-check .form-check-input"
                );
                const directChildCheckboxes = ancestorLi.querySelectorAll(
                    ":scope > ul > li > .form-check .form-check-input"
                );

                if (ancestorCheckbox) {
                    if (allChecked(directChildCheckboxes)) {
                        ancestorCheckbox.checked = true;
                        ancestorCheckbox.indeterminate = false;
                    } else if (anyChecked(directChildCheckboxes)) {
                        ancestorCheckbox.checked = false;
                        ancestorCheckbox.indeterminate = true;
                    } else {
                        ancestorCheckbox.checked = false;
                        ancestorCheckbox.indeterminate = false;
                    }
                }

                ancestorLi = ancestorLi.closest("ul")?.closest("li");
            }

            // 3) Cập nhật ROOT (checkbox trong .card-header)
            if (card) {
                const rootCheckbox = card.querySelector(
                    ".card-header .form-check-input"
                );
                if (rootCheckbox) {
                    // -> Lấy tất cả checkbox **cấp 1** (trong card-body trực tiếp: ul > li)
                    const topLevel = card.querySelectorAll(
                        ":scope > .card-body > ul > li > .form-check .form-check-input"
                    );

                    // nếu không tìm thấy topLevel (cấu trúc khác) thì fallback sang toàn bộ descendants
                    const targetList = topLevel.length
                        ? topLevel
                        : card.querySelectorAll(".card-body .form-check-input");

                    if (allChecked(targetList)) {
                        rootCheckbox.checked = true;
                        rootCheckbox.indeterminate = false;
                    } else if (anyChecked(targetList)) {
                        rootCheckbox.checked = false;
                        rootCheckbox.indeterminate = true;
                    } else {
                        rootCheckbox.checked = false;
                        rootCheckbox.indeterminate = false;
                    }
                }
            }
        }); // end change listener
    }); // end forEach
});
