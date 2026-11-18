(function () {
    var map = {
        "chart-pie": "pie-chart",
        "user-friends": "users",
        "calendar-check": "calendar-check",
        "file-invoice-dollar": "receipt",
        "file-invoice": "file-text",
        "bed": "bed",
        "tint": "droplet",
        "file": "file",
        "user-md": "stethoscope",
        "user-doctor": "stethoscope",
        "user-nurse": "user-round",
        "file-prescription": "file-text",
        "prescription": "file-text",
        "diagnoses": "activity",
        "question-circle": "circle-help",
        "money-bill": "banknote",
        "money-bill-wave": "banknote",
        "money-check": "wallet",
        "dungeon": "building-2",
        "cog": "settings",
        "cogs": "settings-2",
        "coins": "coins",
        "notes-medical": "clipboard-plus",
        "luggage-cart": "luggage",
        "video": "video",
        "file-video": "video",
        "capsules": "pill",
        "user-injured": "user",
        "flask": "flask-conical",
        "file-medical": "file-heart",
        "x-ray": "scan",
        "box": "box",
        "bell": "bell",
        "syringe": "syringe",
        "calendar": "calendar",
        "sms": "message-square",
        "adn": "dna",
        "id-card": "id-card",
        "rupee-sign": "indian-rupee",
        "bars": "menu",
        "magnifying-glass": "search",
        "globe-americas": "globe",
        "globe": "globe",
        "sun": "sun",
        "moon": "moon",
        "angle-down": "chevron-down",
        "chevron-up": "chevron-up",
        "user": "user",
        "lock": "lock",
        "right-from-bracket": "log-out",
        "hospital": "hospital",
        "toggle-on": "toggle-right",
        "toggle-off": "toggle-left",
        "chart-bar": "chart-column",
        "language": "languages",
        "check": "check",
        "check-double": "check-check",
        "pen": "pencil",
        "pen-to-square": "square-pen",
        "phone": "phone",
        "at": "at-sign",
        "paper-plane": "send"
    };

    var skip = {
        solid: 1, regular: 1, brands: 1, fw: 1, lg: 1, xs: 1, sm: 1, xl: 1,
        "1x": 1, "2x": 1, "3x": 1, beat: 1, spin: 1, pulse: 1, inverse: 1, border: 1, li: 1
    };

    function iconName(el) {
        var found = null;
        el.classList.forEach(function (cls) {
            if (cls.indexOf("fa-") !== 0) {
                return;
            }
            var name = cls.slice(3);
            if (skip[name]) {
                return;
            }
            found = name;
        });
        return found;
    }

    function paint(root) {
        if (!window.lucide) {
            return;
        }
        var scope = root && root.querySelectorAll ? root : document;
        scope.querySelectorAll("i").forEach(function (el) {
            if (el.getAttribute("data-lucide")) {
                return;
            }
            var name = iconName(el);
            if (!name || !map[name]) {
                return;
            }
            el.setAttribute("data-lucide", map[name]);
            el.setAttribute("aria-hidden", "true");
        });
        window.lucide.createIcons({
            attrs: { "stroke-width": "1.75" }
        });
    }

    window.paintLucideIcons = paint;

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", function () { paint(document); });
    } else {
        paint(document);
    }

    document.addEventListener("livewire:navigated", function () { paint(document); });
    document.addEventListener("livewire:init", function () {
        if (window.Livewire && Livewire.hook) {
            Livewire.hook("morph.updated", function () { paint(document); });
        }
    });
})();
