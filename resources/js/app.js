import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function showCartToast(message, isError = false) {
    let toast = document.getElementById("cart-ajax-toast");

    if (!toast) {
        toast = document.createElement("div");
        toast.id = "cart-ajax-toast";
        toast.className =
            "fixed bottom-5 right-5 z-[80] px-4 py-2 rounded-lg text-sm font-semibold shadow-lg transition-opacity duration-300";
        document.body.appendChild(toast);
    }

    toast.textContent = message;
    toast.classList.remove(
        "opacity-0",
        "bg-green-600",
        "bg-red-600",
        "text-white",
    );
    toast.classList.add(
        "opacity-100",
        isError ? "bg-red-600" : "bg-green-600",
        "text-white",
    );

    window.clearTimeout(window.__cartToastTimer);
    window.__cartToastTimer = window.setTimeout(() => {
        toast.classList.remove("opacity-100");
        toast.classList.add("opacity-0");
    }, 1800);
}

function updateCartBadge(count) {
    const badge = document.getElementById("cart-count-badge");

    if (!badge) {
        return;
    }

    if (count > 0) {
        badge.textContent = String(count);
        badge.classList.remove("hidden");
    } else {
        badge.classList.add("hidden");
    }
}

document.addEventListener("submit", async (event) => {
    const form = event.target;

    if (
        !(form instanceof HTMLFormElement) ||
        form.dataset.ajaxCart !== "true"
    ) {
        return;
    }

    event.preventDefault();

    const submitButton = form.querySelector('button[type="submit"]');

    if (submitButton) {
        submitButton.disabled = true;
    }

    try {
        const response = await fetch(form.action, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            body: new FormData(form),
            credentials: "same-origin",
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || "Failed to add to cart.");
        }

        if (typeof data.cart_count === "number") {
            updateCartBadge(data.cart_count);
        }

        showCartToast(data.message || "Added to cart!");
    } catch (error) {
        showCartToast(error.message || "Failed to add to cart.", true);
    } finally {
        if (submitButton) {
            submitButton.disabled = false;
        }
    }
});
